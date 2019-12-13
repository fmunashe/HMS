@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Update Guarantee Type Details</h4>
                <form method="post" action="/updateGuaranteeType/{{$guaranteeType->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Guarantee Type</label>
                        <div class="col-md-10">
                            <input id="guarantee_type" type="text" class="form-control @error('guarantee_type') is-invalid @enderror" name="guarantee_type" value="{{ $guaranteeType->guarantee_type }}"  autocomplete="guarantee_type" autofocus>
                            @error('guarantee_type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Guarantee Type Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
