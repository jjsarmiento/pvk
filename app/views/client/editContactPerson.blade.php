@extends('layouts.usermain')

@section('title')
    Edit Personal Information
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
        h5 {
            margin: 0;
        }
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
            margin-left: 20px;
            margin-top: 15px;
            margin-right: 1em;
            margin-bottom: 0em;
            /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
            /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
            /*box-shadow: 0 8px 6px -6px black;*/
        }
        .thumbnail img {
            display: inline;
            position: absolute;
            left: 50%;
            top: 50%;
            height: 100%;
            width: auto;
            /*-webkit-transform: translate(-50%,-50%);*/
            /*-ms-transform: translate(-50%,-50%);*/
            transform: translate(-50%,-50%);
        }
        .thumbnail img.portrait {
            width: 100%;
            height: auto;
        }
    </style>
    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/taskminator.js') }}
    <script>
    </script>
@stop

@section('body-scripts')
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
    <section class="lato-text">
        <div class="container">
            <div class="page-title">
                <h1 class="lato-text">
                    Edit Contact Person Information
                </h1>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                        </li>
                        <li>
                            <a href="/editProfile">Edit Profile</a>
                        </li>
                        <li class="active">
                            Edit Contact Person Information
                        </li>
                    </ul>
                </div>

                @if(Session::has('errorMsg'))
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            {{ @Session::get('errorMsg') }}
                        </div>
                    </div>
                @endif
                @if(Session::has('successMsg'))
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            {{ @Session::get('successMsg') }}
                        </div>
                    </div>
                @endif

                <div class="col-md-8">
                    <div class="widget-container fluid-height">
                        <div class="widget-content padded">
                            <div class="row">
                                <form method="POST" action="/doEditContactPerson">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input value="{{@$cperson->name}}" required="required" type="text" class="form-control" placeholder="Name" name="cp_name" />
                                        </div>
                                        <div class="form-group">
                                            <input value="{{@$cperson->position}}" required="required" type="text" class="form-control" placeholder="Position" name="cp_position" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input value="{{@$cperson->contact_number}}" required="required" type="text" class="form-control" placeholder="Contact Number" name="cp_contactnumber" />
                                        </div>
                                        <div class="form-group">
                                            <input value="{{@$cperson->email}}" required="required" type="email" class="form-control" placeholder="Email" name="cp_email" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group pull-right">
                                            <button class="btn btn-success" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                        <div class="col-md-4">
                            <div class="job-post">
                                <div class="col-lg-12 no-padding">
                                    <div class="widget-container" style="min-height:30px;">
                                        <div class="panel-body">
                                            <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> Profile Progress</h4>
                                        </div>
                                        <div class="panel-body" style="padding-top: 0px; margin-top: -5px;">
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Company Name / Business Name</a><br>
                                            <a href="/editProfile"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Profile Picture / Company Logo</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Region</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Province</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;City</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Barangay</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Business Permit</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Business Description</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Business Nature</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Years in Operation</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Number Of Branches</a><br>
                                            <a href="/editContactPerson"><i style="color: #E74C3C; font-size: 1.2em" class="fa fa-close"></i>&nbsp;&nbsp;Contact Person Position</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Number Of Employees</a><br>
                                            <a href="/cltEditPersonalInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Working Hours</a><br>
                                            <a href="/cltEditContactInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Mobile Number</a><br>
                                            <a href="/cltEditContactInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Business Mobile Number</a><br>
                                            <a href="/cltEditContactInfo"><i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;Email</a><br>
                                            <a href="/editDocumentsCMP"><i style="color: #E74C3C; font-size: 1.2em" class="fa fa-close"></i>&nbsp;&nbsp;POEA License / DOLE License</a><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


            </div>
        </div>
    </section>
@stop

