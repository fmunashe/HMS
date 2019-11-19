@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Registered Product Lines <a href="{{route('createFacility')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Product Line</a></h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($facilities as $facility)
                        <tr>
                            <td>{{$facility->id}}</td>
                            <td>{{$facility->facility_name}}</td>
                            <td>{{$facility->facility_description}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/showFacility/{{$facility->id}}"><i class="custom-badge status-blue fa fa-eye m-r-5">&nbsp; Show</i></a>
                                        <a class="dropdown-item" href="/editFacility/{{$facility->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                        <a class="dropdown-item" href="/deleteFacility/{{$facility->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
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
