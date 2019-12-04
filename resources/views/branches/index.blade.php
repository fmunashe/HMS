@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Registered Branches <a href="{{route('createBranch')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Branch</a></h4>
                <table id="branch" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Branch Code</th>
                        <th>Branch Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branches as $branch)
                    <tr>
                        <td>{{$branch->id}}</td>
                        <td>{{$branch->branch_code}}</td>
                        <td>{{$branch->branch_name}}</td>
                        <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/editBranch/{{$branch->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Edit</i></a>
                                    <a class="dropdown-item" href="/deleteBranch/{{$branch->id}}"><i class="custom-badge status-red fa fa-trash-o m-r-5">&nbsp;Delete</i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>

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
    <script>
        $(document).ready(function() {
            $('#branch').DataTable( {
                ordering:true,
                dom: 'Bfrtip',
                buttons: [
                    'pageLength','copy',
                    {
                        extend: 'pdf',
                        filename: 'Branches report',
                        title:'Registered Branches'
                    },
                    {
                        extend:'excel',
                        filename: 'Branches report',
                        title:'Registered Branches'
                    },
                    {
                        extend: 'csv',
                        filename: 'Branches report',
                        title:'Registered Branches'
                    },
                    {
                        extend: 'print',
                        filename: 'Branches report',
                        title:'Registered Branches'
                    },

                ]
            } );
        } );
    </script>
@endsection
