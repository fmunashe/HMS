@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Client Registration</h4>
                <form method="post" action="{{route('createCustomer')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Branch Code</label>
                        <div class="col-md-10">
                            <input id="branch_code" type="text" class="form-control @error('branch_code') is-invalid @enderror" name="branch_code" value="{{ auth()->user()->branch }}"  autocomplete="branch_code" readonly autofocus>
                            @error('branch_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Full Name</label>
                        <div class="col-md-10">
                            <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}"  autocomplete="full_name" autofocus>
                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Account</label>
                        <div class="col-md-10">
                            <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}"  autocomplete="account" autofocus>
                            @error('account')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">National ID Number</label>
                        <div class="col-md-10">
                            <input id="national_id" type="text" class="form-control @error('national_id') is-invalid @enderror" name="national_id" value="{{ old('national_id') }}"  autocomplete="national_id" autofocus>
                            @error('national_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Email Address</label>
                        <div class="col-md-10">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Phone Number</label>
                        <div class="col-md-10">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Physical Address</label>
                        <div class="col-md-10">
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  autocomplete="address" autofocus></textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Client') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

