@extends('layouts.usermain')

@section('title')
    Create Job
@stop

@section('head-content')
    {{ HTML::style('stylesheets/datepicker-new.css') }}
    <style>
        body{background-color:#E9EAED;}
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
        h5 {
            margin: 0;
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

            CHAINLOCATION($('#province'), $('#city'));
            locationChain($('#region'), $('#city'),$('#taskCreateForm'), '/chainRegion');
            locationChain($('#region'), $('#province'),$('#taskCreateForm'), '/chainProvince');
//            locationChain($('#city'), $('#barangay'),$('#taskCreateForm'), '/chainCity');

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
                Create a Job Ad
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        Create a Job Ad
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        {{--<i class="glyphicon glyphicon-tasks"></i>Task Details--}}
                                    <h5><i class="fa fa-list"></i> &nbsp;Job Details</h5><br/>
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
                            <form method="POST" action="/doCreateJob" id="taskCreateForm">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Job Title <span style="color: #E74C3C">*</span></label>
                                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'Enter job title', 'required' => 'true')) }}
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Skill Category <span style="color: #E74C3C">*</span></label>
                                                <select name="taskcategory" id="taskcategory" required="required" class="form-control">
                                                    @foreach($taskcategories as $taskcategory)
                                                        <option value="{{ $taskcategory->categorycode }}" <?php if(Input::old('taskcategory') == $taskcategory->categorycode){ echo('selected'); } ?>>{{ $taskcategory->categoryname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Skill needed <span style="color: #E74C3C">*</span></label>
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
                                            <div class="form-group">
                                                <label for="title">Work Duration <span style="color: #E74C3C">*</span></label>
                                                <select name="hireType" id="hireType" required="required" class="form-control">
                                                    <option value="LT6MOS" <?php if(Input::old('hireType') == 'LT6MOS'){ echo('selected'); } ?>>Less than 6 months</option>
                                                    <option value="GT6MOS" <?php if(Input::old('hireType') == 'GT6MOS'){ echo('selected'); } ?>>Greater than 6 months</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="salaryRange">Salary</label>
                                                {{ Form::text('salaryRange', Input::old('salaryRange'), array('class' => 'form-control', 'placeholder' => 'salaryRange')) }}
                                            </div>
                                            <div class="well">
                                                <h4>Company Snapshots</h4>
                                                <br/>
                                                <div class="form-group">
                                                    <label>Average Processing Time</label>
                                                    <input type="text" class="form-control" name="AverageProcessingTime" id="AverageProcessingTime"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Industry</label>
                                                    <input type="text" class="form-control" name="Industry" id="Industry"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Company Size</label>
                                                    <input type="text" class="form-control" name="CompanySize" id="CompanySize"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Working Hours</label>
                                                    <input type="text" class="form-control" name="WorkingHours" id="WorkingHours"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dress Code</label>
                                                    <input type="text" class="form-control" name="DressCode" id="DressCode"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Job Description <span style="color: #E74C3C">*</span></label>
                                                <textarea rows="10" name="description" placeholder="Provide a short description of what the job is about" class="form-control" >{{ Input::old('description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Other Qualifications (Other skills and competencies Required)</label>
                                                <textarea rows="10" name="otherskills" class="form-control" placeholder="Example : Baby Sitting, English Proficiency, Household Chores, ..."></textarea>
                                                <span style="color: #E74C3C; font-weight: bold;">*Please seperate skills with comma</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="requirements">Requirements (What to bring)</label>
                                                <textarea rows="10" name="requirements" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5><i class="glyphicon glyphicon-map-marker"></i> &nbsp;Job Location <span style="color: #E74C3C">*</span></h5><br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">Region</label>
                                                <select name="region" id="region" class="form-control" required="required">
                                                    @foreach($regions as $region)
                                                        <option data-regcode="{{ $region->regcode }}" value="{{ $region->regcode }}" <?php if(Input::old('region') == $region->regcode){ echo('selected'); } ?>> {{ $region->regname }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Province</label>
                                                <select name="province" id="province" class="form-control" required="required" data-loctypeother="PROVINCE_TO_CITY">
                                                    @if(Input::old('region'))
                                                        @foreach(Province::where('regcode', Input::old('region'))->get() as $p)
                                                            <option value="{{$p->provcode}}">{{$p->provname}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($provinces as $p)
                                                            <option value="{{$p->provcode}}">{{$p->provname}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                    </div>
                                    <div class="row" style="margin-bottom: 1em;">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary pull-right">Post Ad</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop