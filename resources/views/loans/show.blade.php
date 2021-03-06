@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="{{route('myLoans')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-backward"></i> Back</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                            <div class="col-6 col-sm-6 m-b-20">
                                <img src="{{asset('frontend/assets/img/loans.JPG')}}" class="inv-logo" alt="">
                            </div>
                            <div class="col-6 col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-lowercasecase">Loan #{{$loan->loan_id}}</h3>
                                    <ul class="list-unstyled">
                                        <li>Start Date: <span>{{$loan->establishment_date}}</span></li>
                                        <li>End date: <span>{{$loan->end_date}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 m-b-20">
                                <h6><strong>Client Details</strong></h6>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><h6>Name:</h6></td>
                                    <td>{{$client->full_name}}</td>
                                    <td><h6>National Id:</h6></td>
                                    <td>{{$client->national_id}}</td>
                                    <td><h6>Account Number:</h6></td>
                                    <td>{{$client->account}}</td>
                                </tr>
                                <tr>
                                    <td><h6>Email:</h6></td>
                                    <td>{{$client->email}}</td>
                                    <td><h6>Phone Number:</h6></td>
                                    <td>{{$client->phone}}</td>
                                    <td><h6>Address:</h6></td>
                                    <td>{{$client->address}}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-lg-6 m-b-20">
                                <h6><strong>Loan Details</strong></h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><h6>Principal Amount:</h6></td>
                                    <td>{{$loan->loan_amount}}</td>
                                    <td><h6>Repayment Frequency:</h6></td>
                                    <td>{{$loan->FrequencyName($loan->repayment_frequency)}}</td>
                                    <td><h6>Installment Amount:</h6></td>
                                    <td>{{number_format($loan->installment_amount,2)}}</td>
                                </tr>
                                <tr>
                                    <td><h6>Tenor:</h6></td>
                                    <td>@if($loan->period=="1"){{$loan->period." year"}}@else {{$loan->period." years"}}@endif</td>
                                    <td><h6>Total Installments:</h6></td>
                                    <td>{{$loan->total_installments}}</td>
                                    <td><h6>Branch:</h6></td>
                                    <td>{{$loan->BranchName($loan->branch)}}</td>
                                </tr>
                                <tr>
                                    <td><h6>Interest: </h6></td>
                                    <td>{{$loan->applicable_interest*100 ."%"}}</td>
                                    <td><h6>Penalty:</h6></td>
                                    <td>{{$loan->applicable_penalt*100 ."%"}}</td>
                                    <td><h6>Status:</h6></td>
                                    <td>@if($loan->status=="103" or $loan->status=="106" or $loan->status=="108")<i class="custom-badge badge-danger-border">{{$loan->StatusName($loan->status)}}</i>@else<i class="custom-badge badge-success-border">{{$loan->StatusName($loan->status)}}</i>@endif</td>
                                </tr>
                                @foreach($assets as $asset)
                                <tr>
                                    <td><h6>Asset Name: </h6></td>
                                    <td>{{$asset->AssetName($asset->asset_number)}}</td>
                                    <td><h6>Asset Number:</h6></td>
                                    <td>{{$asset->asset_number}}</td>
                                    <td><h6>Description:</h6></td>
                                    <td>{{$asset->AssetDesc($asset->asset_number)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td><h6>Collateral (1): </h6></td>
                                    <td>{{$loan->collateral}}</td>
                                    <td><h6>Collateral (2):</h6></td>
                                    <td>{{$loan->optional_collateral}}</td>
                                    <td><h6>&nbsp;</h6></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><h6>Product Line: </h6></td>
                                    <td>{{$loan->facility_category}}</td>
                                    <td><h6>Captured By:</h6></td>
                                    <td>{{$loan->captured_by}}</td>
                                    <td><h6>Authorised By:</h6></td>
                                    <td>{{$loan->authorised_by}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 m-b-20">
                                <h6><strong>Loan Schedule</strong></h6>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <td><h6>Period</h6></td>
                                    <td><h6>Opening Balance</h6></td>
                                    <td><h6>Total Installment Due</h6></td>
                                    <td><h6>Interest</h6></td>
                                    <td><h6>Amount Paid</h6></td>
                                    <td><h6>Capital Repayment</h6></td>
                                    <td><h6>Closing Balance</h6></td>
{{--                                    <td><h6>Start Date</h6></td>--}}
{{--                                    <td><h6>End Date</h6></td>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{$schedule->period}}</td>
                                        <td>{{number_format($schedule->opening_balance,2)}}</td>
                                        <td>{{number_format($schedule->installment,2)}}</td>
                                        <td>{{number_format($schedule->interest,2)}}</td>
                                        <td>{{$schedule->paid_amount}}</td>
                                        <td>{{number_format($schedule->capital_repayment,2)}}</td>
                                        <td>{{number_format($schedule->closing_balance,2)}}</td>
{{--                                        <td>{{$schedule->start_date}}</td>--}}
{{--                                        <td>{{$schedule->end_date}}</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="row">
                            <div class="col-sm-6 col-lg-6 m-b-20">
                                <h6><strong>Installment Details</strong></h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <td><h6>#</h6></td>
                                    <td><h6>DATE</h6></td>
                                    <td><h6>CAPTURED BY</h6></td>
                                    <td><h6>REFERENCE</h6></td>
                                    <td><h6>CURRENCY</h6></td>
                                    <td><h6>TOTAL</h6></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($installments as $installment)
                                <tr>
                                    <td>{{$installment->id}}</td>
                                    <td>{{$installment->created_at}}</td>
                                    <td>{{$installment->captured_by}}</td>
                                    <td>{{$installment->ft_reference}}</td>
                                    <td>{{$installment->currency}}</td>
                                    <td>{{$installment->amount}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <h6>Payment Breakdown</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                <tr>
                                                    <th>Total Payable:</th>
                                                    <td class="text-right text-primary">
                                                        <h5>{{number_format($loan->total_amount_payable,2)}}</h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Paid Amount:</th>
                                                    <td class="text-right">{{number_format($loan->paid_amount,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Outstanding Balance:</th>
                                                    <td class="text-right">{{number_format($loan->outstanding,2)}}</td>
                                                </tr>
                                                </tbody>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-right">
                                                        @hasrole('authorizer')
                                                        <a class="dropdown-item" href="/authorizeLoan/{{$loan->id}}"><i class="custom-badge status-green fa fa-thumbs-up m-r-5">&nbsp Authorize</i></a>
                                                       @endhasrole
                                                        @hasrole('inputter')
                                                        <a class="dropdown-item" href="/rejectLoan/{{$loan->id}}"><i class="custom-badge status-red fa fa-thumbs-up m-r-5">&nbsp Rollback</i></a>
                                                        @endhasrole
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
