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

            <div class="col-md-5">
                <div class="panel-body" style="background:white;">
                    <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> Information Form</h4>
                </div>
                <div class="widget-container fluid-height padded" style="margin-top:-25px;">
                    <div class="widget-content">
                        <form method="POST" action="doEditExperience">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input name="company_name" id="company_name" placeholder="Company Name" class="form-control" type="text" required="required"/>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input name="position" id="position" placeholder="Position in company" class="form-control" type="text" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input name="location" id="location" placeholder="Location of company" class="form-control" type="text" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Time Period</label><br>
                                <!-- <input name="time_period" id="time_period" placeholder="Time Period" class="form-control" type="text" required="required" /> -->

                                <!-- JUPS -->
                                <div class="from" style="float:left;">
                                    <select name="startDateMonth" id="time_period" class="form-control" type="singleselect" style="width:100px; float:left;">
                                        <option value="" selected="selected">Choose...</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input class="form-control" type="text" style="width:100px; float:left; margin-left:5px;" placeholder="Year"/> 
                                    <span style="padding: 0 5px; font-size: 20px; float:left;"> - </span>
                                    <div class="toPresent" style="font-size: 20px; float:left; display:none;">Present</div>
                                </div>
                                <div class="toPresentInput" style="float:left;">
                                    <select name="startDateMonth" id="time_period" class="form-control" type="singleselect" style="width:100px; float:left;">
                                        <option value="" selected="selected">Choose...</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input class="form-control" type="text" style="width:100px; float:left; margin-left:5px;" placeholder="Year"/>
                                </div>
                                <label style="padding: 6px 0 0 0;"><input type="checkbox" id="checkbox"/> I currently work here</label>
                                <!--END JUPS -->
                            </div>

                            <div class="form-group">
                                <label>Roles and Responsibilities</label>
                                <textarea name="roles_and_resp" id="roles_and_resp" placeholder="Roles and Responsibilities" class="form-control" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Experience</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel-body" style="background:white;">
                    <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> List of Information</h4>
                </div>
                <div class="widget-container fluid-height padded" style="margin-top:-25px;">
                    <div class="widget-content" style="word-wrap: break-word;">
                        @if($exps->count() > 0)
                            @foreach($exps as $e)
                                Company Name : {{$e->company_name}}<br/>
                                Position : {{$e->position}}<br/>
                                Location : {{$e->location}}<br/>
                                Time Period : {{$e->time_period}}<br/>
                                Roles and Responsibilities : {{$e->roles_and_resp}}<br/>
                                <a href="/editExp={{$e->id}}" class="btn btn-xs btn-success">EDIT</a>
                                <a href="#" data-message="Are you sure you want to delete this data?" data-href="/deleteExp={{$e->id}}" class="a-validate btn btn-danger btn-xs">Delete</a>
                                <hr/>
                            @endforeach
                        @else
                            <center>No data available</center>
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

<script type="text/javascript">
$(document).ready(function(){
    $('#checkbox').change(function(){
        if(this.checked){
            $('.toPresentInput').fadeOut('fast', function(){
                $('.toPresent').fadeIn('fast');
            });  
        }
        else {
            $('.toPresent').fadeOut('fast', function(){
                $('.toPresentInput').fadeIn('fast');
            });
            
        }

    });
});
</script>
@stop