@extends('layouts.app')
@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card-box">--}}
{{--                <div class="col-lg-12 col-xs-12">--}}
{{--                    {!! $realtime->html() !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <div class="col-lg-12 col-xs-12">
                    {!! $clients->html() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <div class="col-lg-12 col-xs-12">
                    {!! $data->html() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <div class="col-lg-12 col-xs-12">
                    {!! $totalloans->html() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <div class="col-lg-12 col-xs-12">
                    {!! $unauthorised->html() !!}
                </div>
            </div>
        </div>
    </div>

    {!! Charts::scripts() !!}
    {!! $data->script() !!}
    {!! $clients->script() !!}
{{--    {!! $realtime->script() !!}--}}
    {!! $totalloans->script() !!}
    {!! $unauthorised->script() !!}
@endsection
