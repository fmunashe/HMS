@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">All Opened Loans @hasanyrole('inputter|administrator')<a href="{{route('createLoan')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Loan</a>@endhasanyrole</h4>
                <table id="loan" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Facility</th>
                        <th>Branch</th>
                        <th>Customer</th>
                        <th>Loan</th>
                        <th>Payable</th>
                        <th>Tenor</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Outstanding</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{$loan->id}}</td>
                            <td>{{$loan->facility_category}}</td>
                            <td>{{$loan->BranchName($loan->branch)}}</td>
                            <td>{{$loan->ClientName($loan->client_id)}}</td>
                            <td>{{$loan->loan_id}}</td>
                            <td>{{number_format($loan->total_amount_payable,2)}}</td>
                            <td>{{$loan->period}}</td>
                            <td>@if($loan->status=="103" or $loan->status=="106" or $loan->status=="108")<i class="custom-badge badge-danger-border">{{$loan->StatusName($loan->status)}}</i>@else<i class="custom-badge badge-success-border">{{$loan->StatusName($loan->status)}}</i>@endif</td>
                            <td>{{number_format($loan->paid_amount,2)}}</td>
                            <td>{{number_format($loan->outstanding,2)}}</td>
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/showAllLoan/{{$loan->id}}"><i class="custom-badge status-blue fa fa-eye m-r-5">&nbsp; Show</i></a>
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
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loan').DataTable( {
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
                        filename: 'loans',
                        title:'Loans Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        filename: 'loans',
                        title:'Loans Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7,8 ]
                        }
                    },
                    {
                        extend: 'print',
                        orientation:'landscape',
                        title:'Loans Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7,8 ]
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
