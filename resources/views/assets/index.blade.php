@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Registered Assets <a href="{{route('createAsset')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Asset</a> <a href="{{route('importFile')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Bulk Import</a></h4>
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Asset Number</th>
                        <th>Serial Number</th>
                        <th>Asset Name</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assets as $asset)
                        <tr>
                            <td>{{$asset->id}}</td>
                            <td>{{$asset->asset_number}}</td>
                            <td>{{$asset->serial_number}}</td>
                            <td>{{$asset->asset_name}}</td>
                            <td>{{$asset->asset_value}}</td>
                            <td>@if($asset->status=="100")<i class="custom-badge badge-danger-border">{{$asset->AssetStatus($asset->status)}}</i>@elseif($asset->status=="101")<i class="custom-badge badge-warning-border">{{$asset->AssetStatus($asset->status)}}</i>@else<i class="custom-badge badge-success-border">{{$asset->AssetStatus($asset->status)}}</i>@endif</td>
                            <td>{{$asset->asset_description}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/editAsset/{{$asset->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                        <a class="dropdown-item" href="/deleteAsset/{{$asset->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Total Assets</th>
                        <th>{{$assets->count()}}</th>
                        <th>Allocated</th>
                        <th>{{$allocated}}</th>
                        <th>Reserved</th>
                        <th>{{$reserved}}</th>
                        <th>Remaining</th>
                        <th>{{$assets->count()-$allocated-$reserved}}</th>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
