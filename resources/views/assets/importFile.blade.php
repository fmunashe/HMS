@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">New Assets Bulk Registration</h4>
                <form method="post" action="{{route('importAsset')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-md-2"></label>
                            <div class="col-md-10">
                                <input class="form-control form-check " name="assetFile" type="file">
                                @if($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <ol>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error}}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                @endif
                            </div>
                        </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button class="btn btn-success form-control" type="submit">{{ __('Bulk Asset Upload') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
