@extends('layouts.usermain')

@section('title')
    Search for Taskminators
@stop

@section('head-content')
    <style>
        i{cursor:default !important;}
        body{background-color:#E9EAED;}
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
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
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#searchField').change(function(){
                if($(this).val() == 'city'){
//                        $('#searchCity-controls').fadeIn();
                    $('#city').prop('disabled', false);
                }
            });

            $('#tskmntrSearchBtn').click(function(){
                var searchField = '0',
                    searchKeyword = '0',
                    city = '0';

                if($('#searchField').val() != ''){
                    searchField = $('#searchField').val();
                }

//                alert($('#searchKeyword').val() == '');

                if($('#searchKeyword').val() != ''){
                    searchKeyword = $('#searchKeyword').val();
                }

                if($('#city').val() != ''){
                    city = $('#city').val();
                }

                location.href = '/doTskmntrSearch='+searchField+'='+searchKeyword+'='+city;

            })
        })
    </script>
@stop

@section('user-name')
    {{ Auth::user()->companyName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
    <!--        <h1>-->
    <!--            Search for Taskminators-->
    <!--        </h1>-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Search Taskminator
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
    <!--                        <form method="POST" action="/doTskmntrSearch">-->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
                                            <div class="caret pull-right"></div>
                                            Search Field</a>
                                        </div>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseOne">
                                        <div class="panel-body">
                                            <select name="searchField" id="searchField" class="form-control">
                                                <option value="username">Username</option>
                                                <option value="fullName">Name</option>
                                <!--                <option value="barangay">Barangay</option>-->
                                                <option value="city">City</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
                                            <div class="caret pull-right"></div>
                                            City</a>
                                        </div>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseTwo">
                                        <div class="panel-body">
                                            <select name="city" id="city" disabled class="form-control">
                                                @foreach($cities as $city)
                                                <option value="{{ $city->citycode }}">{{ $city->cityname }}</option>
                                                @endforeach
                                            </select><br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                                            <div class="caret pull-right"></div>
                                            Search Keyword</a>
                                        </div>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseThree">
                                        <div class="panel-body">
                                            <input type="text" id="searchKeyword" name="searchKeyword" placeholder="Enter search keyword" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-collapse">
                                        <div class="panel-body">
                                            <button type="submit" id="tskmntrSearchBtn" class="btn btn-block btn-success">Search</button>
                                        </div>
                                    </div>
                                </div>
    <!--                        </form>-->
                        </div>
                    </div>
                </div>
            </div>
                <!--<form method="POST" action="/tskmntrSearch">
                                $('#city').prop('disabled', false);
                            }
                        });
                    })
                </script>
            </head>
            <body>
                <h3 style="margin: 0;">Search for Taskminators</h3><br/>
                <a href="/">Home</a><br/>
                <a href="/logout">Logout</a><br/><br/>
                <form method="POST" action="/doTskmntrSearch">
                    Search Field :
                    <select name="searchField" id="searchField">
                        <option value="username">Username</option>
                        <option value="fullName">Name</option>
                        <option value="city">City</option>
                    </select><br/>
                    City :
                    <select name="city" id="city" disabled>
                        @foreach($cities as $city)
                        <option value="{{ $city->citycode }}">{{ $city->cityname }}</option>
                        @endforeach
                    </select><br/>
                    <input type="text" name="searchKeyword" placeholder="Enter search keyword"/>
                    <button type="submit">Search</button>
                </form>-->
            <div class="col-sm-9">
                @if(@$taskminators)
                    @if($taskminators->count() > 0)
                        @foreach($taskminators as $tm)
                            <div class="widget-container fluid-height padded" style="padding-bottom: 30px; margin-bottom: 0.8em;">
                                <a target="_tab" href="/{{ $tm->username }}" style="margin-bottom: 0; text-decoration: none !important;">
                                    <h3 style="color: blue; margin-bottom: 0; margin-top: 0.3em">
                                        @if($tm->profilePic)
                                            <img src="{{$tm->profilePic}}" width="80em;" style="border: 1px solid #95A5A6; border-radius: 0.3em;"/>
                                        @else
                                            <img src="/images/default_profile_pic.png" width="80em;" style="border: 1px solid #95A5A6; border-radius: 0.3em;"/>
                                        @endif
                                        {{ $tm->username }}
                                    </h3>
                                </a><br/>
                                Rate : P{{ $tm->minRate }} - P{{$tm->maxRate}}<br/>
                                Address : {{ $tm->address }}<br/>
                                Gender : {{ $tm->gender }}<br/>
                                Educational Background :
                                <span style="color: #7F8C8D;">{{ $tm->educationalBackground }}</span>
                                <hr/>
                                @foreach(User::getSkills($tm->id) as $skill)
                                    <span style="background-color: #BDC3C7; color: white; padding: 8px; border-radius: 0.2em; border:2px solid white; display: inline-block; font-size: 0.9em;">{{ $skill->itemname }}</span>
                                @endforeach
                                <br/>
                                <br/>
                                @if($directTasks->count() > 0)
                                    @foreach($directTasks as $dt)
                                        @if(TaskminatorHasOffer::where('task_id', $dt->id)->where('taskminator_id', $tm->id)->where('client_id', Auth::user()->id)->count() > 0)
                                            <hr style="margin-top: 0"/>
                                            <div class="alert alert-success" style="margin-bottom: 0;">
                                                <span style="color: green;">You have offered this taskminator a task : <span style="font-weight: bolder;">{{ $dt->name }}</span>. Click <a target="_tab" href="/taskDetails/{{$dt->id}}">here</a> for more details</span><br/>
                                            </div>
                                        @else
                                            <a href="/directHire_{{ $tm->id }}">Offer this taskminator a Direct Task</a>
                                            <?php break; ?>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endforeach

                        <center>{{ $taskminators->links() }}</center>
                    @else
                        <div class="alert alert-danger" style="text-align: center;">
                            <i>No results found</i>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>
@stop
