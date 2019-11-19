@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Registered Currencies <a href="{{route('createCurrency')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Currency</a></h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Currency Code</th>
                        <th>Currency Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currencies as $currency)
                        <tr>
                            <td>{{$currency->id}}</td>
                            <td>{{$currency->currency_code}}</td>
                            <td>{{$currency->currency_name}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/editCurrency/{{$currency->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                        <a class="dropdown-item" href="/deleteCurrency/{{$currency->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
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
