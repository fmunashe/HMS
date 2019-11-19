@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">My Loans <a href="{{route('createLoan')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Loan</a></h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Facility</th>
                        <th>Branch</th>
                        <th>Loan</th>
                        <th>Asset</th>
                        <th>Amount</th>
                        <th>Period</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Outstanding</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myLoans as $loan)
                        <tr>
                            <td>{{$loan->id}}</td>
                            <td>{{$loan->facility_category}}</td>
                            <td>{{$loan->branch}}</td>
                            <td>{{$loan->loan_id}}</td>
                            <td>{{$loan->asset_number}}</td>
                            <td>{{$loan->total_amount_payable}}</td>
                            <td>{{$loan->period}}</td>
                            <td>@if($loan->status=="103" or $loan->status=="106" or $loan->status=="108")<i class="custom-badge badge-danger-border">{{$loan->StatusName($loan->status)}}</i>@else<i class="custom-badge badge-success-border">{{$loan->StatusName($loan->status)}}</i>@endif</td>
                            <td>{{$loan->paid_amount}}</td>
                            <td>{{$loan->outstanding}}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
