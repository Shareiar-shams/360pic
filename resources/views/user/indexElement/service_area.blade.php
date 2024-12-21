<!-- Our Service Area Start -->
<section class="service_area section_padding">
   <div class="container">
        <div class="row">
            <div class="section_title text-center">
                <h2 data-aos="zoom-in">Our services</h2>
                <div class="em-bar-main">
                    <div class="em-bar em-bar-big" data-aos="zoom-in"></div>
                </div>
            </div>
        </div>
       	<div class="row">
            @if($total_item->count() != 0)
                @foreach($total_item as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="service_box" data-aos="fade-right">
                            <div class="service_img">
                                <img src="{{Storage::disk('local')->url($item->display_image)}}" alt="measrments">
                            </div>
                            <div class="service_ctn">
                                <div class="titel">
                                    <h3>{{$item->name}}</h3>
                                </div>
                                <div class="price">
                                    <p>
                                        @if(empty($item->special_price))
                                            {{$item->price}}&#x24;
                                        @else 
                                            {{$item->special_price}}&#x24;
                                            
                                            <del>{{$item->price}}&#x24;</del>
                                        @endif
                                    </p>
                                </div>
                                <div class="service_detail">
                                    {!! Str::limit($item->desc, 150) !!}
                                </div>
                                <div class="service_btn">
                                    <a href="{{route('single_product',$item->slug)}}" class="btn">learn more <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
       	</div>
        <div class="row">
           <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <div class="combo_offer text-center" data-aos="zoom-in">
                   <img src="{{asset('user/assets/image/combo_offer.png')}}" alt="offer" class="img-fluid">
               </div>
           </div>
        </div>
        <div class="row">
            <div class="service_book_btn text-center" data-aos="fade-down">
                <a href="#" class="btn default_btn">book now</a>
            </div>
        </div>
   </div>
</section>
<!-- Our Service Area End -->