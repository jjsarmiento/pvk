@extends('layouts.usermain')

@section('title')
    PROVEEK SYSTEM SETTINGS
@stop

@section('user-name')
@stop

@section('head-content')

    {{ HTML::style('frontend/ckeditor/css/samples.css') }}
    {{ HTML::style('frontend/ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}

    {{ HTML::script('frontend/ckeditor/js/ckeditor.js') }}
    {{ HTML::script('frontend/ckeditor/js/sample.js') }}

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
        .widget-container{
            background-color: rgba(245,245,245,0.3);
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

        .nav-tabs a {
            background-color: #eee;
        }

        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
            background-color: #bbb7b4;
            color: white !important;
        }
        @media(max-width: 767px){
            ul.breadcrumb {
                margin-top: 50px;
            }            
        }        
        /*-----------------*/

    </style>
    <script>
        $(document).ready(function() {
            INIT_TOS_ES();
            INIT_TOS_TG();
            $('#myTabs a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
            })
            $(function() {
                // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    // save the latest tab; use cookies if you like 'em better:
                    localStorage.setItem('lastTab', $(this).attr('href'));
                });

                // go to the latest tab, if it exists:
                var lastTab = localStorage.getItem('lastTab');
                if (lastTab) {
                    $('[href="' + lastTab + '"]').tab('show');
                }
            });
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
                    <li class="active">
                        <a href="/SYSTEMSETTINGS">System Settings</a>
                    </li>
                    <li>
                        Terms of Service and Policy Documents
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#ES_VERSION" aria-controls="home" role="tab" data-toggle="tab">TOS - English Version</a></li>
                    <li role="presentation"><a href="#TG_VERSION" aria-controls="profile" role="tab" data-toggle="tab">TOS - Tagalog Version</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active fade in" id="ES_VERSION">
                    <div class="col-md-12">
                        <form method="POST" action="TOS_SAVE_ES">
                            <div class="adjoined-bottom">
                                <div class="grid-container">
                                    <div class="grid-width-100" style="padding: 0; margin: 0;">
                                        <textarea class="ckeditor-editor" name="editor" id="editor">{{$content_es}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="border-radius: 0.3em;">Save (TOS - ENGLISH VERSION)</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="TG_VERSION">
                    <div class="col-md-12">
                        <form method="POST" action="TOS_SAVE_TG">
                            <div class="adjoined-bottom">
                                <div class="grid-container">
                                    <div class="grid-width-100" style="padding: 0; margin: 0;">
                                        <textarea name="editor" id="editor_tg">{{$content_tg}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="border-radius: 0.3em;">Save (TOS - TAGALOG VERSION)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop