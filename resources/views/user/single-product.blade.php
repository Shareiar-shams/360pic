@extends('user.layout')

@section('title_content')
    <title>360pic | {{$items->name}}</title>
@endsection

@section('css_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endsection

@section('main_content')
	<!--===  Inner Banner Area Start ===-->
    <section class="inner_banner_area section_padding" data-background="{{asset('user/assets/image/inner_banner.png')}}">
        <div class="container">
            <div class="inner_titel text-center">
                <h2>{{$items->name}}</h2>
            </div>
        </div>
    </section>
    <!--===  Inner Banner Area End ===-->
    <!-- RMS MEASURMENT AREA START -->
    <section class="rms_measurment_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">
                    <div class="rms_measurment_box">
                        <div class="top_img" data-aos="fade-up" style="background-image: url( {{Storage::disk('local')->url($items->display_image)}} );">
                        </div>
                        <div class="product_offer_box">
                            <div class="offer_box" data-aos="fade-right">
                                <div class="box_icon">
                                    <img src="{{Storage::disk('local')->url($items->display_image)}}" alt="icon image">
                                </div>
                                <div class="box_titel">
                                    <h5>{{$items->name}}</h5>
                                </div>
                                <div class="offfer_price">
                                    <span>
                                        @if(empty($items->special_price))
                                            {{$items->price}}&#x24;
                                        @else 
                                            {{$items->special_price}}&#x24;
                                            
                                            <del>{{$items->price}}&#x24;</del>
                                        @endif
                                    </span>
                                </div>
                                <form id="cart-add-form-{{$items->id}}" style="display: none" method="POST" action="{{route('cart.store')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                    @if(!empty($items->special_price))
                                        <input type="hidden" name="price" value="{{$items->special_price}}">
                                    @else
                                        <input type="hidden" name="price" value="{{$items->price}}" />
                                    @endif
                                    <input type="hidden" name="id" value="{{$items->id}}" />
                                    <input type="hidden" name="name" value="{{$items->name}}" />
                                    <input type="hidden" name="SKU" value="{{$items->SKU}}" />
                                    <input type="hidden" name="slug" value="{{$items->slug}}" />
                                    <input type="hidden" name="category" value="{{$items->category->name}}" />
                                    <input type="hidden" value="{{ $items->display_image }}" id="img" name="img">
                                </form>
                                <div class="offer_btn">
                                    @php
                                        $a = array();
                                    @endphp
                                    @if(count(\Cart::session(Session::getId())->getContent()) > 0)
                                        @foreach(\Cart::session(Session::getId())->getContent() as $content)
                                            @if (!in_array($content->id,$a))
                                                @php
                                                    array_push($a,$content->id);
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if(array_search($items->id, $a) !== false)
                                            <a rel="nofollow" href="{{route('cart.index')}}" class="btn default_btn">CheckOut</a>
                                        @else
                                            <a rel="nofollow" onclick="document.getElementById('cart-add-form-{{$items->id}}').submit();" class="btn default_btn">Book Now</a>
                                        @endif
                                    @else
                                        <a rel="nofollow" onclick="document.getElementById('cart-add-form-{{$items->id}}').submit();" class="btn default_btn">Book Now</a>
                                    @endif
                                </div>
                            </div>
                            <div class="offer_details" data-aos="fade-left">
                                {!!htmlspecialchars_decode($items->desc)!!}
                            </div>
                        </div>
                        <div class="product_offer_box res_ofer_box">
                            <div class="addons_btn_group">
                                <ul>
                                    @if($additional_item->count() != 0)
                                        @foreach($additional_item as $other_item)
                                            <li>
                                                <div class="ad_ons_box ma_r" data-aos="fade-right">
                                                    <div class="box_icon add_ons_icon">
                                                        <img src="{{Storage::disk('local')->url($other_item->display_image)}}" alt="icon image">
                                                    </div>
                                                    <div class="box_titel">
                                                        <span><a href="{{route('single_product',$other_item->slug)}}">{{$other_item->name}}</a></span>
                                                    </div>
                                                    <div class="offfer_price">
                                                        <span>
                                                            @if(empty($other_item->special_price))
                                                                &#x24;{{$other_item->price}}
                                                            @else 
                                                                &#x24;{{$other_item->special_price}}
                                                                
                                                                <del>&#x24;{{$other_item->price}}</del>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <form id="cart-add-form-{{$other_item->id}}" style="display: none" method="POST" action="{{route('cart.store')}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                                        @if(!empty($other_item->special_price))
                                                            <input type="hidden" name="price" value="{{$other_item->special_price}}">
                                                        @else
                                                            <input type="hidden" name="price" value="{{$other_item->price}}" />
                                                        @endif
                                                        <input type="hidden" name="id" value="{{$other_item->id}}" />
                                                        <input type="hidden" name="name" value="{{$other_item->name}}" />
                                                        <input type="hidden" name="SKU" value="{{$other_item->SKU}}" />
                                                        <input type="hidden" name="slug" value="{{$other_item->slug}}" />
                                                        <input type="hidden" name="category" value="{{$other_item->category->name}}" />
                                                        <input type="hidden" value="{{ $other_item->display_image }}" id="img" name="img">
                                                    </form>
                                                    <div class="offer_btn">
                                                        @php
                                                            $a = array();
                                                        @endphp
                                                        @if(count(\Cart::session(Session::getId())->getContent()) > 0)
                                                            @foreach(\Cart::session(Session::getId())->getContent() as $content)
                                                                @if (!in_array($content->id,$a))
                                                                    @php
                                                                        array_push($a,$content->id);
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            @if(array_search($other_item->id, $a) !== false)
                                                                <a rel="nofollow" href="{{route('cart.index')}}" class="btn default_btn">CheckOut</a>
                                                            @else
                                                                <a rel="nofollow" onclick="document.getElementById('cart-add-form-{{$other_item->id}}').submit();" class="btn default_btn">Add-on</a>
                                                            @endif
                                                        @else
                                                            <a rel="nofollow" onclick="document.getElementById('cart-add-form-{{$other_item->id}}').submit();" class="btn default_btn">Add-on</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            @if(count(\Cart::session(Session::getId())->getContent()) > 0)
                                <div class="service_book_btn text-center" data-aos="fade-down">
                                    <a href="{{route('cart.index')}}" class="btn default_btn">book now</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="more_information_box">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="more_informaion_left" data-aos="fade-up-right">
                            <div class="titel">
                                <h5>More Information</h5>
                            </div>
                            {!!htmlspecialchars_decode($items->additional_info)!!}
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="more_informaion_right" data-aos="fade-up-left">
                            <div class="more_info_img">
                                <img src="{{Storage::disk('local')->url($items->additional_image)}}" alt="">
                            </div>
                            <div class="info_btns hdr_photo_btn">
                                @if(isset($items->trd_additional_btn))
                                    <a href="#pop_up_gallery" class="btn default_btn pop_img" target="blank"><span><i class="fas fa-external-link-alt"></i></span> <span>{{$items->trd_additional_btn}}</span></a>
                                    <div id="pop_up_gallery">
                                        @foreach($items->images as $image)
                                        <a href="{{Storage::disk('local')->url($image->image_path)}}"></a>
                                        @endforeach
                                    </div>
                                @endif
                                <ul>
                                    @if(isset($items->fst_additional_btn))
                                    <li>
                                        <a href="{{route('additional.file.download.frontend',['id'=>$items->id,'content'=>'fst_btn_content'])}}" class="btn default_btn" target="blank"><span><i class="fas fa-external-link-alt"></i></span> <span>{{$items->fst_additional_btn}}</span></a>
                                    </li>
                                    @endif
                                    @if(isset($items->snd_additional_btn))
                                    <li>
                                        <a href="{{route('additional.file.download',['id'=>$items->id,'content'=>'snd_btn_content'])}}" class="btn default_btn" target="blank"><span><i class="fas fa-external-link-alt"></i></span><span>{{$items->snd_additional_btn}}</span></a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- RMS MEASURMENT AREA END -->
    
@endsection

@section('js_content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <script>
        $(document).ready(function() {

        $('a.btn.default_btn.pop_img').on('click', function(event) {
            event.preventDefault();
            
            var gallery = $(this).attr('href');

            $(gallery).magnificPopup({
                delegate: 'a',
                type:'image',
                gallery: {
                    enabled: true
                }
            }).magnificPopup('open');
        });

        });
    </script>
@endsection