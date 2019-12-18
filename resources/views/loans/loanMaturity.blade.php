@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title"><a href="{{route('loanMaturity')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-refresh"></i> Refresh Page</a></h4>
                <div class="row custom-invoice">
                    <div class="col-6 col-sm-6 m-b-20">
                        <img src="{{asset('frontend/assets/img/loans.JPG')}}" class="inv-logo" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                        </div>
                        <form action="{{route('searchLoanMaturity')}}" method="get" class="sidebar-form">
                            <div class="input-group">
                                <input type="text" name="searchLoan" class="form-control alert-success" placeholder="Search by Loan Id, Branch Code, or Product Line ..............">
                                <span class="input-group-btn">
                                 <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                 </button>
                                 </span>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 m-b-20">
                                <h6><strong>Loan Maturity</strong></h6>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="statement" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <td><h6>#</h6></td>
                                    <td><h6>Loan Ref</h6></td>
                                    <td><h6>Customer</h6></td>
                                    <td><h6>Branch</h6></td>
                                    <td><h6>Product Line</h6></td>
                                    <td><h6>Outstanding Amount</h6></td>
                                    <td><h6>Value Date</h6></td>
                                    <td><h6>Maturity Date</h6></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loans as $loan)
                                    <tr>
                                        <td>{{$loan->id}}</td>
                                        <td>{{$loan->loan_id}}</td>
                                        <td>{{$loan->ClientName($loan->client_id)}}</td>
                                        <td>{{$loan->BranchName($loan->branch)}}</td>
                                        <td>{{$loan->facility_category}}</td>
                                        <td>{{number_format($loan->outstanding,2)}}</td>
                                        <td>{{$loan->establishment_date}}</td>
                                        <td>{{$loan->end_date}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
            $('#statement').DataTable( {
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
                        filename: 'Loan Maturity',
                        title:'Loan Maturity Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        filename: 'Loan Maturity',
                        title:'Loan Maturity Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5,6 ]
                        }
                    },
                    {
                        extend: 'print',
                        filename: 'Loan Maturity',
                        title:'Loan Maturity Report',
                    }
                ]
            } );
        } );
    </script>
@endsection
