@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Role Registration</h4>
                <form method="post" action="{{route('createRole')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Role Name</label>
                        <div class="col-md-10">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <h6 class="card-title m-b-20">Assign Permissions</h6>
                    <div class="m-b-30">
                        <ul class="list-group">
                            @foreach($permissions as $permission)
                            <li class="list-group-item">
                                {{$permission->name}}
                                    <input name="permission_name[{{$permission->name}}]" value="{{$permission->name}}" type="checkbox" class="pull-right">
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Role') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
