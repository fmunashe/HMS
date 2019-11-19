@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Update Status Details</h4>
                <form method="post" action="/updateStatus/{{$status->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Status Code</label>
                        <div class="col-md-10">
                            <input id="status_code" type="text" class="form-control @error('status_code') is-invalid @enderror" name="status_code" value="{{ $status->status_code }}"  autocomplete="status_code" autofocus>
                            @error('status_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Status Name</label>
                        <div class="col-md-10">
                            <input id="status_name" type="text" class="form-control @error('status_name') is-invalid @enderror" name="status_name" value="{{ $status->status_name }}"  autocomplete="status_name" autofocus>
                            @error('status_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Status Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
