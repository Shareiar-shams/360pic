<!-- Hero Areaa Start -->
<section class="hero_area">
	<video autoplay muted loop id="myVideo">
	    <source src="{{Storage::disk('local')->url($page->file)}}" type="video/mp4">
	</video>
	<div class="video_content">
	    <div class="slider_text">
	        <span>{{$page->title}}</span>
	        <h1>{{$fstsub}}</h1>
	        <p>{{$snssub}}</p>
	    </div>
	</div>
</section>
<!-- Hero Areaa End -->