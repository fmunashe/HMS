@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Product Line Registration</h4>
                <form method="post" action="{{route('createFacility')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Product Name</label>
                        <div class="col-md-10">
                            <input id="facility_name" type="text" class="form-control @error('facility_name') is-invalid @enderror" name="facility_name" value="{{ old('facility_name') }}"  autocomplete="facility_name" autofocus>
                            @error('facility_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Product Description</label>
                        <div class="col-md-10">
                            <textarea id="facility_description" class="form-control @error('facility_description') is-invalid @enderror" name="facility_description" value="{{ old('facility_description') }}"  autocomplete="facility_description" autofocus></textarea>
                            @error('facility_description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Register New Product Line') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
