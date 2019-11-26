@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Roles & Permissions <a href="{{route('permissions')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-eye"></i> Permissions</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
            <a href="{{route('createRole')}}" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add Roles</a>
            <div class="roles-menu">
                <ul class="list-group">
                    @foreach($roles as $role)
                    <li>
                        <a href="/showRole/{{$role->id}}">{{$role->name}}</a>
                        <span class="role-action">
                            <a href="/deleteRole/{{$role->id}}">
                                <span>
                                    <i class="fa fa-trash status-green"></i>
                                </span>
                            </a>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
            <h6 class="card-title m-b-20">Role Access</h6>
            <div class="m-b-30">
                <ul class="list-group">
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $name)
                            <li class="list-group-item">
                                {{ $name->name }}
                            </li>
                            @endforeach
                        @endif
                </ul>
        </div>
    </div>
    </div>
@endsection
