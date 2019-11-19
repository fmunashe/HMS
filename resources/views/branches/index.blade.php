@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Registered Branches <a href="{{route('createBranch')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Branch</a></h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Branch Code</th>
                        <th>Branch Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branches as $branch)
                    <tr>
                        <td>{{$branch->id}}</td>
                        <td>{{$branch->branch_code}}</td>
                        <td>{{$branch->branch_name}}</td>
                        <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/editBranch/{{$branch->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                    <a class="dropdown-item" href="/deleteBranch/{{$branch->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
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
