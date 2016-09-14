@extends('layouts.usermain')

@section('title')
    Create Task
@stop

@section('head-content')
    {{ HTML::style('stylesheets/datepicker-new.css') }}
    <style>
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

@section('user-name')
    {{ Auth::user()->companyName }}
@stop

@section('body-scripts')
    {{ HTML::script('js/taskminator.js') }}
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('.init-datepicker').datepicker({
                format : 'yyyy-mm-dd',
                beforeShowDay : 'enabled'
            });
//            locationChain($('#city'), $('#barangay'),$('#taskCreateForm'), '/chainCity');
            $('#loadingContent').hide();
            $('#mainContent').fadeIn();

            locationChain($('#region'), $('#city'),$('#taskCreateForm'), '/chainRegion');
            locationChain($('#region'), $('#province'),$('#taskCreateForm'), '/chainProvince');
            locationChain($('#city'), $('#barangay'),$('#taskCreateForm'), '/chainCity');

            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'POST',
                    url     :   '/chainCategoryItems',
                    data    :   $('#taskCreateForm').serialize(),
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


@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                Create Task
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Create Task
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="glyphicon glyphicon-tasks"></i>Task Details
                    </div>
                    <div class="widget-content padded" style="padding: 0 20px;">
                        <div id="loadingContent" style="text-align: center;">
                            <span class="glyphicon glyphicon-refresh" style="margin-top: 2em; font-size: 2.3em; margin-bottom: 0.6em;"></span><br/>
                            Please wait while content is being loaded
                        </div>
                        <div id="mainContent" style="display: none;">
                            @if(Session::has('errorMsg'))
                            <div class="alert alert-danger">
                                {{ Session::get('errorMsg') }}
                            </div>
                            @endif
                            <form method="POST" action="/createTask" id="taskCreateForm">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Task Title</label>{{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'Enter task title', 'required' => 'true')) }}
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Task Category</label>
                                                <select name="taskcategory" id="taskcategory" required="required" class="form-control">
                                                    @foreach($taskcategories as $taskcategory)
                                                    <option value="{{ $taskcategory->categorycode }}" <?php if(Input::old('taskcategory') == $taskcategory->categorycode){ echo('selected'); } ?>>{{ $taskcategory->categoryname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Person needed</label>
                                                <select name="taskitems" id="taskitems" required="required" class="form-control">
                                                    @if(Input::old('taskcategory'))
                                                    @foreach(TaskItem::where('item_categorycode', Input::old('taskcategory'))->orderBy('itemname', 'ASC')->get() as $items)
                                                    <option value="{{ $items->itemcode }}" <?php if(Input::old('taskitems') == $items->itemcode){ echo('selected'); } ?>>{{ $items->itemname }}</option>
                                                    @endforeach
                                                    @else
                                                    @foreach($intiTaskitems as $items)
                                                    <option value="{{ $items->itemcode }}" <?php if(Input::old('taskitems') == $items->itemcode){ echo('selected'); } ?>>{{ $items->itemname }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Task Description</label>
                                                <textarea name="description" class="form-control" style="height: 108px" required="required">{{ Input::old('description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Work Time</label>
                                                <select name="worktime" id="worktime" required="required" class="form-control">
                                                    <option value="PTIME" <?php if(Input::old('worktime') == 'PTIME'){ echo('selected'); } ?>>Part Time</option>
                                                    <option value="FTIME" <?php if(Input::old('worktime') == 'FTIME'){ echo('selected'); } ?>>Full Time</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5><i class="glyphicon glyphicon-map-marker"></i> &nbsp;Task Location</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">Region</label>
                                                <select name="region" id="region" class="form-control" required="required">
                                                    @foreach($regions as $region)
                                                    <option data-regcode="{{ $region->regcode }}" value="{{ $region->regcode }}" <?php if(Input::old('region') == $region->regcode){ echo('selected'); } ?>> {{ $region->regname }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select name="city" id="city" required="required" class="form-control">
                                                    @if(Input::old('region'))
                                                    @foreach(City::where('regcode', Input::old('region'))->orderBy('cityname', 'ASC')->get() as $city)
                                                    <option value="{{ $city->citycode }}" <?php if(Input::old('city') == $city->citycode){ echo('selected'); } ?>>{{ $city->cityname }}</option>
                                                    @endforeach
                                                    @else
                                                    @foreach($cities as $city)
                                                    <option value="{{ $city->citycode }}" <?php if(Input::old('city') == $city->citycode){ echo('selected'); } ?>>{{ $city->cityname }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barangay">Barangay</label>
                                                <select name="barangay" id="barangay" class="form-control" required="required">
                                                    @if(Input::old('city'))
                                                    @foreach(Barangay::where('citycode', Input::old('city'))->orderBy('bgyname', 'ASC')->get() as $bgy)
                                                    <option value="{{$bgy->bgycode}}" <?php  if(Input::old('barangay') == $bgy->bgycode){ echo('selected'); } ?>>{{ $bgy->bgyname }}</option>
                                                    @endforeach
                                                    @else
                                                    @foreach($barangays as $bgy)
                                                    <option value="{{$bgy->bgycode}}" <?php  if(Input::old('barangay') == $bgy->bgycode){ echo('selected'); } ?>>{{ $bgy->bgyname }}</option>
                                                    @endforeach
                                                    @endif
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
                                                    @if(Auth::user()->accountType != 'BASIC')
                                                    <option value="AUTOMATIC" <?php if(Input::old('hiringType') == 'AUTOMATIC'){ echo('selected'); } ?>>Automatic</option>
                                                    @endif
                                                    <option value="BIDDING" <?php if(Input::old('hiringType') == 'BIDDING'){ echo('selected'); } ?>>Bidding</option>
                                                    <option value="DIRECT" <?php if(Input::old('hiringType') == 'DIRECT'){ echo('selected'); } ?>>Direct</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="deadline">Deadline</label>
                                                {{ Form::text('deadline', Input::old('deadline'), array('class' => 'init-datepicker form-control', 'placeholder' => 'Click here to select deadline date', 'readonly' => 'true','required' => 'true')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="salaryRange">Salary Range</label>
                                                {{ Form::text('salaryRange', Input::old('salaryRange'), array('class' => 'form-control', 'placeholder' => 'salaryRange', 'required' => 'true')) }}
                                            </div>
                                            <div class="form-group">
                                                <label for="modeOfPayment">Mode of Payment</label>
                                                <select id="modeOfPayment" name="modeOfPayment" required="required" class="form-control">
                                                    <option value="CC" <?php if(Input::old('modeOfPayment') == 'CC'){ echo('selected'); } ?>>Credit Card</option>
                                                    <option value="BankTransfer" <?php if(Input::old('modeOfPayment') == 'BankTransfer'){ echo('selected'); } ?>>Bank Transfer</option>
                                                    <option value="PayPal" <?php if(Input::old('modeOfPayment') == 'PayPal'){ echo('selected'); } ?>>Paypal</option>
                                                    <option value="TagCash" <?php if(Input::old('modeOfPayment') == 'TagCash'){ echo('selected'); } ?>>Tag Cash</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="TOS">Terms of Service</label> &nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" name="TOS" required="required"/>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create Task</button>
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
            </div>
        </div>
    </div>
</section>
@stop