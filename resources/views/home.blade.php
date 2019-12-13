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

<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <div class="col-lg-12 col-xs-12">
                {!! $unauthorisedInstallments->html() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-box">
            <div class="col-lg-12 col-xs-12">
                {!! $guaranteesissued->html() !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <div class="col-lg-12 col-xs-12">
                {!! $stats->html() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-box">
            <div class="col-lg-12 col-xs-12">
                {!! $unauthorisedGuarantees->html() !!}
            </div>
        </div>
    </div>
</div>

    {!! Charts::scripts() !!}
    {!! $data->script() !!}
    {!! $clients->script() !!}
    {!! $guaranteesissued->script() !!}
    {!! $totalloans->script() !!}
    {!! $unauthorised->script() !!}
    {!! $unauthorisedInstallments->script() !!}
    {!! $stats->script() !!}
    {!! $unauthorisedGuarantees->script() !!}
@endsection
