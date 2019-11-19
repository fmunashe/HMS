@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="card-title">New Loan Entry Form</h4>
                <form method="post" action="{{route('createLoan')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Facility Category</label>
                                <div class="col-md-9">
                                    <select id="facility_category" class="form-control @error('facility_category') is-invalid @enderror" name="facility_category" value="{{ old('facility_category') }}"  autocomplete="facility_category" autofocus>
                                        <option value="">Select Facility Category</option>
                                        @foreach($facilities as $facility)
                                            <option value="{{$facility->facility_name}}">{{$facility->facility_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('facility_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Client ID</label>
                                <div class="col-md-9">
                                    <input id="client_id" type="text" class="form-control @error('client_id') is-invalid @enderror" name="client_id" value="{{ old('client_id') }}"  autocomplete="client_id" autofocus>
                                    @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Asset Number</label>
                                <div class="col-md-9">
                                        <input id="asset_number" type="text" class="form-control @error('asset_number') is-invalid @enderror" name="asset_number" value="{{ old('asset_number') }}"  autocomplete="asset_number" autofocus>
                                        @error('asset_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Principal Amount</label>
                                <div class="col-md-9">
                                    <input id="loan_amount" onkeyup="check1()" type="text" class="form-control @error('loan_amount') is-invalid @enderror" name="loan_amount" value="{{ old('loan_amount') }}"  autocomplete="loan_amount" autofocus>
                                    @error('loan_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Start Date</label>
                                <div class="col-md-9">
                                    <input id="establishment_date" type="date" class="form-control @error('establishment_date') is-invalid @enderror" name="establishment_date" value="{{ old('establishment_date') }}"  autocomplete="establishment_date" autofocus>
                                    @error('establishment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">End Date</label>
                                <div class="col-md-9">
                                    <input id="end_date" onchange="check1()" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}"  autocomplete="end_date" autofocus>
                                    @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Repayment</label>
                                <div class="col-md-9">
                                    <select id="repayment_frequency" onchange="check1()" class="form-control @error('repayment_frequency') is-invalid @enderror" name="repayment_frequency" value="{{ old('repayment_frequency') }}"  autocomplete="repayment_frequency" autofocus>
                                        <option value="">Select repayment frequency</option>
                                      @foreach($frequencies as $frequency)
                                        <option value="{{$frequency->frequency_number}}">{{$frequency->frequency_name}}</option>
                                      @endforeach
                                    </select>
                                    @error('repayment_frequency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Interest Rate</label>
                                <div class="col-md-9">
                                    <select id="applicable_interest" onchange="check1()" class="form-control @error('applicable_interest') is-invalid @enderror" name="applicable_interest" value="{{ old('applicable_interest') }}"  autocomplete="applicable_interest" autofocus>
                                        <option value="">Set Interest Rate</option>
                                        @foreach($rates as $rate)
                                            <option value="{{$rate->interest_percentage}}">{{$rate->interest_percentage*100 ." %"}}</option>
                                        @endforeach
                                    </select>
                                    @error('applicable_interest')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Penalt Rate</label>
                                <div class="col-md-9">
                                    <select id="applicable_penalt" class="form-control @error('applicable_penalt') is-invalid @enderror" name="applicable_penalt" value="{{ old('applicable_penalt') }}"  autocomplete="applicable_penalt" autofocus>
                                        <option value="">Set Penalt Rate</option>
                                        @foreach($rates as $rate)
                                            <option value="{{$rate->interest_percentage}}">{{$rate->interest_percentage*100 ." %"}}</option>
                                        @endforeach
                                    </select>
                                    @error('applicable_penalt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Collateral</label>
                                <div class="col-md-9">
                                    <input id="collateral" type="text" class="form-control @error('collateral') is-invalid @enderror" name="collateral" value="{{ old('collateral') }}"  autocomplete="collateral" autofocus>
                                    @error('collateral')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Period</label>
                                <div class="col-md-9">
                                    <input id="period" type="number" min="1" class="form-control @error('period') is-invalid @enderror" name="period" value="{{ old('period') }}"  autocomplete="period" readonly autofocus>
                                    @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Total Installments </label>
                                <div class="col-md-9">
                                    <input id="total_installments" type="number" min="1" class="form-control @error('total_installments') is-invalid @enderror" name="total_installments" value="{{ old('total_installments') }}"placeholder="Total number of installments"  autocomplete="total_installaments" readonly autofocus>
                                    @error('total_installments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Amount </label>
                                <div class="col-md-9">
                                    <input id="installment_amount" type="text" class="form-control @error('installment_amount') is-invalid @enderror" name="installment_amount" value="{{ old('installment_amount') }}" placeholder="Amount payable per installment"  autocomplete="installment_amount" readonly autofocus>
                                    @error('installment_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Total Payable </label>
                                <div class="col-md-9">
                                    <input id="total_amount_payable" type="text" class="form-control @error('total_amount_payable') is-invalid @enderror" name="total_amount_payable" value="{{ old('total_amount_payable') }}"  autocomplete="total_amount_payable" readonly autofocus>
                                    @error('total_amount_payable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success form-control" type="submit" onmouseover="check1()" onclick="check1()">{{ __('Post New Loan') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript">
        let principal;
        let startDate;
        let endDate;
        let period;
        let frequency;
        let interest;
        let totalInstallments;
        let installmentAmount;
        let totalPayable;
        let timeDiff;
        let diffDays;
        let result;
        let cal;
        function check1() {
            principal=+(document.getElementById('loan_amount').value);
            startDate=new Date(document.getElementById('establishment_date').value);
            endDate=new Date(document.getElementById('end_date').value);
            timeDiff= Math.abs(endDate.getTime() - startDate.getTime());
            result=timeDiff;
            diffDays=Math.ceil(result / (1000 * 3600 * 24));
            period=Math.ceil(diffDays/365);
            document.getElementById('period').value=period;
            frequency=+(document.getElementById('repayment_frequency').value);
            totalInstallments=frequency*period;
            document.getElementById('total_installments').value=totalInstallments;
            interest=+(document.getElementById('applicable_interest').value);
            cal=principal*interest;
            totalPayable=principal+cal;
            document.getElementById('total_amount_payable').value=totalPayable.toFixed(2);
            installmentAmount=totalPayable/totalInstallments;
            document.getElementById('installment_amount').value=installmentAmount.toFixed(2);
        }
    </script>
@endsection
