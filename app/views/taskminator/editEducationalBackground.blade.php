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

            <div class="col-md-4">
                <div class="panel-body" style="background:white;">
                    <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i>Information Form</h4>
                </div>
                <div class="widget-container fluid-height padded" style="margin-top:-25px;">
                    <div class="widget-content">
                        <form method="POST" action="doEditEducationalBackground">
                            <div class="form-group">
                                <label>Education Level</label>
                                <select name="level" id="level" class="form-control" required="required">
                                    <option value="COLLEGE">College</option>
                                    <option value="HIGH_SCHOOL">High School</option>
                                    <option value="ELEMENTARY">Elementary</option>
                                    <option value="VOCATIONAL">Vocational</option>
                                    <option value="OTHER">Other</option>
                                </select>
                            </div>
                            <div class="form-group" id="COURSE_DIV">
                                <label>Course / Major</label>
                                <input type="text" class="form-control" name="course" id="course" placeholder="Course / Major" required="required" />
                            </div>
                            <div class="form-group">
                                <label>School Name</label>
                                <input type="text" class="form-control" name="school_name" id="school_name" placeholder="School Name" required="required" />
                            </div>
                            <div class="form-group">
                                <label>School Year</label>
                                <input type="text" class="form-control" name="school_year" id="school_year" placeholder="School Year" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Awards</label>
                                <textarea name="awards" rows="10" id="awards" class="form-control" placeholder="Awards"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Add Education</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel-body" style="background:white;">
                    <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> List of Information</h4>
                </div>
                <div class="widget-container fluid-height padded" style="margin-top:-25px;">
                    <div class="widget-content" style="word-wrap: break-word;">
                        @if($educs->count() > 0)
                            @foreach($educs as $e)
                                Education : {{$e->level}}<br/>
                                @if($e->level == 'COLLEGE' || $e->level == 'VOCATIONAL')
                                    Course / Major : {{$e->course_major}}<br/>
                                @endif
                                School Name : {{$e->school_name}}<br/>
                                School Year : {{$e->school_year}}<br/>
                                Awards : {{$e->awards}}<br/>
                                <a href="/editEduc={{$e->id}}" class="btn btn-xs btn-success">EDIT</a>
                                <a href="#" data-message="Are you sure you want to delete this data?" data-href="/deleteEduc={{$e->id}}" class="a-validate btn btn-xs btn-danger">Delete</a>
                                <hr/>
                            @endforeach
                        @else
                            <center>No educational information yet</center>
                        @endif
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
                <div class="panel-body" style="margin-top:-25px;">
                    @foreach($prog as $r)
                        <a href="{{$r['url']}}">{{$r['content']}}</a><br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</section>
@stop