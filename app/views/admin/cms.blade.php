@extends('layouts.usermain')

@section('title')
    {{ $pageName }}
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important; 
        }
    </style>
@stop

@section('body-scripts')
<!--     {{ HTML::script('js/jquery-1.11.0.min.js') }} -->
    <script>
        $(document).ready(function(){
            $('#searchBtn').click(function(){
                var searchWord = 0;
                if($('#searchWord').val() != ''){
                    searchWord = $('#searchWord').val();
                }

                location.href = '{{$formUrl}}='+$('#searchBy').val()+'='+searchWord+'='+$('#workTimeValue').val()+'='+$('#status').val();
            });

            if($('#searchBy').val() == 'name'){
                $('#searchWord').prop('disabled', false);
            }else{
                $('#searchWord').prop('disabled', true);
            }

            $('#searchBy').change(function(){
                if($(this).val() == 'name'){
                    $('#searchWord').prop('disabled', false);
                }else{
                    $('#searchWord').prop('disabled', true);
                }
            })
        });
    </script>
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                {{ $pageName }}
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Bidding Tasks
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="widget-container">
                    <div class="widget-content">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Contents</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="" class="sidemenu">Heading</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="" class="sidemenu">News</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="" class="sidemenu">Articles</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop