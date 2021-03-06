@extends('layouts.usermain')

@section('title')
    Bookmarked Workers
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    a{text-decoration: none !important;}
</style>
@stop

@section('body-scripts')
@stop

@section('user-name')
    Bookmarks | {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($bookmarks->count() == 0)
                    <center><i>No bookmarked users</i></center>
                @else
                    @foreach($bookmarks as $bm)
                        <div class="col-md-3" style="margin-bottom: 1em;">
                            <div class="widget-container fluid-height padded">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                            <a href="/{{$bm->username}}">
                                                @if(in_array($bm->userID, $CHECKED_OUT_USERS))
                                                    {{$bm->firstName }} {{$bm->lastName}}
                                                @else
                                                    {{substr_replace($bm->firstName, str_repeat('*', strlen($bm->firstName)-1), 1)}}
                                                    &nbsp;
                                                    {{substr_replace($bm->lastName, str_repeat('*', strlen($bm->lastName)-1), 1)}}
                                                @endif
                                            </a>
                                        </h3>
                                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                                            Bookmarked at {{ date('m/d/y', strtotime($bm->bookmarked_at)) }}
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="/BulkInviteToApply={{$bm->userID}}" class="btn btn-xs btn-warning btn-block">Invite to apply</a>
                                        <a href="/REMOVE_BOOKMARK:{{$bm->bmID}}" class="btn btn-xs btn-danger btn-block">remove bookmark</a>
                                        <!--
                                        @if(!in_array($bm->userID, $CHECKED_OUT_USERS))
                                            <a href="/doCheckout={{$bm->userID}}" class="btn btn-block btn-warning" style="background-color: #E74C3C;">Checkout</a>
                                        @endif
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@stop