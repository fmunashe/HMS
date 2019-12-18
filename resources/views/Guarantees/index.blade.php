@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Guarantees @hasanyrole('administrator|inputter')<a href="{{route('createGuarantee')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Guarantee</a>@endhasanyrole</h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Amount Guaranteed</th>
                        <th>Beneficiary</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Tenor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guarantees as $guarantee)
                        <tr>
                            <td>{{$guarantee->guarantee_number}}</td>
                            <td>{{$guarantee->Customer($guarantee->customer_id)}}</td>
                            <td>{{$guarantee->GuaranteeType($guarantee->guarantee_type)}}</td>
                            <td>{{number_format($guarantee->amount_guaranteed,2)}}</td>
                            <td>{{$guarantee->beneficiary}}</td>
                            <td>{{$guarantee->start_date}}</td>
                            <td>{{$guarantee->end_date}}</td>
                            <td>{{$guarantee->period ." days"}}</td>
                            <td>@if($guarantee->status=="0")<i class="custom-badge badge-danger-border">Unauthorised</i>@else<i class="custom-badge badge-success-border">Authorised</i>@endif</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/showGuarantee/{{$guarantee->id}}"><i class="custom-badge status-green fa fa-eye m-r-5">&nbsp; Show</i></a>
                                        @hasanyrole('inputter|administrator')
                                        <a class="dropdown-item" href="/editGuarantee/{{$guarantee->id}}"><i class="custom-badge status-blue fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                        @endhasanyrole
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
