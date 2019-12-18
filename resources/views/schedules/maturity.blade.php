@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Loan Maturity Report <a href="{{route('maturityReport')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-refresh"></i> Reload View</a></h4>
                <div class="row custom-invoice">
                    <div class="col-6 col-sm-6 m-b-20">
                        <img src="{{asset('frontend/assets/img/loans.JPG')}}" class="inv-logo" alt="">
                    </div>
                </div>
                <form action="{{route('searchMaturity')}}" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="searchLoan" class="form-control alert-success" placeholder="Search by branch or product line...........">
                        <span class="input-group-btn">
                                 <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                 </button>
                                 </span>
                    </div>
                </form>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Facility</th>
                        <th>Branch</th>
                        <th>Loan</th>
                        <th>Customer</th>
                        <th>Tenor</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Outstanding</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{$loan->id}}</td>
                            <td>{{$loan->facility_category}}</td>
                            <td>{{$loan->BranchName($loan->branch)}}</td>
                            <td>{{$loan->loan_id}}</td>
                            <td>{{$loan->ClientName($loan->client_id)}}</td>
                            <td>{{$loan->period}}</td>
                            <td>@if($loan->status=="103" or $loan->status=="106" or $loan->status=="108")<i class="custom-badge badge-danger-border">{{$loan->StatusName($loan->status)}}</i>@else<i class="custom-badge badge-success-border">{{$loan->StatusName($loan->status)}}</i>@endif</td>
                            <td>{{number_format($loan->paid_amount,2)}}</td>
                            <td>{{number_format($loan->outstanding,2)}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/showMaturity/{{$loan->id}}"><i class="custom-badge status-blue fa fa-eye m-r-5">&nbsp; Show</i></a>
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
