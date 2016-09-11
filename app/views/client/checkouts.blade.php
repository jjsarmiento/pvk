@extends('layouts.usermain')

@section('title')
    {{ Auth::user()->username }} | Job List
@stop

@section('head-content')
    <style type="text/css">
        body{
            background-color:#E9EAED;
        }
    </style>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-8">
            <div class="widget-container fluid-height padded">
                @if($workers->count() != 0)
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <th>Checkout Date</th>
                            <th>Name</th>
                            <th>Expiration</th>
                        </thead>
                        <tbody>
                            @foreach($workers as $w)
                                <tr>
                                    <td>{{$w->purchased_at}}</td>
                                    <td><a href="/{{$w->username}}">{{$w->fullName}}</a></td>
                                    <td>
                                        @if($w->expired)
                                            <span class="badge" style="background-color: #E74C3C">EXPIRED</span>
                                        @else
                                            {{$w->expires_at}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <center><i>
                        No workers checked out yet.<br/>
                    </i></center>
                @endif
            </div>
        </div>
    </div>
</section>
@stop