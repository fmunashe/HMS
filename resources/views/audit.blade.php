@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="card-title">Audited Events <a href="{{route('audits')}}" class="btn btn-success btn-rounded pull-right"><i class="fa fa-refresh"></i> Reload View</a></h4>
{{--                <form action="{{route('searchMaturity')}}" method="get" class="sidebar-form">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" name="searchLoan" class="form-control alert-success" placeholder="Search by branch or product line...........">--}}
{{--                        <span class="input-group-btn">--}}
{{--                                 <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
{{--                                 </button>--}}
{{--                                 </span>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>IP Address</th>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Old Value</th>
{{--                        <th>New value</th>--}}
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($audits as $audit)
                        <tr>
                            <td>{{$audit->id}}</td>
                            <td>{{$audit->user->name}}</td>
                            <td>{{$audit->ip_address}}</td>
                            <td>{{$audit->created_at}}</td>
                            <td>{{$audit->event}}</td>
                            <td>
                                @foreach($audit->getModified() as $key => $item )
                                    @if(isset($item['new']))
                                        <li class=""><b>{{ ucwords($key) }}</b>
                                            @if(is_array($item['new']))
                                                @foreach( $item['new'] as $name => $value )
                                                    {{ ucwords($name) }}
                                                    @if(is_array($value))
                                                        @foreach( $value as $i => $a )
                                                            {{ ucwords($i) }}
                                                            {{ ucwords($a) }}
                                                        @endforeach
                                                    @else
                                                        {{ ucwords($value) }}
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="pull-right">{{ $item['new'] }}</span>
                                            @endif
                                            @endif
                                            @endforeach
                                        </li>
                            </td>
{{--                            <td>{{$audit->new_values}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
