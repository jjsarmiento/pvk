@extends('layouts.usermain')

@section('title')
    Edit Task
@stop

@section('head-content')
{{ HTML::style('stylesheets/datepicker-new.css') }}
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
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
//            locationChain($('#city'), $('#barangay'),$('#editTask'), '/chainCity');
            $('.init-datepicker').datepicker({
                format : 'yyyy-mm-dd',
                beforeShowDay : 'enabled'
            });

            locationChain($('#region'), $('#city'),$('#editTask'), '/chainRegion');
            locationChain($('#region'), $('#province'),$('#editTask'), '/chainProvince');
            locationChain($('#city'), $('#barangay'),$('#editTask'), '/chainCity');

            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'POST',
                    url     :   '/chainCategoryItems',
                    data    :   $('#editTask').serialize(),
                    success :   function(data){
                        $.each(data, function(key, value){
                            $('#taskitems').append('<option value="'+ value['itemcode'] +'">'+value['itemname']+'</option>');
                        });
                    },error :   function(){
                        alert('ERR500 : Please check network connectivity');
                    }
                })
            })
        });
    </script>
@stop

@section('user-name')
    {{ Auth::user()->companyName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                Edit Task
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Edit Task
                    </li>
                </ul>
            </div>
        <!--
            <div style="border: 1px solid #333333; padding: 0.4em; margin-top: 2em;">
                <h4 style="color: blue; margin-bottom: 0; margin-top: 0.3em">{{ $task->name }}</h4>
                <span style="color: grey; font-size: 1em">Description : {{ $task->description }}</span><br/>
                <span style="color: grey; font-size: 1em">Category : {{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}</span><br/>
                <span style="color: grey; font-size: 1em">Skill : {{ TaskItem::join('taskcategory', 'taskcategory.categorycode', '=', 'taskitems.item_categorycode')->where('taskitems.itemcode', $task->taskType)->pluck('itemname') }}</span><br/>
                <span style="color: grey; font-size: 1em">Salary : {{ $task->salary }}</span><br/>
                <span style="color: grey; font-size: 1em">Deadline : {{ $task->deadline }}</span><br/>
                <span style="color: grey; font-size: 1em">Created@ : {{ $task->created_at }}</span><br/>
                <span style="color: grey; font-size: 1em">Location : {{ City::where('citycode', $task->city)->pluck('cityname') }}, {{ Barangay::where('bgycode', $task->barangay)->pluck('bgyname') }}</span><br/>
                <span style="color: grey; font-size: 1em">Mode of payment : {{ $task->modeOfPayment }}</span><br/>
                <span style="color: grey; font-size: 1em">Hiring Type : {{ $task->hiringType}}</span><br/>
                    <span style="color: grey; font-size: 1em">
                        Working Time :
                        @if($task->workTime == 'FTIME')
                            Full Time
                        @else
                            Part Time
                        @endif
                    </span><br/>
            </div>
            <br/><br/>
        -->

            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="glyphicon glyphicon-tasks"></i>Task Details
                    </div>
                    <div class="widget-content padded" style="padding: 0 20px;">
                        @if(Session::has('errorMsg'))
                            <div class="alert alert-danger">
                                {{ Session::get('errorMsg') }}
                            </div>
                        @endif
                        @if(Session::has('successMsg'))
                            <div class="alert alert-success">
                                {{ Session::get('successMsg') }}
                            </div>
                        @endif
                        <form method="POST" action="/doEditTask" id="editTask">
                            <fieldset>
                                <input type="hidden" value="{{ $task->id }}" name="taskId"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Task Title</label>{{ Form::text('title', $task->name, array('class' => 'form-control', 'placeholder' => 'Enter task title', 'required' => 'true')) }}
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Task Category</label>
                                            <select name="taskcategory" id="taskcategory" required="required" class="form-control">
                                                @foreach($taskcategories as $taskcategory)
                                                    @if($taskcategory->categorycode == $task->taskCategory)
                                                        <option value="{{ $taskcategory->categorycode }}" selected="selected">{{ $taskcategory->categoryname }}</option>
                                                    @else
                                                        <option value="{{ $taskcategory->categorycode }}">{{ $taskcategory->categoryname }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Person needed</label>
                                            <select name="taskitems" id="taskitems" required="required" class="form-control">
                                                @foreach($intiTaskitems as $items)
                                                    @if($items->itemcode == $task->taskType)
                                                        <option value="{{ $items->itemcode }}" selected="selected">{{ $items->itemname }}</option>
                                                    @else
                                                        <option value="{{ $items->itemcode }}">{{ $items->itemname }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Task Description</label>
                                            <textarea name="description" class="form-control" style="height: 108px">{{$task->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Work Time</label>
                                            <select name="worktime" id="worktime" required="required" class="form-control">
                                                <option value="PTIME"<?php if($task->workTime == 'PTIME'){ echo("selected"); } ?>>Part Time</option>
                                                <option value="FTIME"<?php if($task->workTime == 'FTIME'){ echo("selected"); } ?>>Full Time</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <h5><i class="glyphicon glyphicon-map-marker"></i> &nbsp;Task Location</h5>
                                <div class="row">
    <!--                                <div class="col-md-6">-->
    <!--                                </div>-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">Region</label>
                                            <select id="region" name="region" class="form-control">
                                                @foreach($regions as $region)
                                                @if($region->regcode == $task->region)
                                                <option value="{{$region->regcode}}" selected="selected">{{ $region->regname }}</option>
                                                @else
                                                <option value="{{$region->regcode}}">{{ $region->regname }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select id="city" name="city" class="form-control">
                                                @foreach($cities as $city)
                                                    @if($city->citycode == $task->city)
                                                        <option value="{{$city->citycode}}" selected="selected">{{ $city->cityname }}</option>
                                                    @else
                                                        <option value="{{$city->citycode}}">{{ $city->cityname }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barangay">Barangay</label>
                                            <select id="barangay" name="barangay" class="form-control">
                                                @foreach($barangays as $bgy)
                                                    @if($bgy->bgycode == $task->barangay)
                                                        <option value="{{$bgy->bgycode}}" selected="selected">{{ $bgy->bgyname }}</option>
                                                    @else
                                                        <option value="{{$bgy->bgycode}}">{{ $bgy->bgyname }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <h5><i class="glyphicon glyphicon-map-marker"></i> &nbsp;Hiring Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hiringType">Hiring Type</label>
                                            <select name="hiringType" id="hiringType" required="required" class="form-control">
                                                <option value="AUTOMATIC"<?php if($task->hiringType == 'AUTOMATIC'){ echo("selected"); } ?>>Automatic</option>
                                                <option value="BIDDING"<?php if($task->hiringType == 'BIDDING'){ echo("selected"); } ?>>Bidding</option>
                                                <option value="DIRECT"<?php if($task->hiringType == 'DIRECT'){ echo("selected"); } ?>>Direct</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="deadline">Deadline</label>
                                            {{ Form::text('deadline', $task->deadline, array('class' => 'form-control init-datepicker', 'placeholder' => 'Click here to select a deadline date', 'required' => 'true', 'readonly' => 'true')) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="salaryRange">Salary Range</label>
                                            {{ Form::text('salaryRange', $task->salary, array('class' => 'form-control', 'placeholder' => 'salaryRange', 'required' => 'true')) }}
                                        </div>
                                        <div class="form-group">
                                            <label for="modeOfPayment">Mode of Payment</label>
                                            <select id="modeOfPayment" name="modeOfPayment" required="required" class="form-control">
                                                <option value="CC">Credit Card</option>
                                                <option value="BankTransfer">Bank Transfer</option>
                                                <option value="PayPal">Paypal</option>
                                                <option value="TagCash">Tag Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="TOS">Terms of Service</label> &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="TOS" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Apply Changes to Task Entry</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="row padded">
                            <div class="alert alert-warning">
                                Note: Tasks that already have a bidding or hired Taskminator cannot be edited. Please make sure the details are correct and final.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--form method="POST" action="/doEditTask" id="editTask">
                <input type="hidden" value="{{ $task->id }}" name="taskId"/>
                Title : <input type="text" value="{{$task->name}}" name="title" id="title"/><br/>
                Description : <textarea name="description" id="description" >{{$task->description}}</textarea><br/>
                Task Category :
                <select name="taskcategory" id="taskcategory" required="required">
                    @foreach($taskcategories as $taskcategory)
                    @if($taskcategory->categorycode == $task->taskCategory)
                    <option value="{{ $taskcategory->categorycode }}" selected="selected">{{ $taskcategory->categoryname }}</option>
                    @else
                    <option value="{{ $taskcategory->categorycode }}">{{ $taskcategory->categoryname }}</option>
                    @endif
                    @endforeach
                </select>
                <br/>
                Skill
                <select name="taskitems" id="taskitems" required="required">
                    @foreach($intiTaskitems as $items)
                    @if($items->itemcode == $task->taskType)
                    <option value="{{ $items->itemcode }}" selected="selected">{{ $items->itemname }}</option>
                    @else
                    <option value="{{ $items->itemcode }}">{{ $items->itemname }}</option>
                    @endif
                    @endforeach
                </select>
                <br/>
                Salary Range :
                <input value="{{ $task->salary }}" name="salaryRange" id="salaryRange"/>
                <br/>
                Deadline : <input type="text" value="{{$task->deadline}}" name="deadline" id="deadline"/><br/>
                City :
                <select id="city" name="city">
                    @foreach($cities as $city)
                        @if($city->citycode == $task->city)
                            <option value="{{$city->citycode}}" selected="selected">{{ $city->cityname }}</option>
                        @else
                            <option value="{{$city->citycode}}">{{ $city->cityname }}</option>
                        @endif
                    @endforeach
                </select><br/>
                Barangay :
                <select id="barangay" name="barangay">
                    @foreach($barangays as $bgy)
                        @if($bgy->bgycode == $task->barangay)
                            <option value="{{$bgy->bgycode}}" selected="selected">{{ $bgy->bgyname }}</option>
                        @else
                            <option value="{{$bgy->bgycode}}">{{ $bgy->bgyname }}</option>
                        @endif
                    @endforeach
                </select><br/>
                Mode of payment :
                <select id="modeOfPayment" name="modeOfPayment" required="required">
                    <option value="CC">Credit Card</option>
                    <option value="BankTransfer">Bank Transfer</option>
                    <option value="PayPal">Paypal</option>
                    <option value="TagCash">Tag Cash</option>
                </select>
                <br/>
                Hiring Type :
                <select name="hiringType" id="hiringType" required="required">
                    <option value="AUTOMATIC"<?php if($task->hiringType == 'AUTOMATIC'){ echo("selected"); } ?>>Automatic</option>
                    <option value="BIDDING"<?php if($task->hiringType == 'BIDDING'){ echo("selected"); } ?>>Bidding</option>
                    <option value="DIRECT"<?php if($task->hiringType == 'DIRECT'){ echo("selected"); } ?>>Direct</option>
                </select>
                <br/>
                Work Time :
                <select name="worktime" id="worktime" required="required">
                    <option value="PTIME"<?php if($task->workTime == 'PTIME'){ echo("selected"); } ?>>Part Time</option>
                    <option value="FTIME"<?php if($task->workTime == 'FTIME'){ echo("selected"); } ?>>Full Time</option>
                </select>
                <br/>
                <button type="submit">Edit</button>
            </form>-->
        </div>
    </div>
</section>
@stop