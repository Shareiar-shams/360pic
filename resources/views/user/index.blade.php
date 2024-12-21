@extends('user.layout')

@section('title_content')
    <title>360pic | Home</title>
@endsection

@section('main_content')
    @include('user.indexElement.hero_area')
    @include('user.indexElement.service_area')
    @include('user.indexElement.approach_area')
	@include('user.indexElement.testimonial_area')
@endsection