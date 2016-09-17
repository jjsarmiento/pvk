@extends('layouts.usermain')

@section('title')
    Add Certifications
@stop

@section('head-content')
<style type="text/css">
    body{
        background-color:#E9EAED;
    }
    hr{
        max-width:100%;
        max-height:1px;
        border:none;
        border-bottom:1px solid #ccc;
        padding:0;
    }
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
    }
    .thumbnail img {
        display: inline;
        position: absolute;
        left: 50%;
        top: 50%;
        height: 100%;
        width: auto;
        transform: translate(-50%,-50%);
    }
    .thumbnail img.portrait {
        width: 100%;
        height: auto;
    }
</style>
@stop

@section('body-scripts')
    {{ HTML::script('js/taskminator.js') }}
{{ HTML::script('frontend/datepicker/bootstrap-datepicker.min.js') }}
    <script>
        $(document).ready(function(){

                var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'mm/dd/yyyy',
                    container: container,
                    todayHighlight: true,
                    autoclose: true
                };
                date_input.datepicker(options);
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
                Certifications
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
                        Certifications
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
                <div class="widget-container " style="min-height: 1em;">
                    <div class="widget-content padded">
                        <div class="row">
                            <form method="post" action="/doAddCertifications">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title of Training/Certificates</label>
                                        <input type="text" required="required" class="form-control" placeholder="Title of Training or Certificate taken" name="certificate_name" />
                                    </div>
                                    <div class="form-group">
                                        <label>Date Taken</label>
                                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Organizer/Company</label>
                                        <textarea class="form-control" required="required" placeholder="Name of Organizer / Compay where certification has been taken" name="organizer_company" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Add Certification</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="widget-container " style="min-height: 1em; word-wrap: break-word;">
                    <div class="widget-content padded">
                        @if($certs->count() > 0)
                            @foreach($certs as $c)
                                <span><b>Title of Training/Certificate: </b>{{ $c->title }}</span><br>
                                <span><b>Date Taken: </b>{{ $c->date }}</span><br>
                                <span><b>Organizer/Company: </b>{{ $c->organizer_company }}</span><br>
                                <a href="/editCertification:{{$c->id}}" class="btn btn-success btn-xs">EDIT</a>
                                <hr/>
                            @endforeach
                            <center>{{$certs->links()}}</center>
                        @else
                            <center>No certifications yet.</center>
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