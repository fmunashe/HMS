@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('image')
    <div style="background-image: url({{ asset('/image/503.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
