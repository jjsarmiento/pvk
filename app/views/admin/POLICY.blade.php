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
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        <a href="/SYSTEMSETTINGS">System Settings</a>
                    </li>
                    <li>
                        Policy
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#ES_VERSION" aria-controls="home" role="tab" data-toggle="tab">Policy - English Version</a></li>
                    <li role="presentation"><a href="#TG_VERSION" aria-controls="profile" role="tab" data-toggle="tab">Policy - Tagalog Version</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active fade in" id="ES_VERSION">
                    <div class="col-md-12">
                        <form method="POST" action="POLICY_SAVE_ES">
                            <div class="adjoined-bottom">
                                <div class="grid-container">
                                    <div class="grid-width-100" style="padding: 0; margin: 0;">
                                        <textarea class="ckeditor-editor" name="editor" id="editor">{{$pol_es}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="border-radius: 0.3em;">Save (POLICY - ENGLISH VERSION)</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="TG_VERSION">
                    <div class="col-md-12">
                        <form method="POST" action="POLICY_SAVE_TG">
                            <div class="adjoined-bottom">
                                <div class="grid-container">
                                    <div class="grid-width-100" style="padding: 0; margin: 0;">
                                        <textarea name="editor" id="editor_tg">{{$pol_tg}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="border-radius: 0.3em;">Save (POLICY - TAGALOG VERSION)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop