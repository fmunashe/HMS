<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/favi.ico')}}">
    <title>Agribank Off Book Facilities Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
    <![endif]-->
    @yield('styles')
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('frontend/assets/img/chikwereti.png')}}" width="50" height="50" alt="">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span><strong>OBFMS</strong></span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="{{asset('frontend/assets/img/user.jpg')}}" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
                    <span>{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu">
                    <i class="status-green">Role: {{auth()->user()->getRoleNames()[0]}}</i>
                       <a class="dropdown-item custom-badge badge-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    @hasanyrole('administrator|inputter|basic_access|authorizer|auditor|stores_clerk')
                    <li class="active">
                        <a href="{{route('home')}}"><i class="fa fa-dashboard text-success"></i> <span>Dashboard</span></a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('administrator|stores_clerk')
                    <li>
                        <a href="{{route('assets')}}"><i class="fa fa-taxi text-success"></i> <span>Assets</span></a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('administrator|inputter|authorizer')
                    <li>
                        <a href="{{route('installments')}}"><i class="fa fa-money text-success"></i> <span>&nbsp;Installments</span></a>
                    </li>
                    @endhasanyrole
                    @hasrole('administrator')
                    <li class="submenu">
                        <a href="#"><i class="fa fa-cogs text-success"></i> <span> Configurables </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('facilities')}}"><i class="fa fa-cart-plus text-success"></i> <span>Facilities</span></a></li>
                            <li><a href="{{route('branches')}}"><i class="fa fa-bank text-success"></i> <span>&nbsp;Branches</span></a></li>
                            <li><a href="{{route('currencies')}}"><i class="fa fa-money text-success"></i><span>&nbsp;Currencies</span></a></li>
                            <li><a href="{{route('interests')}}"><i class="fa fa-percent text-success"></i> <span>&nbsp;Rates Applicable</span></a></li>
                            <li><a href="{{route('frequencies')}}"><i class="fa fa-signal text-success"></i> <span>&nbsp;Repayment Period</span></a></li>
                            <li><a href="{{route('statuses')}}"><i class="fa fa-comments-o text-success"></i> <span> Statuses</span></a></li>
                            <li><a href="{{route('roles')}}"><i class="fa fa-key text-success"></i> <span> Roles & Permissions</span></a></li>
                            <li><a href="{{route('users')}}"><i class="fa fa-user text-success"></i> <span>System Users</span></a></li>
                        </ul>
                    </li>
                    @endhasrole
                    @hasanyrole('administrator|inputter|authorizer')
                    <li class="submenu">
                        <a href="#"><i class="fa fa-tasks text-success"></i> <span> My Activities </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('branchCustomers')}}"><i class="fa fa-users text-success"></i><span>  My Clients</span></a></li>
                            <li><a href="{{route('myLoans')}}"><i class="fa fa-suitcase text-success"></i> All my Loans </a></li>
                            <li><a href="{{route('unauthorised')}}"><i class="fa fa-thumbs-o-down text-warning"></i>Unauthorised Loans </a></li>
                           @hasanyrole('administrator|inputter')
                            <li><a href="{{route('rejections')}}"><i class="fa fa-refresh text-danger"></i> Rolled back Loans </a></li>
                            @endhasanyrole
                        </ul>
                    </li>
                    @endhasanyrole
                    @hasanyrole('administrator|inputter|authorizer|auditor')
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o text-success"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('loans')}}"><i class="fa fa-bitcoin text-success"></i> <span>&nbsp;Loans</span></a></li>
                            <li><a href="{{route('maturityReport')}}"><i class="fa fa-folder-open-o text-success"></i> Loan Maturity </a></li>
                            <li><a href="{{route('schedules')}}"><i class="fa fa-calendar-times-o text-success"></i>Loan Schedules </a></li>
                            <li><a href="{{route('customers')}}"><i class="fa fa-users text-success"></i> <span>All Clients</span></a></li>
                            <li><a href="{{route('audits')}}"><i class="fa fa-user-secret text-success"></i> <span>Audited Events</span></a></li>
                        </ul>
                    </li>
                    @endhasanyrole
                </ul>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="{{asset('frontend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('frontend/assets/js/Chart.bundle.js')}}"></script>
<script src="{{asset('frontend/assets/js/chart.js')}}"></script>
<script src="{{asset('frontend/assets/js/app.js')}}"></script>
@yield('javascripts')
@include('sweetalert::alert')
</body>
</html>
