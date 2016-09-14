@extends('layouts.usermain')

@section('title')
    PROVEEK SYSTEM SETTINGS
@stop

@section('user-name')
@stop

 @section('head-content')
    <style type="text/css">
        body{
            background-color:#E9EAED;
        }
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
        .widget-container.padded {
            color: white;
        }
        @media(max-width: 767px){
            ul.breadcrumb {
                margin-top: 50px;
            }            
        }
        @media (max-width: 320px){
            .text {
                font-size: 13px;
            }
        }
        /*-----------------*/        
    </style>
    <script>
        $(document).ready(function() {
            $('.DELETE_DOC_BTN').click(function(){
                if(confirm('Do you really want to delete this document type? ALL DOCUMENT IN RELATION WILL ALSO BE DELETED')){
                    location.href = $(this).data('href');
                }
            })
        })
    </script>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li>
                        <a href="/SYSTEMSETTINGS"><i class="fa fa-gear"></i> System Settings</a>
                    </li>
                    <li class="active">
                        Company Documents
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="widget-container" style="min-height: 1em;">
                    <div class="widget-content padded">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <div class="row">
                                        <form method="POST" action="SYS_ADD_DOC">
                                            <input type="hidden" value="COMPANY" name="DOC_ROLE" />
                                            <div class="col-md-5">
                                                <input required="required" type="text" placeholder="DOCUMENT CODE" name="DOCUMENT_TYPE" class="form-control" />
                                            </div>
                                            <div class="col-md-5">
                                                <input required="required" type="text" placeholder="Document Label" name="DOCUMENT_LABEL" class="form-control" />
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-success btn-block" style="border-radius: 0.3em;">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><br/><br/>

                            @if($doc_types->count() > 0)
                                @foreach($doc_types as $dc)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" value="{{$dc->sys_doc_type}}" class="form-control" name="{{$dc->sys_doc_type.'_TYPE'}}" />
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" value="{{$dc->sys_doc_label}}" class="form-control" name="{{$dc->sys_doc_label.'_LABEL'}}" />
                                                </div>
                                                <div class="col-md-2">
                                                    @if($dc->sys_doc_disabled)
                                                        <a href="/ENABLEDOC:{{$dc->id}}" style="color:#E67E22; font-size: 1.5em; border-radius: 0.3em;"><i class="fa fa-toggle-off"></i></a>
                                                    @else
                                                        <a href="/DISABLEDOC:{{$dc->id}}" style="color: #2ECC71; font-size: 1.5em; border-radius: 0.3em;"><i class="fa fa-toggle-on"></i></a>
                                                    @endif
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-href="/DELETEDOC:{{$dc->id}}" class="DELETE_DOC_BTN" style="color: #E74C3C; font-size: 1.5em; border-radius: 0.3em;"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br/><br/>
                                @endforeach
                            @else
                                <center><i>No documents for companies</i></center>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-danger" style="border-radius: 0.3em;">Save</button>
                </div>
                <br/>
                <center>{{$doc_types->links()}}</center>
            </div>
            <div class="col-md-4">
                <div class="widget-container stats-container" style="display:block !important;">
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="APPLICANTSLINK" href="/WORKERDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Worker Doc Types
                            </div>
                        </a>
                        </div>
                        <div class="col-md-6 col-xs-6 lato-text">
                        <a id="INVITEDSLINK" href="/COMPANYDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Company Doc Types
                            </div>
                        </a>
                    </div>
                </div><br/>
                <div class="widget-container stats-container" style="display:block !important;">
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="APPLICANTSLINK" href="/TOS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-gavel"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Terms of Service
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="APPLICANTSLINK" href="/POLICY" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-eye"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Policy
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop