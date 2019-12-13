@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Guarantee Registration</h4>
                <form method="post" action="/updateGuarantee/{{$guarantee->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Customer ID</label>
                        <div class="col-md-4">
                            <input id="customer_id" type="text" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" value="{{ $guarantee->customer_id}}"  autocomplete="customer_id" autofocus required>
                            @error('customer_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        {{--                    </div>--}}
                        {{--                    <div class="form-group row">--}}
                        <label class="col-form-label col-md-2">Guarantee Type</label>
                        <div class="col-md-4">
                            <select id="guarantee_type" type="text" class="form-control @error('guarantee_type') is-invalid @enderror" name="guarantee_type" value="{{ old('guarantee_type') }}"  autocomplete="guarantee_type" autofocus required>
                                <option value="">Select Guarantee Type</option>
                                @foreach($guaranteeTypes as $guaranteeType)
                                    <option value="{{$guaranteeType->id}}">{{$guaranteeType->guarantee_type}}</option>
                                @endforeach
                            </select>
                            @error('guarantee_type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Amount Guaranteed</label>
                        <div class="col-md-4">
                            <input id="amount_guaranteed" type="number" min="0.01" step="0.01" class="form-control @error('amount_guaranteed') is-invalid @enderror" name="amount_guaranteed" value="{{ $guarantee->amount_guaranteed }}"  autocomplete="amount_guaranteed" autofocus required>
                            @error('amount_guaranteed')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        {{--                    </div>--}}
                        {{--                    <div class="form-group row">--}}
                        <label class="col-form-label col-md-2">Beneficiary</label>
                        <div class="col-md-4">
                            <input id="beneficiary" type="text" class="form-control @error('beneficiary') is-invalid @enderror" name="beneficiary" value="{{ $guarantee->beneficiary }}"  autocomplete="beneficiary" autofocus required>
                            @error('beneficiary')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Start Date</label>
                        <div class="col-md-4">
                            <input id="start_date" type="date" onchange="check1()"  class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ $guarantee->start_date }}"  autocomplete="start_date" autofocus required>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        {{--                    </div>--}}
                        {{--                    <div class="form-group row">--}}
                        <label class="col-form-label col-md-2">Security</label>
                        <div class="col-md-4">
                            <input id="guarantee_type" type="text" class="form-control @error('security') is-invalid @enderror" name="security" value="{{ $guarantee->security }}"  autocomplete="security" autofocus required>
                            @error('security')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">End Date</label>
                        <div class="col-md-4">
                            <input id="end_date" type="date" onchange="check1()" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ $guarantee->end_date }}"  autocomplete="end_date" autofocus required>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        {{--                    </div>--}}
                        {{--                    <div class="form-group row">--}}
                        <label class="col-form-label col-md-2">Tenor (In Days)</label>
                        <div class="col-md-4">
                            <input id="period" type="text" class="form-control @error('period') is-invalid @enderror" name="period" value="{{ $guarantee->period }}"  autocomplete="period" autofocus readonly required>
                            @error('period')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit" onmouseover="check1()">{{ __('Update Guarantee Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript">
        let startDate;
        let endDate;
        let period;
        let timeDiff;
        let diffDays;
        let result;
        function check1() {
            startDate=new Date(document.getElementById('start_date').value);
            endDate=new Date(document.getElementById('end_date').value);
            timeDiff= Math.abs(endDate.getTime() - startDate.getTime());
            result=timeDiff;
            diffDays=Math.ceil(result / (1000 * 3600 * 24));
            period=Math.ceil(diffDays);
            document.getElementById('period').value=period;
        }
    </script>
@endsection
