@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="card-title">Registered Clients for :{{auth()->user()->BranchName(auth()->user()->branch)}} &nbsp;Branch @hasanyrole('inputter|administrator')<a href="{{route('createCustomer')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Client</a>@endhasanyrole</h4>
            <table class="table table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Branch</th>
                    <th>Name</th>
                    <th>Account</th>
                    <th>National ID</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->BranchName($customer->branch_code)}}</td>
                    <td>{{$customer->full_name}}</td>
                    <td>{{$customer->account}}</td>
                    <td>{{$customer->national_id}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->address}}</td>
                    <td>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/showBranchCustomer/{{$customer->id}}"><i class="custom-badge status-blue fa fa-eye m-r-5">&nbsp; Show</i></a>
                                @hasanyrole('inputter|administrator')
                                <a class="dropdown-item" href="/editCustomer/{{$customer->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                <a class="dropdown-item" href="/deleteCustomer/{{$customer->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
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
