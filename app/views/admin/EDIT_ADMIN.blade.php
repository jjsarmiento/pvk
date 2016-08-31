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
        @media(max-width: 767px){
          h1.lato-text {
              margin-top: 40px;
          }
        }
        @media screen and (max-width: 767px) {
          .tg {
            width: auto !important; 
          }
          .tg col {
            width: auto !important;
          }
          .tg-wrap {
            overflow-x: auto;-webkit-overflow-scrolling: touch;
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
            });

            $('.admin-chkbx').click(function() {
                if($(this).prop('checked')){
                    $('.role-chkbx').prop('disabled', true);
                }else{
                    $('.role-chkbx').prop('disabled', false);
                }
            });

            $('#CREATE_ADMIN_FORM').submit(function(e){
                if($('.req-chkbx:checked').length == 0){
                    alert('Please select a role for this Administrator account');
                    e.preventDefault();
                }
            });

            if($('.admin-chkbx').prop('checked')){
                $('.role-chkbx').prop('disabled', true);
            }
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
                        Edit ADMIN Account
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
                        <div class="tg-wrap widget-container fluid-height padded" style="background-color: #ffffff;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th class="tg-yw4l">Name</th>
                                    <th class="tg-yw4l">Username</th>
                                    <th class="tg-yw4l">Account Status</th>
                                    <th class="tg-yw4l">Action</th>
                                </thead>
                                <tbody>
                                    @foreach($admins as $a)
                                        <tr>
                                            <td>{{$a->fullName}}</td>
                                            <td>{{$a->username}}</td>
                                            <td>{{$a->status}}</td>
                                            <td>
                                                <a href="/EDIT_ADMIN:{{$a->id}}"><i class="fa fa-edit"></i></a>
                                                @if($a->id != Auth::user()->id)
                                                    <a href="#" class="a-validate" data-message="Are you sure you want to DELETE Admin {{$a->fullName}}" data-href="/DELETE_ADMIN:{{$a->id}}"><i class="fa fa-trash"></i></a>
                                                @endif
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
                            <form method="POST" action="doEDIT_ADMIN" id="CREATE_ADMIN_FORM">
                                <input type="hidden" name="admin_id" value="{{$admin->id}}" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input value="{{$admin->firstName}}" required="required" type="text" class="form-control" name="admin_fname" placeholder="ADMIN FIRST NAME" />
                                        </div>
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input value="{{$admin->midName}}" type="text" class="form-control" name="admin_mname" placeholder="ADMIN MIDDLE NAME" />
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input  value="{{$admin->lastName}}"required="required" type="text" class="form-control" name="admin_lname" placeholder="ADMIN LAST NAME" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input  value="{{$admin->username}}"required="required" type="text" class="form-control" name="admin_username" placeholder="ADMIN USERNAME" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="admin_password" placeholder="ADMIN PASSWORD" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="admin_cpassword" placeholder="ADMIN REPEAT PASSWORD" />
                                        </div>
                                        <div class="form-group">
                                            <span style="color: red;"><b>Super Administrator</b> grants all privileges to account</span><br/>
                                            <input type="checkbox" <?php if(in_array('SUPER_ADMINISTRATOR', $roles)){ echo 'checked'; } ?> class="req-chkbx admin-chkbx" name="admin_role[]" value="SUPER_ADMINISTRATOR"/> Super Administrator<br/>
                                            <input type="checkbox" <?php if(in_array('ADMINISTRATOR', $roles)){ echo 'checked'; } ?> class="req-chkbx role-chkbx" name="admin_role[]" value="ADMINISTRATOR"/> Administrator<br/>
                                            <input type="checkbox" <?php if(in_array('CONTENT_EDITOR', $roles)){ echo 'checked'; } ?> class="req-chkbx role-chkbx" name="admin_role[]" value="CONTENT_EDITOR"/> Content Editor<br/>
                                            <input type="checkbox" <?php if(in_array('SUPPORT', $roles)){ echo 'checked'; } ?> class="req-chkbx role-chkbx" name="admin_role[]" value="SUPPORT"/> Support<br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning" type="submit">EDIT ADMIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@stop