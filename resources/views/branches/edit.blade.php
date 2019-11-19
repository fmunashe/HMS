@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Update Branch Details</h4>
                <form method="post" action="/updateBranch/{{$branch->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Branch Code</label>
                        <div class="col-md-10">
                            <input id="branch_code" type="text" class="form-control @error('branch_code') is-invalid @enderror" name="branch_code" value="{{ $branch->branch_code }}"  autocomplete="branch_code" autofocus>
                            @error('branch_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Branch Name</label>
                        <div class="col-md-10">
                            <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ $branch->branch_name }}"  autocomplete="branch_name" autofocus>
                            @error('branch_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Branch Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
