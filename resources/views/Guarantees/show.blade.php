@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="{{route('guarantees')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-backward"></i> Back</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                            <div class="col-6 col-sm-6 m-b-20">
                                <img src="{{asset('frontend/assets/img/farm.png')}}" class="inv-logo" alt="">
                            </div>
                            <div class="col-6 col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-lowercasecase">Guarantee #{{$guarantee->guarantee_number}}</h3>
                                    <ul class="list-unstyled">
                                        <li>Start Date: <span>{{$guarantee->start_date}}</span></li>
                                        <li>End date: <span>{{$guarantee->end_date}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 m-b-20">
                                <h6><strong>Guarantee Details</strong></h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><h6>Customer:</h6></td>
                                    <td>{{$guarantee->Customer($guarantee->customer_id)}}</td>
                                    <td><h6>Branch:</h6></td>
                                    <td>{{$guarantee->Branch($guarantee->branch)}}</td>
                                    <td><h6>Guarantee Type:</h6></td>
                                    <td>{{$guarantee->GuaranteeType($guarantee->guarantee_type)}}</td>
                                </tr>
                                <tr>
                                    <td><h6>Amount Guaranteed:</h6></td>
                                    <td>{{$guarantee->amount_guaranteed}}</td>
                                    <td><h6>Beneficiary:</h6></td>
                                    <td>{{$guarantee->beneficiary}}</td>
                                    <td><h6>Security: </h6></td>
                                    <td>{{$guarantee->security}}</td>
                                </tr>
                                <tr>
                                    <td><h6>Start Date:</h6></td>
                                    <td>{{$guarantee->start_date}}</td>
                                    <td><h6>End Date:</h6></td>
                                    <td>{{$guarantee->end_date}}</td>
                                    <td><h6>Tenor:</h6></td>
                                    <td>@if($guarantee->period=="1"){{$guarantee->period." day"}}@else {{$guarantee->period." days"}}@endif</td>
                                </tr>
                                <tr>
                                    <td><h6>Captured By: </h6></td>
                                    <td>{{$guarantee->captured_by}}</td>
                                    <td><h6>Status:</h6></td>
                                    <td>@if($guarantee->status=="0")<i class="custom-badge badge-danger-border">Unauthorised</i>@else<i class="custom-badge badge-success-border">Authorised</i>@endif</td>
                                    <td><h6>Authorised By:</h6></td>
                                    <td>{{$guarantee->authorised_by}}</td>
                                </tr>
                            </table>
                            @hasanyrole('administrator|authorizer')
                            <a class="dropdown-item pull-right" href="/authorizeGuarantee/{{$guarantee->id}}"><i class="custom-badge status-green fa fa-thumbs-up m-r-5 pull-right">&nbsp Authorize</i></a>
                            @endhasanyrole
                            @hasanyrole('inputter|administrator')
                            <a class="dropdown-item" href="/deleteGuarantee/{{$guarantee->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5 pull-right">&nbsp;Roll Back</i></a>
                            @endhasanyrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
