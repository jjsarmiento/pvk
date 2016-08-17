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
                        Create ADMIN Account
                    </h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/"><i class="fa fa-home"></i></a>
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
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Account Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($admins as $a)
                                        <tr>
                                            <td>{{$a->fullName}}</td>
                                            <td>{{$a->username}}</td>
                                            <td>{{$a->status}}</td>
                                            <td>
                                                @if($a->id != Auth::user()->id)
                                                    @if($a->status == 'ACTIVATED')
                                                        <a href="#" title="Deactivate Account" class="a-validate" data-message="Are you sure you want to DEACTIVATE Admin {{$a->fullName}}" data-href="/DEACTIVATE_ADMIN:{{$a->id}}"><i style="color: #E74C3C;" class="fa fa-close"></i></a>
                                                    @else
                                                        <a href="/ACTIVATE_ADMIN:{{$a->id}}" title="Activate Account"><i style="color: #2ECC71;" class="fa fa-check"></i></a>
                                                    @endif
                                                    <a href="#" class="a-validate" title="DELETE Account" data-message="Are you sure you want to DELETE Admin {{$a->fullName}}" data-href="/DELETE_ADMIN:{{$a->id}}"><i class="fa fa-trash"></i></a>
                                                @endif
                                                <a href="/EDIT_ADMIN:{{$a->id}}" title="Edit Account"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <center>{{$admins->links()}}</center>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget-container fluid-height padded" style="background-color: #ffffff;">
                            <form method="POST" action="doCREATE_ADMIN">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input value="{{Input::old('admin_fname')}}" required="required" type="text" class="form-control" name="admin_fname" placeholder="ADMIN FIRST NAME" />
                                        </div>
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input value="{{Input::old('admin_mname')}}" type="text" class="form-control" name="admin_mname" placeholder="ADMIN MIDDLE NAME" />
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input  value="{{Input::old('admin_lname')}}"required="required" type="text" class="form-control" name="admin_lname" placeholder="ADMIN LAST NAME" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input  value="{{Input::old('admin_username')}}"required="required" type="text" class="form-control" name="admin_username" placeholder="ADMIN USERNAME" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required="required" type="password" class="form-control" name="admin_password" placeholder="ADMIN PASSWORD" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required="required" type="password" class="form-control" name="admin_cpassword" placeholder="ADMIN REPEAT PASSWORD" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">ADD ADMIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@stop