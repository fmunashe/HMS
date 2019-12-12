@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Loan Statement Breakdown Details <a href="{{route('loanStatement')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-refresh"></i> Refresh Page</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row custom-invoice">
                            <div class="col-6 col-sm-6 m-b-20">
                                <img src="{{asset('frontend/assets/img/farm.png')}}" class="inv-logo" alt="">
                            </div>
                        </div>
                        <form action="{{route('searchLoanStatement')}}" method="get" class="sidebar-form">
                            <div class="input-group">
                                <input type="text" name="searchLoan" class="form-control alert-success" placeholder="Search by loan number .....................">
                                <span class="input-group-btn">
                                 <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                 </button>
                                 </span>
                            </div>
                        </form>
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6 col-lg-6 m-b-20">--}}
{{--                                <h6><strong>Loan Schedule</strong></h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="table-responsive">
                            <table id="schedule" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <td><h6>#</h6></td>
                                    <td><h6>Opening Balance</h6></td>
                                    <td><h6>Interest</h6></td>
                                    <td><h6>Penalties</h6></td>
                                    <td><h6>Amount Paid</h6></td>
                                    <td><h6>Closing Balance</h6></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schedules as $schedule)
                                    @if(number_format($schedule->paid_amount,2)!=number_format('0.00') or number_format($schedule->overdue,2)!=number_format('0.00'))
                                        @if(number_format($schedule->opening_balance,2)!=number_format('0.00'))
                                        <tr>
                                            <td>{{$schedule->loan_id}}</td>
                                            <td>-{{number_format($schedule->opening_balance,2)}}</td>
                                            <td>-{{number_format($schedule->interest,2)}}</td>
                                            <td>@if(number_format($schedule->overdue,2)==number_format('0.00')){{number_format($schedule->overdue,2)}}@else -{{number_format($schedule->overdue,2)}} @endif</td>
                                            <td>{{number_format($schedule->paid_amount,2)}}</td>
                                            <td>


                                                @if(number_format($schedule->opening_balance + $schedule->interest +  $schedule->overdue - $schedule->paid_amount,2)==number_format('0.00')){{number_format($schedule->opening_balance + $schedule->interest +  $schedule->overdue - $schedule->paid_amount,2)}}

                                                @else -{{number_format($schedule->opening_balance + $schedule->interest +  $schedule->overdue - $schedule->paid_amount,2)}}


                                                @endif</td>
                                        </tr>
                                        @endif
                                    @endif
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
    <script>
        $(document).ready(function() {
            $('#schedule').DataTable( {
                ordering:true,
                dom: 'Bfrtip',
                buttons: [
                    'pageLength','copy',
                    {
                        extend: 'pdf',
                        orientation:'landscape',
                        filename: 'Statement report',
                        title:'Loan Statement Report'
                    },
                    {
                        extend:'excel',
                        filename: 'Statement report',
                        title:'Loan Statement Report'
                    },
                    {
                        extend: 'csv',
                        filename: 'Statement report',
                        title:'Loan Statement Report'
                    },
                    {
                        extend: 'print',
                        filename: 'Statement report',
                        title:'Loan Statement Report'
                    },

                ]
            } );
        } );
    </script>
@endsection
