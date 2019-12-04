@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Capture New Installment Details</h4>
                <form method="post" action="{{route('createInstallment')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Loan ID</label>
                        <div class="col-md-10">
                            <input id="loan_id" type="text" class="form-control @error('loan_id') is-invalid @enderror" name="loan_id" value="{{ old('loan_id') }}"  autocomplete="loan_id" autofocus onkeyup="callId(this.value)">
                            @error('loan_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Amount</label>
                        <div class="col-md-10">
                            <input id="amount" type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}"  autocomplete="amount" autofocus>
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Currency</label>
                        <div class="col-md-10">
                            <input id="currency" type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{ $currency->currency_name }}"  autocomplete="currency" autofocus readonly>
                            @error('currency')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">FT Reference</label>
                        <div class="col-md-10">
                            <input id="ft_reference" type="text" class="form-control @error('ft_reference') is-invalid @enderror" name="ft_reference" value="{{ old('ft_reference') }}"  autocomplete="ft_reference" autofocus>
                            @error('ft_reference')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Effective Date</label>
                        <div class="col-md-10">
                            <input id="effective_date" type="date" class="form-control @error('effective_date') is-invalid @enderror" name="effective_date" value="{{ old('effective_date') }}"  autocomplete="effective_date" autofocus>
                            @error('effective_date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-form-label col-md-2"></label>--}}
{{--                        <div class="col-md-10">--}}
{{--                            <div class="checkbox">--}}
{{--                                <label>--}}
{{--                                    <input id="over_payment" type="checkbox" name="over_payment" class="form-check-inline" onclick="check()"> Over Payment ?--}}
{{--                                </label>--}}
{{--                           </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-form-label col-md-2" id="install">Installments</label>--}}
{{--                        <div class="col-md-10">--}}
{{--                            <input id="installments" type="text" class="form-control @error('installments') is-invalid @enderror" name="installments" value="{{old('installments') }}"  autocomplete="installments" autofocus>--}}
{{--                            @error('installments')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Record New Installment') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
{{--    <script type="text/javascript">--}}
{{--        window.onload=function(){--}}
{{--            document.getElementById('installments').style.display = 'none';--}}
{{--            document.getElementById('install').style.display = 'none';--}}
{{--        };--}}
{{--        function check() {--}}
{{--            if (document.getElementById('over_payment').checked) {--}}
{{--                document.getElementById('installments').style.display = 'block';--}}
{{--                document.getElementById('installments').required = true;--}}
{{--                document.getElementById('install').style.display = 'block';--}}
{{--            }--}}
{{--            else{--}}
{{--                document.getElementById('installments').style.display = "none";--}}
{{--                document.getElementById('installments').required = false;--}}
{{--                document.getElementById('install').style.display = "none";--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endsection
