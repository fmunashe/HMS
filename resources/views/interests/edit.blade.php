@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Update Interest Rate</h4>
                <form method="post" action="/updateInterest/{{$interest->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Interest Percentage</label>
                        <div class="col-md-10">
                            <input id="interest_percentage" type="text" class="form-control @error('interest_percentage') is-invalid @enderror" name="interest_percentage" value="{{ $interest->interest_percentage*100 }}"  autocomplete="interest_percentage" autofocus>
                            @error('interest_percentage')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Interest Rate Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
