@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Installments Recorded <a href="{{route('createInstallment')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Installment</a></h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Client ID</th>
                        <th>Loan ID</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>FT Reference</th>
                        <th>Captured By</th>
                        <th>Captured Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($installments as $installment)
                        <tr>
                            <td>{{$installment->id}}</td>
                            <td>{{$installment->client_id}}</td>
                            <td>{{$installment->loan_id}}</td>
                            <td>{{$installment->account_number}}</td>
                            <td>{{$installment->amount}}</td>
                            <td>{{$installment->currency}}</td>
                            <td>{{$installment->ft_reference}}
                            <td>{{$installment->captured_by}}</td>
                            <td>{{$installment->created_at}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/showInstallment/{{$installment->id}}"><i class="custom-badge status-blue fa fa-eye m-r-5">&nbsp; Show</i></a>
                                        <a class="dropdown-item" href="/editInstallment/{{$installment->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                        <a class="dropdown-item" href="/deleteInstallment/{{$installment->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
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
