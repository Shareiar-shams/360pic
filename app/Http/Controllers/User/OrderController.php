<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\datetimepicker;
use App\Models\User\order;
use App\Models\User\orderproduct;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Square\Apis\CustomersApi;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Models\Address;
use Square\Models\Country;
use Square\Models\CreateCustomerCardRequest;
use Square\Models\CreateCustomerRequest;
use Square\Models\CreateLocationRequest;
use Square\Models\CreateOrderRequest;
use Square\Models\CreatePaymentRequest;
use Square\Models\Currency;
use Square\Models\CustomerSortField;
use Square\Models\Location;
use Square\Models\Money;
use Square\Models\OrderLineItem;
use Square\Models\OrderSource;
use Square\Models\SortOrder;
use Square\SquareClient;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->client = new SquareClient([
            "accessToken" => $this->access_token(),
            "environment" => Environment::SANDBOX
        ]);
    }   

    protected function access_token(){
        $token = 'EAAAEKK0vZpANc8IlC61ZNBCIYYgP-o4lfmDyOQYrDWV7Xsliha7imaAfJ3DOvR2';

        return $token;
    }

    protected function idempotency_key(){
        return md5(uniqid(rand(1,32), true));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'billing_area' => 'required',
            'work_area' => 'required',
            'special_note' => 'nullable',
            'terms_privacy' => 'required',
        ]);
        $track_id = Str::random(10);
        $order =  new order();
        $order->subtotal = \Cart::session(Session::getId())->getSubtotal();
        $order->order_quantity = \Cart::session(Session::getId())->getTotalQuantity();
        $order->total = \Cart::session(Session::getId())->getTotal();
        $order->user_id = Auth::user()->id;
        $order->tracking_id = $track_id;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->billing_area = $request->billing_area;
        $order->work_area = $request->work_area;
        $order->addressline = $request->addressline;
        $order->city = $request->city;
        $order->postal_code = $request->postal_code;
        $order->order_status = 'Default';
        $order->save();

        // return response()->json([
        //     'success' => true
        // ]);

        return redirect(route('cartTocheckout'));

    }

    public function chack_user_order()
    {
        $auth_id = Auth::id();

        $check_order = order::where('user_id', $auth_id)->where('order_status','Default')->orderBy('id', 'DESC')->first();
        if(isset($check_order)){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }


    public function addCard(Request $request)
    {
        $cardNonce = $request->nonce;

        $customersApi = $this->client->getCustomersApi();

        $orderId_fetch = $this->ordercreate();

        $customerId = $orderId_fetch['status'] == true ? $orderId_fetch['customer_id'] : null;
        $orderId = $orderId_fetch['status'] == true ? $orderId_fetch['order_id'] : null;
        $locationId = $orderId_fetch['status'] == true ? $orderId_fetch['location_id'] : null;

        $body = new CreateCustomerCardRequest(
            $cardNonce
        );

        $apiResponse = $customersApi->createCustomerCard($customerId, $body);

        if ($apiResponse->isSuccess()) {
            $result = $apiResponse->getResult();

            $card_id = $result->getCard()->getId();
            $card_brand = $result->getCard()->getCardBrand();
            $card_last_four = $result->getCard()->getLast4();
            $card_exp_month = $result->getCard()->getExpMonth();
            $card_exp_year = $result->getCard()->getExpYear();

            $transaction = $this->charge($customerId, $card_id, $orderId, $locationId);

            $transaction_id = $transaction['status'] == true ? $transaction['transaction_id'] : null;

            $d_order_id = $transaction['d_order_id'];

            
            if(isset($transaction_id)){
                $order = order::find($d_order_id);
                $order->order_status = 'Pending';
                $order->save();

                $find_date = datetimepicker::where('username', Auth::user()->username)->orderBy('id', 'DESC')->first();
                $datetime =  datetimepicker::find($find_date->id);
                $datetime->order_id = $d_order_id;
                $datetime->save();

                $session_id = Session::getId();
                foreach (\Cart::session(Session::getId())->getContent() as $item) {
                    $orderProduct[] = [
                        'order_id' => $d_order_id,
                        'product_id' => $item->id,
                        'product_name' => $item->name,
                        'product_slug' => $item->attributes->slug,
                        'product_SKU' => $item->attributes->SKU,
                        'product_price' => $item->price,
                        'product_category' => $item->attributes->category,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                orderproduct::insert($orderProduct);

                \Cart::session($session_id)->clear();
                \Cart::session($session_id)->clearCartConditions();

                return response()->json([
                    'success' => $transaction_id
                ]);
            }else{
                // $order = order::where('id',$d_order_id)->delete();
                // $find_date = datetimepicker::where('username', Auth::user()->username)->first();
                // $datetime =  datetimepicker::where('id',$find_date->id)->delete();
                return response()->json([
                    'success' => false
                ]);
            }

            

        } else {
            $errors = $apiResponse->getErrors();

            return response()->json([
                'success' => false
            ]);
        }
    }

    public function charge($customerId, $cardId, $orderId, $locationId)
    {  
        $order = order::where('user_id', Auth::user()->id)->orderBy('id','DESC')->first();
        $paymentsApi = $this->client->getPaymentsApi();

        $body_sourceId = $cardId;
        $body_idempotencyKey = $this->idempotency_key();
        $body_amountMoney = new Money;
        $body_amountMoney->setAmount($order->total);
        $body_amountMoney->setCurrency(Currency::CAD);
        $body = new CreatePaymentRequest(
            $body_sourceId,
            $body_idempotencyKey,
            $body_amountMoney
        );
        $body->setAutocomplete(true);
        $body->setOrderId($orderId);
        $body->setCustomerId($customerId);
        $body->setLocationId($locationId);
        $body->setNote('medibo product payment and order ID '.$orderId);

        $apiResponse = $paymentsApi->createPayment($body);

        if ($apiResponse->isSuccess()) {
            $createPaymentResponse = $apiResponse->getResult();
            $transaction_id = $createPaymentResponse->getPayment()->getId();
            return ['status' => true, 'transaction_id' => $transaction_id, 'd_order_id' => $order->id];
        } else {
            $errors = $apiResponse->getErrors();
            return ['status' => false, 'errors' => $errors];
        }
    }


    public function ordercreate()
    {
        $order = order::where('user_id', Auth::user()->id)->orderBy('id','DESC')->first();

        $customer = $this->customercreate($order);
        $customerId = $customer['status'] == true ? $customer['customer_id'] : ' ';
        $ordersApi = $this->client->getOrdersApi();

        $body = new CreateOrderRequest;
        $locationId = $this->createlocation($customerId,$order->work_area,$order->addressline,$order->city,$order->postal_code);
        $body_order_locationId = $locationId['status'] == true ? $locationId['location_id'] : null;
        $body->setOrder(new \Square\Models\Order(
            $body_order_locationId
        ));
        $body->getOrder()->setReferenceId('medibo-order'.$order->id);
        $body->getOrder()->setSource(new OrderSource);
        $body->getOrder()->getSource()->setName('medibo-customer-'.$customerId);
        $body->getOrder()->setCustomerId($customerId);
        $body->getOrder()->setState('OPEN');
        $body_order_lineItems = [];
        $i = 0;

        foreach (\Cart::session(Session::getId())->getContent() as $item) {
            $body_order_lineItems_quantity = '1';
            $body_order_lineItems[$i] = new OrderLineItem(
                $body_order_lineItems_quantity
            );
            $body_order_lineItems[$i]->setUid($item->id);
            $body_order_lineItems[$i]->setName($item->name);
            $body_order_lineItems[$i]->setBasePriceMoney(new Money);
            $body_order_lineItems[$i]->getBasePriceMoney()->setAmount($item->price);
            $body_order_lineItems[$i]->getBasePriceMoney()->setCurrency(Currency::CAD);

            $i++;
        }
        $body->getOrder()->setLineItems($body_order_lineItems);

        $body->setIdempotencyKey($this->idempotency_key());

        $apiResponse = $ordersApi->createOrder($body);
        if ($apiResponse->isSuccess()) {
            $createOrderResponse = $apiResponse->getResult();
            $customer_id = $createOrderResponse->getOrder()->getCustomerId();
            $order_id = $createOrderResponse->getOrder()->getId();
            return ['status'=> true,'order_id'=>$order_id, 'customer_id' =>$customer_id, 'location_id' => $body_order_locationId];
        } else {
            $errors = $apiResponse->getErrors();
            return ['status'=> false, 'errors' =>$errors];
        }

    }

    public function createlocation($customerId,$work_area,$addressline,$city,$postal_code){
        $locationsApi = $this->client->getLocationsApi();
        $body = new CreateLocationRequest;
        $body->setLocation(new Location);
        $body->getLocation()->setName('Customer area, Customer Id: '.$customerId);
        $body->getLocation()->setAddress(new Address);
        $body->getLocation()->getAddress()->setAddressLine1($work_area);
        $body->getLocation()->getAddress()->setAddressLine2($addressline);
        $body->getLocation()->getAddress()->setLocality($city);
        $body->getLocation()->getAddress()->setAdministrativeDistrictLevel1('CA');
        $body->getLocation()->getAddress()->setPostalCode($postal_code);
        $body->getLocation()->setDescription('Medibo Customer location.');

        $apiResponse = $locationsApi->createLocation($body);

        if ($apiResponse->isSuccess()) {
            $createLocationResponse = $apiResponse->getResult();
            $location_id = $createLocationResponse->getLocation()->getId();
            return ['status'=>true, 'location_id' =>$location_id];
        } else {
            $errors = $apiResponse->getErrors();
            return ['status'=>false, 'errors' =>$errors];
        }
    }

    public function chack(){
        $orderId_fetch = $this->ordercreate();

        // $customerId = $orderId_fetch['customer_id'];
        // $orderId = $orderId_fetch['order_id'];

        // echo $orderId."\n".$customerId;

        echo "<pre>";
        print_r($orderId_fetch);
        echo "</pre>";

    }

    public function customercreate($request){
        $customersApi = $this->client->getCustomersApi();

        $body = new CreateCustomerRequest;
        $body->setIdempotencyKey($this->idempotency_key());
        $body->setGivenName($request->first_name);
        $body->setFamilyName($request->last_name);
        $body->setEmailAddress($request->email);
        $body->setAddress(new Address);
        $body->getAddress()->setAddressLine1($request->billing_area);
        $body->getAddress()->setAddressLine2($request->work_area);
        $body->getAddress()->setPostalCode($request->postal_code);
        $body->getAddress()->setCountry(Country::CA);
        $body->setPhoneNumber($request->phone);
        $body->setNote('medibo customer');

        $apiResponse = $customersApi->createCustomer($body);

        if ($apiResponse->isSuccess()) {
            $createCustomerResponse = $apiResponse->getResult();

            $customer_id = $createCustomerResponse->getCustomer()->getId();
            return ['status'=>true, 'customer_id' => $customer_id];
            // return "okay";
        } else {
            $errors = $apiResponse->getErrors();
            // return $errors;
            return ['status'=>false, 'errors' => $errors];
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
