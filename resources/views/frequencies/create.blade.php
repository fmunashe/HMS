@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Branch Registration</h4>
                <form method="post" action="{{route('createFrequency')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Frequency Number</label>
                        <div class="col-md-10">
                            <input id="frequency_number" type="text" class="form-control @error('frequency_number') is-invalid @enderror" name="frequency_number" value="{{ old('frequency_number') }}"  autocomplete="frequency_number" autofocus>
                            @error('frequency_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Frequency Name</label>
                        <div class="col-md-10">
                            <input id="frequency_name" type="text" class="form-control @error('frequency_name') is-invalid @enderror" name="frequency_name" value="{{ old('frequency_name') }}"  autocomplete="frequency_name" autofocus>
                            @error('frequency_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Repayment Frequency') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
