@extends('layouts.usermain')

@section('title')
    Edit Contact Information
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
@stop

@section('body-scripts')
        {{ HTML::script('js/taskminator.js') }}
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                Edit Contact Information
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
                        Edit Contact Information
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
                    <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> Information Form</h4>
                </div>
                <div class="widget-container" style="min-height: 150px; padding-bottom: 5px; margin-top: -25px;">
                    <div class="widget-content padded">
                        <form method="POST" action="/doEditContactInfo" id="editContactInfo">
                            @foreach($contacts as $contact)
                                @if($contact->ctype == 'email')
                                    <div class="col-md-4">
                                        Email : 
                                    </div>
                                    <div class="col-md-8">
                                        <input placeholder="Input existing email example : james@email.com" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control" required="required" /><br/>
                                    </div>
                                @elseif($contact->ctype == 'facebook')
                                    <div class="col-md-4">
                                        Facebook : 
                                    </div>
                                    <div class="col-md-8">
                                        <input placeholder="Input link to facebook account example : fb.com/proveek" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
                                    </div>
                                @elseif($contact->ctype == 'linkedin')
                                    <div class="col-md-4">
                                        LinkedIn : 
                                    </div>
                                    <div class="col-md-8">
                                        <input placeholder="Place link to user's LinkedIn account" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
                                    </div>
                                @elseif($contact->ctype == 'mobileNum')
                                    <div class="col-md-4">
                                        Mobile Number : 
                                    </div>
                                    <div class="col-md-8">
                                        <input placeholder="Input existing mobile number for business" required="required" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
                                    </div>
                                @elseif($contact->ctype == 'twitter')
                                    <div class="col-md-4">
                                        Twitter : 
                                    </div>
                                    <div class="col-md-8">
                                        <input placeholder="Place link to user's Twitter account" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
                                    </div>
                                @endif
                            @endforeach
                            <div class="text-right padded">
                                <a href="/editProfile" class="btn btn-danger" style="margin-eft: 10px;">Cancel Edit</a>
                                <button type="submit" class="btn btn-primary" style="margin-eft: 10px;">Save Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel-body" style="background:white;">
                    <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> Edit your profile picture</h4>
                </div>
                <div class="widget-container small" style="margin-top:-25px;">
                    @if(Auth::user()->profilePic == null)
                        <div class="heading">
                            <i class="icon-signal"></i>Please upload a profile picture
                        </div>
                        <div class="widget-content padded">
                            {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
                                <input type="file" name="profilePic" accept="image/*" class="form-control" /><br/>
                                <button type="submit" class="btn btn-success">Upload</button>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="widget-content padded">
                            <div class="heading">
                                <i class="glyphicon glyphicon-user"></i>{{ Auth::user()->fullName }}
                            </div>
                            <div class="thumbnail">
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                            </div>
                        </div>
                    @endif
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
            <!--<span style="color: red; font-weight: bold">{{ @Session::get('errorMsg') }}</span>
            <span style="color: green; font-weight: bold">{{ @Session::get('successMsg') }}</span>
            <form method="POST" action="/doEditContactInfo" id="editContactInfo">
                @foreach($contacts as $contact)
                    @if($contact->ctype == 'email')
                        Email : <input type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" /><br/>
                    @elseif($contact->ctype == 'facebook')
                        Facebook : <input type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" /><br/>
                    @elseif($contact->ctype == 'linkedin')
                        LinkedIn : <input type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" /><br/>
                    @elseif($contact->ctype == 'mobileNum')
                        Mobile Number : <input type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" /><br/>
                    @endif
                @endforeach
                <button type="submit">Edit</button>
            </form>-->
    </div>
</section>
@stop