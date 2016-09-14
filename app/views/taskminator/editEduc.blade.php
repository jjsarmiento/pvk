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

            if($('#level').val() == 'COLLEGE' || $('#level').val() == 'VOCATIONAL'){
                $('#COURSE_DIV').show();
                $('#course').prop('disabled', false);
            }else{
                $('#COURSE_DIV').hide();
                $('#course').prop('disabled', true);
            }
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
                Edit Educational Information
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
                        Edit Educational Information
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
                        <form method="POST" action="doEditEduc">
                            <input type="hidden" name="educ_id" value="{{$e->id}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Education Level</label>
                                        <select name="level" id="level" class="form-control" required="required">
                                            <option <?php if($e->level == 'COLLEGE'){ echo 'selected'; } ?> value="COLLEGE">College</option>
                                            <option <?php if($e->level == 'HIGH_SCHOOL'){ echo 'selected'; } ?> value="HIGH_SCHOOL">High School</option>
                                            <option <?php if($e->level == 'ELEMENTARY'){ echo 'selected'; } ?> value="ELEMENTARY">Elementary</option>
                                            <option <?php if($e->level == 'VOCATIONAL'){ echo 'selected'; } ?> value="VOCATIONAL">Vocational</option>
                                            <option <?php if($e->level == 'OTHER'){ echo 'selected'; } ?> value="OTHER">Other</option>
                                        </select>
                                    </div>
                                    @if($e->level == 'COLLEGE' || $e->level == 'VOCATIONAL')
                                        <div class="form-group" id="COURSE_DIV" style="display: none;">
                                    @else
                                        <div class="form-group" id="COURSE_DIV">
                                    @endif
                                        <label>Course / Major</label>
                                        <input value="{{$e->course_major}}" type="text" class="form-control" name="course" id="course" placeholder="Course / Major" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>School Name</label>
                                        <input value="{{$e->school_name}}" type="text" class="form-control" name="school_name" id="school_name" placeholder="School Name" required="required" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School Year</label>
                                        <input value="{{$e->school_year}}" type="text" class="form-control" name="school_year" id="school_year" placeholder="School Year" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Awards</label>
                                        <textarea name="awards" rows="10" id="awards" class="form-control" placeholder="Awards" required="required">{{$e->awards}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Edit Education</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</section>
@stop