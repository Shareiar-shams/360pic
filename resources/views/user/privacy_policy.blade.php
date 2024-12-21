@extends('user.layout')

@section('title_content')
    <title>360pic | {{$page->title}}</title>
@endsection

@section('main_content')
	<!--===  Inner Banner Area Start ===-->
    <section class="inner_banner_area section_padding" data-background="{{Storage::disk('local')->url($page->file)}}">
        <div class="container">
            <div class="inner_titel text-center">
                <h2>{{$page->title}}</h2>
                <h5>{{$page->subtitle}}</h5>
            </div>
        </div>
    </section>
    <!--===  Inner Banner Area End ===-->
    <!-- TEARMS & CONDITIONS AREA START -->
    <section class="terms_condition_area section_padding_2" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12 col-sm-12 col-12 mx-auto">
                    <div class="terms_condition_box">
                        <div class="conditions">
                            {!!htmlspecialchars_decode($page->content)!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- TEARMS & CONDITIONS AREA END -->
@endsection

@section('js_content')
@endsection