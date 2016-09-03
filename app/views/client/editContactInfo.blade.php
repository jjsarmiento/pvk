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
                        <a href="/"><i class="fa fa-home"></i></a>
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

            <div class="col-md-12">
                <div class="widget-container" style="min-height: 150px; padding-bottom: 5px; padding-top: 20px;">
                    <div class="widget-content padded">
                        <form method="POST" action="/doCltEditContactInfo" id="editContactInfo">
                            @foreach($contacts as $contact)
                                @if($contact->ctype == 'email')
                                    Email : 
                                    <input placeholder="Input existing email example : james@email.com" type="email" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control" required="required" /><br/>
                                @elseif($contact->ctype == 'businessNum')
                                    Business Number : 
                                    <input placeholder="Input existing telephone/cellphone number used for business" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control" /><br/>
                                @elseif($contact->ctype == 'mobileNum')
                                    Mobile Number : 
                                    <input placeholder="Input existing mobile number for business" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control" required="required" /><br/>
                                @elseif($contact->ctype == 'facebook')
                                    Facebook : 
                                    <input placeholder="Input link to facebook account example : fb.com/proveek" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
                                @elseif($contact->ctype == 'twitter')
                                    Twitter : 
                                    <input placeholder="Place link to business's Twitter account" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
                                @elseif($contact->ctype == 'linkedin')
                                    LinkedIn : 
                                    <input placeholder="Place link to business's LinkedIn account" type="text" name="{{$contact->ctype}}" value="{{$contact->content}}" class="form-control"/><br/>
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
        </div>
    </div>
</section>
@stop