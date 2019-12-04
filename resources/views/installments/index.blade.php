@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Installments Recorded @hasanyrole('administrator|inputter') <a href="{{route('createInstallment')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> New Installment</a>@endhasanyrole</h4>
                <table id="installment" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>FT Reference</th>
                        <th>Captured By</th>
                        <th>Status</th>
                        <th>Authorised By</th>
                        <th>Effective Date</th>
                        <th>Captured Date</th>
                        @hasanyrole('administrator|authorizer')
                        <th>Action</th>
                        @endhasanyrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($installments as $installment)
                        <tr>
                            <td>{{$installment->loan_id}}</td>
                            <td>{{$installment->amount}}</td>
                            <td>{{$installment->currency}}</td>
                            <td>{{$installment->ft_reference}}
                            <td>{{$installment->captured_by}}</td>
                            <td>@if($installment->status=="103")<i class="custom-badge badge-danger-border">{{$installment->StatusName($installment->status)}}</i>@else<i class="custom-badge badge-success-border">{{$installment->StatusName($installment->status)}}</i>@endif</td>
                            <td>{{$installment->authorised_by}}</td>
                            <td>{{$installment->effective_date}}</td>
                            <td>{{$installment->created_at}}</td>
                            @hasanyrole('administrator|authorizer')
                            <td>
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/authorizeInstallment/{{$installment->id}}"><i class="custom-badge status-green fa fa-pencil m-r-5">&nbsp; Authorise</i></a>
                                    </div>
                                </div>
                            </td>
                            @endhasanyrole
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
            $('#installment').DataTable( {
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
                        filename: 'Installments report',
                        title:'Installments History Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        filename: 'Installments report',
                        title:'Installments History Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6,7 ]
                        }
                    },
                    {
                        extend: 'print',
                        orientation:'landscape',
                        title:'Installments History Report'
                    }
                ]
            } );
        } );
    </script>
@endsection
