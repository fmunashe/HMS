@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Capture New Installment Details</h4>
                <form method="post" action="/updateInstallment/{{$installment->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Client ID Number</label>
                        <div class="col-md-10">
                            <input id="client_id" type="text" class="form-control @error('client_id') is-invalid @enderror" name="client_id" value="{{ $installment->client_id }}"  autocomplete="client_id" autofocus>
                            @error('client_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Loan ID</label>
                        <div class="col-md-10">
                            <input id="loan_id" type="text" class="form-control @error('loan_id') is-invalid @enderror" name="loan_id" value="{{ $installment->loan_id }}"  autocomplete="loan_id" autofocus>
                            @error('loan_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Account Number</label>
                        <div class="col-md-10">
                            <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ $installment->account_number }}"  autocomplete="account_number" autofocus>
                            @error('account_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Amount</label>
                        <div class="col-md-10">
                            <input id="amount" type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $installment->amount}}"  autocomplete="amount" autofocus>
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
                            <input id="currency" type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{ $installment->currency }}"  autocomplete="currency" autofocus readonly>
                            @error('currency')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Installment Number</label>
                        <div class="col-md-10">
                            <input id="installment_number" type="text" class="form-control @error('installment_number') is-invalid @enderror" name="installment_number" value="{{ $installment->installment_number }}"  autocomplete="installment_number" autofocus>
                            @error('installment_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">FT reference</label>
                        <div class="col-md-10">
                            <input id="ft_reference" type="text" class="form-control @error('ft_reference') is-invalid @enderror" name="ft_reference" value="{{ $installment->ft_reference }}"  autocomplete="ft_reference" autofocus>
                            @error('ft_reference')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Captured By</label>
                        <div class="col-md-10">
                            <input id="captured_by" type="text" class="form-control @error('captured_by') is-invalid @enderror" name="captured_by" value="{{auth()->user()->name }}"  autocomplete="captured_by" autofocus readonly>
                            @error('captured_by')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Update Installment Details') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
