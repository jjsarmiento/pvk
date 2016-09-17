@extends('layouts.usermain')

@section('title')
    {{$job->title}}
@stop

@section('head-content')
    <style type="text/css">
        .badge {
            background-color: #1ABC9C;
            width: auto;
            max-width: 10em;
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }

        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }

        .hrLine
        {
            background:none;
            border:0;
            border-bottom:1px solid #2980b9;
            min-width: 100%;
            height:1px;
        }

        .badge:hover{
            background-color: #F1C40F;
            color : #000000;
        }
        
        .DELETE_CUSTOM_SKILL{
            cursor:pointer;
        }
    </style>
    {{ HTML::script('js/taskminator.js') }}
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){

            locationChain($('#region'), $('#city'),$('#JOBEDITFORM'), '/chainRegion');
            CHAINLOCATION($('#region'), $('#province'));
            CHAINLOCATION($('#province'), $('#city'));

            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'POST',
                    url     :   '/chainCategoryItems',
                    data    :   $('#JOBEDITFORM').serialize(),
                    success :   function(data){
                        $.each(data, function(key, value){
                            $('#taskitems').append('<option value="'+ value['itemcode'] +'">'+value['itemname']+'</option>');
                        });
                    }
                })
            });

            $('.DELETE_CUSTOM_SKILL').click(function(){
                if(confirm('Do you want to delete this skill?')){
                    location.href="/JOB_DELETECUSTSKILL="+$(this).data('custskillid');
                }
            });
        });
    </script>
@stop


@section('content')
<section>
    <form method="POST" action="/doEditJob" id="JOBEDITFORM">
        <div class="container lato-text">
            <div class="col-md-8">
                <input type="hidden" id="JOB_ID" name="JOB_ID" value="{{$job->id}}"/>
                <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{$job->title}}" required="required" />
                    </div>
                    <div class="row" style="text-align: left">
                        <div class="col-md-7">
                            <div class="col-md-4">Duration</div>
                            <div class="col-md-8">
                                <select class="form-control" required="required" name="hiring_type" id="hiring_type">
                                    <option <?php if($job->hiring_type == 'GT6MOS'){echo "selected";} ?> value="GT6MOS">Greater than 6 months</option>
                                    <option <?php if($job->hiring_type == 'LT6MOS'){echo "selected";} ?> value="LT6MOS">Less than 6 months</option>
                                </select>
                            </div>
                            <br/><br/>
                            <div class="col-md-4">
                                Skill Category
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" required="required" name="taskcategory" id="taskcategory">
                                    @foreach($categories as $c)
                                        <option <?php if($job->categorycode == $c->categorycode){echo "selected";} ?> value="{{$c->categorycode}}">{{ $c->categoryname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/><br/>
                            <div class="col-md-4">
                                Skill
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" required="required" name="taskitems" id="taskitems">
                                    @foreach($skills as $s)
                                        <option <?php if($job->itemcode == $s->itemcode){echo "selected";} ?> value="{{$s->itemcode}}">{{$s->itemname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/><br/><br/>
                            {{--LOCATION DETAILS -- START--}}
                            <div class="col-md-4">
                                Region
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" required="required" name="region" id="region">
                                    @foreach($regions as $region)
                                        <option data-regcode="{{ $region->regcode }}" value="{{ $region->regcode }}" <?php if($job->regcode == $region->regcode){ echo('selected'); } ?>> {{ $region->regname }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <br/><br/>

                            <div class="col-md-4">
                                Province
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" required="required" name="province" id="province" data-loctype="REGION_TO_PROVINCE" data-loctypeother="PROVINCE_TO_CITY">
                                    @foreach($provinces as $prov)
                                        <option value="{{ $prov->provcode }}" <?php if($job->provcode == $prov->provcode){ echo('selected'); } ?>>{{ $prov->provname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/><br/>

                            <div class="col-md-4">
                                City
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" required="required" name="city" id="city">
                                    @foreach($cities as $city)
                                        <option value="{{ $city->citycode }}" <?php if($job->citycode == $city->citycode){ echo('selected'); } ?>>{{ $city->cityname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/><br/><br/>
                            {{--LOCATION DETAILS -- END--}}
                            <div class="col-md-4">Salary</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{$job->salary}}" name="salary" id="salary"/>
                            </div>
                            <br/><br/><br/>
                        </div>
                        <div class="col-md-5">
                            <label>Description</label>
                            <textarea name="description" id="description" required="required" class="form-control" style="height: auto; text-align: justify;" rows="15">{{ $job->description }}</textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Average Processing Time</label>
                                <input type="text" name="AverageProcessingTime" id="AverageProcessingTime" value="{{$job->AverageProcessingTime}}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Industry</label>
                                <input type="text" id="Industry" name="Industry" value="{{$job->Industry}}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Company Size</label>
                                <input type="text" id="CompanySize" name="CompanySize" value="{{$job->CompanySize}}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Working Hours</label>
                                <input type="text" id="WorkingHours" name="WorkingHours" value="{{$job->WorkingHours}}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Dress Code</label>
                                <input type="text" id="DressCode" name="DressCode" value="{{$job->DressCode}}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit">Save Edit</button>
                </div>
            </div>
            <div class="col-md-4 padded" style="background-color: #ffffff;">
                {{--<div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">--}}
                    <div class="form-group">
                        <label>Other Requirements (What to bring)</label>
                        <textarea rows="7" name="requirements" class="form-control">{{$job->requirements}}</textarea>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>Other Qualifications (Other skills and competencies Required)</label>
                        <textarea placeholder="Example : Baby Sitting, English Proficiency, Household Chores, ..." rows="7" name="otherskills" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        @foreach($custom_skills as $cs)
                            <span style="font-size: 1em; margin: 0.3em;" class="badge DELETE_CUSTOM_SKILL" data-custskillid="{{$cs->id}}">{{$cs->skill}} <i class="DELETE_CUSTOM_SKILL fa fa-trash" data-custskillid="{{$cs->id}}"></i></span>
                        @endforeach
                    </div>
                {{--</div>--}}
            </div>
        </div>
    </form>
</section>
@stop