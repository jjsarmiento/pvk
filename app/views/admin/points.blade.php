@extends('layouts.usermain')

@section('title')
    Welcome to your dashboard!!
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        /* Added by Jups */
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: auto;
            min-height: 100%;
        }
        h1.lato-text{
            color: white;
        }
        .widget-container{
            background-color: rgba(245,245,245,0.3);
        }
        .breadcrumb, .panel-heading{
            background-color: rgba(245,245,245,0.7);
        }
        .breadcrumb>li{
            color: white !important;
        }
        a.sidemenu {
            color: white;
        }
        a.sidemenu:hover {
            transition: 0.3s;
            color: #d9d9d9;
            text-decoration: none;
        }
        @media (max-width: 767px){
          h1.lato-text {
              margin-top: 40px;
          }
        }
        /*-----------------*/
        .accordion-toggle
        {
            text-decoration: none !important;
        }

        .block-update-card {
                padding: 0.8em;
              height: 100%;
              border: 1px #FFFFFF solid;
              /*width: 380px;*/
              float: left;
              /*margin-left: 10px;*/
              /*margin-top: 0;*/
              /*padding: 0;*/
              box-shadow: 1px 1px 8px #d8d8d8;
              background-color: #FFFFFF;
            }
            .block-update-card .h-status {
              width: 100%;
              height: 7px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .v-status {
              width: 5px;
              height: 80px;
              float: left;
              margin-right: 5px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .update-card-MDimentions {
              width: 80px;
              height: 80px;
            }
            .block-update-card .update-card-body {
              margin-top: 10px;
              margin-left: 5px;
            }
            .block-update-card .update-card-body h4 {
              color: #737373;
              font-weight: bold;
              /*font-size: 13px;*/
            }
            .block-update-card .update-card-body p {
              color: #737373;
              font-size: 12px;
            }
            .block-update-card .card-action-pellet {
              padding: 5px;
            }
            .block-update-card .card-action-pellet div {
              margin-right: 10px;
              font-size: 15px;
              cursor: pointer;
              color: #dddddd;
            }
            .block-update-card .card-action-pellet div:hover {
              color: #999999;
            }
            .block-update-card .card-bottom-status {
              color: #a9a9aa;
              font-weight: bold;
              font-size: 14px;
              border-top: #e0e0e0 1px solid;
              padding-top: 5px;
              margin: 0px;
            }
            .block-update-card .card-bottom-status:hover {
              background-color: #dd4b39;
              color: #FFFFFF;
              cursor: pointer;
            }

            /*
            Creating a block for social media buttons
            */
            .card-body-social {
              font-size: 30px;
              margin-top: 10px;
            }
            .card-body-social .git {
              color: black;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .twitter {
              color: #19C4FF;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .google-plus {
              color: #DD4B39;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .facebook {
              color: #49649F;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .linkedin {
              color: #007BB6;
              cursor: pointer;
              margin-left: 10px;
            }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#search_btn').click(function(){
                var acctStatus = $('#search_acctStatus').val(),
                    rating = $('#search_rating').val(),
                    hiring = $('#search_hiring').val(),
                    orderBy = $('#search_orderBy').val(),
                    keyword = $('#search_keyword').val();

                    if(keyword == ""){
                        keyword = "NONE";
                    }

                    location.href = "/searchWorker:"+acctStatus+":"+rating+":"+hiring+":"+orderBy+":"+keyword;
            });

            $('.ACT_DEAC').click(function(){
                if(confirm($(this).data('msg'))){
                    location.href = $(this).data('href');
                }
            })
        });
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
        <section style="margin-top:0;">
            <div class="container lato-text" style="">
                <div class="page-title">
                    <h1 class="lato-text">
                        Manage points for {{$user->fullName}}
                    </h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                            </li>
                            <li>
                                <a href="/admin">User Lists</a>
                            </li>
                            <li>
                                <a href="/UsrAccntLstCMPNY">Company</a>
                            </li>
                            <li>
                                Points
                            </li>
                        </ul>
                    </div>
                </div>
                @if(Session::has('errorMsg'))
                    <div class="row">
                        <div class="col-md-12 padded">
                            <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                                <i class="fa fa-warning"></i> {{Session::get('errorMsg')}}
                            </div>
                        </div>
                    </div>
                @elseif(Session::has('successMsg'))
                    <div class="row">
                        <div class="col-md-12 padded">
                            <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                                <i class="fa fa-check-circle"></i> {{Session::get('successMsg')}}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                            <h3>{{$user->fullName}}</h3>
                            <b>Points left : {{$user->points}}</b>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                            <div class="row">
                                <form method="POST" action="/doAddPoints">
                                    <input type="hidden" name="user_id" value="{{$user->id}}" />
                                    <input type="hidden" name="current_points" value="{{$user->points}}" />
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" required="required" class="form-control" name="points" placeholder="Input amount of points to add" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Add points</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST" action="/doSubtractPoints">
                                    <input type="hidden" name="user_id" value="{{$user->id}}" />
                                    <input type="hidden" name="current_points" value="{{$user->points}}" />
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" required="required" class="form-control" name="points" placeholder="Input amount of points to subtract" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger">Minus points</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@stop