@extends('layouts.usermain')

@section('title')
    Upload Supporting Documents
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
    <script>
        $(document).ready(function(){
            CHAINLOCATION($('#reg-task'), $('#edt_prov'));
            CHAINLOCATION($('#reg-task'), $('#city-task'));
            CHAINLOCATION($('#city-task'), $('#barangay-task'));

            // DELETE DOCUMENT LISTENER
            $('.ANCHOR_DELETE_DOC').click(function() {
                if(confirm('Do you really want to delete '+$(this).data('docname'))){
//                    alert($(this).data('href'));
                    location.href = $(this).data('href');
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
                Documents
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
                        Documents
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
                        @if($user_docs->count() == 0)
                            <center><i><label>No supporting documents uploaded</label></i></center>
                        @else
                            <table class="table table-hover">
                                <thead>
                                    <th width="50%">File</th>
                                    <th width="35%">Document Type</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($user_docs as $ud)
                                        <tr>
                                            <td><a target="_tab" href="{{$ud->path}}">{{$ud->label}}</a></td>
                                            <td>{{$ud->sys_doc_label}}</td>
                                            <td style="text-align: right; font-size: 1.3em;">
                                                <a data-docname="{{$ud->label}}" title="Delete {{$ud->label}}" href="#" class="ANCHOR_DELETE_DOC" data-href="/DELDOCCMP_{{$ud->id}}" style="padding-right: 0.8em;"><i class="fa fa-trash"></i></a>
                                                <a title="Download {{$ud->label}}" download href="{{$ud->path}}" style="padding-right: 0.8em;"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$user_docs->links()}}
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-container" style="min-height: 1em;">
                    <div class="widget-content padded">
                        {{ Form::open(array('url' => '/doUploadDocumentsCMP', 'files' => 'true')) }}
                            <div class="form-group">
                                <select class="form-control" name="DOC_TYPE" required="required">
                                    <option value="">Please select the type of document you want to upload</option>
                                    @foreach($doc_types as $dt)
                                        <option value="{{$dt->sys_doc_type}}">{{$dt->sys_doc_label}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<input type="file" name="DOC_FILE" class="form-control" multiple required="required" /><br/>--}}
                            <input type="file" name="DOC_FILE" class="form-control" required="required" /><br/>
                            <button type="submit" class="btn btn-success">Upload</button>
                        {{ Form::close() }}
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