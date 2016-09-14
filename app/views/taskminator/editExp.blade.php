@extends('layouts.usermain')

@section('title')
    Edit Personal Information
@stop

@section('head-content')
{{ HTML::script('frontend/datepicker/bootstrap-datepicker.min.js') }}

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
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#level').change(function(){
                if($(this).val() == 'COLLEGE' || $(this).val() == 'VOCATIONAL'){
                    $('#COURSE_DIV').show();
                    $('#course').prop('disabled', false);
                }else{
                    $('#COURSE_DIV').hide();
                    $('#course').prop('disabled', true);
                }
            })
        });
    </script>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                Edit Experience Information
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
                        Edit Experience Information
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

            <div class="col-md-12">
                <div class="widget-container fluid-height padded">
                    <div class="widget-content">
                        <form method="POST" action="doEditExp">
                            <input type="hidden" name="exp_id" value="{{$e->id}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input value="{{$e->company_name}}" name="company_name" id="company_name" placeholder="Company Name" class="form-control" type="text" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Position</label>
                                        <input value="{{$e->position}}" name="position" id="position" placeholder="Position in company" class="form-control" type="text" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input value="{{$e->location}}" name="location" id="location" placeholder="Location of company" class="form-control" type="text" required="required" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time Period</label>
                                        <input value="{{$e->time_period}}" name="time_period" id="time_period" placeholder="Time Period" class="form-control" type="text" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Roles and Responsibilities</label>
                                        <textarea name="roles_and_resp" id="roles_and_resp" placeholder="Roles and Responsibilities" class="form-control" rows="10">{{$e->roles_and_resp}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Edit Experience</button>
                                    </div>
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