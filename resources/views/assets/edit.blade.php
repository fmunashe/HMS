@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Update Asset Details</h4>
                <form method="post" action="/updateAsset/{{$asset->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Asset Number</label>
                        <div class="col-md-10">
                            <input id="asset_number" type="text" class="form-control @error('asset_number') is-invalid @enderror" name="asset_number" value="{{ $asset->asset_number }}"  autocomplete="asset_number" autofocus>
                            @error('asset_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Asset Name</label>
                        <div class="col-md-10">
                            <input id="asset_name" type="text" class="form-control @error('asset_name') is-invalid @enderror" name="asset_name" value="{{ $asset->asset_name }}"  autocomplete="asset_name" autofocus>
                            @error('asset_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Serial Number</label>
                        <div class="col-md-10">
                            <input id="serial_number" type="text" class="form-control @error('serial_number') is-invalid @enderror" name="serial_number" value="{{ $asset->serial_number }}"  autocomplete="serial_number" autofocus>
                            @error('serial_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Asset Value</label>
                        <div class="col-md-10">
                            <input id="asset_value" type="text" class="form-control @error('asset_value') is-invalid @enderror" name="asset_value" value="{{ $asset->asset_value }}"  autocomplete="asset_value" autofocus>
                            @error('asset_value')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Asset Description</label>
                        <div class="col-md-10">
                            <textarea id="asset_description" type="text" class="form-control @error('asset_description') is-invalid @enderror" name="asset_description" value="{{ old('asset_description') }}"  autocomplete="asset_description" autofocus>{{$asset->asset_description}}</textarea>
                            @error('asset_description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Asset Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
