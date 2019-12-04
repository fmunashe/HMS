@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Registered Assets @hasanyrole('administrator|stores_clerk') <a href="{{route('createAsset')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Asset</a> <a href="{{route('importFile')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Bulk Import</a>@endhasanyrole</h4>
                <table id="asset" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Asset Number</th>
                        <th>Serial Number</th>
                        <th>Asset Name</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Client</th>
                        <th>Branch</th>
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
                           <td>@if(($asset->status=='100')or($asset->status=='101')){{$asset->ClientId($asset->asset_number)}}@endif</td>
                            <td>@if(($asset->status=='100')or($asset->status=='101')){{$asset->Branch($asset->asset_number)}}@endif</td>
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
{{--                    <tr>--}}
{{--                        <th>Total Assets</th>--}}
{{--                        <th>{{$assets->count()}}</th>--}}
{{--                        <th>Allocated</th>--}}
{{--                        <th>{{$allocated}}</th>--}}
{{--                        <th>Reserved</th>--}}
{{--                        <th>{{$reserved}}</th>--}}
{{--                        <th>Remaining</th>--}}
{{--                        <th>{{$assets->count()-$allocated-$reserved}}</th>--}}
{{--                        <th></th>--}}
{{--                        <th></th>--}}
{{--                    </tr>--}}
                    </tbody>
                </table>
                <table class="table">
                    <tr>
                        <th>Total Assets</th>
                        <th>{{$assets->count()}}</th>
                        <th>Allocated</th>
                        <th>{{$allocated}}</th>
                        <th>Reserved</th>
                        <th>{{$reserved}}</th>
                        <th>Remaining</th>
                        <th>{{$assets->count()-$allocated-$reserved}}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src=" https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src=" https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#asset').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'pageLength','colvis',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        filename: 'Assets report',
                        title:'Assets Statistics Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7 ]
                        }
                    },
                    {
                        extend: 'print',
                        orientation:'landscape',
                        title:'Assets Statistics Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7 ]
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
