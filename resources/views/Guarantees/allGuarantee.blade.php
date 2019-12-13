@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">All Issued Guarantees </h4>
                <table id="guarantee" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Branch</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Amount</th>
                        <th>Security</th>
                        <th>Beneficiary</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guarantees as $guarantee)
                        <tr>
                            <td>{{$guarantee->id}}</td>
                            <td>@if($guarantee->customer_id=="")@else {{$guarantee->Customer($guarantee->customer_id)}}@endif</td>
                            <td>@if($guarantee->branch=="") @else {{$guarantee->Branch($guarantee->branch)}}@endif</td>
                            <td>@if($guarantee->guarantee_type=="") @else {{$guarantee->GuaranteeType($guarantee->guarantee_type)}}@endif</td>
                            <td>{{$guarantee->start_date}}</td>
                            <td>{{$guarantee->end_date}}</td>
                            <td>{{$guarantee->amount_guaranteed}}</td>
                            <td>{{$guarantee->security}}</td>
                            <td>{{$guarantee->beneficiary}}</td>
                            <td>@if($guarantee->active=="0")<i class="custom-badge badge-danger-border">Expired</i>@else<i class="custom-badge badge-success-border">Active</i>@endif</td>
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
            $('#guarantee').DataTable( {
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
                        filename: 'Guarantee report',
                        title:'Guarantees Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        filename: 'Guarantee report',
                        title:'Guarantees Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7,8,9 ]
                        }
                    },
                    {
                        extend: 'print',
                        title:'Guarantee Report'
                    }
                ]
            } );
        } );
    </script>
@endsection
