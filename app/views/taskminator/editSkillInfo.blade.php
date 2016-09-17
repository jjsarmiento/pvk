@extends('layouts.usermain')

@section('title')
    Edit Skill Information
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    h5 {
        margin: 0;
    }
    .btn-primary
    {
        background-color:#ccc !important;
        border-radius: 4px;
        cursor: default !important;
    }
    .btn-primary:hover
    {
        background-color: #2980b9 !important;
        color:white;
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
    n
</style>
@stop

@section('body-scripts')
    {{ HTML::script('js/taskminator.js') }}
    <script>
        $(document).ready(function(){
            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'POST',
                    url     :   '/chainCategoryItems',
                    data    :   $('#doEditSkillInfo').serialize(),
                    success :   function(data){
                        $.each(data, function(key, value){
                            $('#taskitems').append('<option value="'+ value['itemcode'] +'">'+value['itemname']+'</option>');
                        });
                    },error :   function(){
                        alert('ERR500 : Please check network connectivity');
                    }
                })
            });

            $('.remove-skill').click(function(){
                if(confirm('Do you really want to remove this skill?')){
                    location.href = $(this).attr('data-href');
                }
            });
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
                Edit Personal Information
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li>
                        <a href="/editProfile">Edit Profile</a>
                    </li>
                    <li class="active">
                        Edit Personal Information
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                    <div class="heading">
                        <h4 style="color:#333333; margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-signal"></i>&nbsp&nbsp Current Skills</h4>
                    </div>
                    <div class="widget-content padded">
                        @foreach($skills as $skill)
                            <span class="btn btn-xs btn-primary" style="font-size: 13px;">{{ $skill->itemname }} &nbsp;&nbsp;<a class="remove-skill" href="#" data-href="/removeSkill={{$skill->taskitem_code}}" title="Remove this skill" style="color:red;">x</a></span>
                        @endforeach
                        <hr/>
                        <form method="POST" action="/doEditSkillInfo" id="doEditSkillInfo">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="taskcategory" id="taskcategory" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->categorycode }}">{{ $category->categoryname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Skill</label>
                                <select name="taskitems" id="taskitems" class="form-control">
                                    @foreach($categorySkills as $skill)
                                        <option value="{{ $skill->itemcode }}">{{ $skill->itemname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right padded">
                                <button type="submit" class="btn btn-success">Add Skill</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-container">
                    <div class="heading">
                        <h4 style="color:#333333; margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-signal"></i><iclass="fa fa-signal"></i>&nbsp&nbsp Own Custom Skills</h4>
                    </div>
                     <div class="widget-content padded">
                        @foreach($worker_cust_skills as $cs)
                            <span class="btn btn-xs btn-primary" style="font-size: 13px;">{{ $cs->skill}} &nbsp;&nbsp;<a class="remove-skill" href="#" data-href="/RMVCSTMSKLL={{$cs->id}}" title="Remove this skill" style="color:red;">x</a></span>
                        @endforeach
                   
                        <form method="POST" action="/ADDOWNSKILL" id="doEditSkillInfo">
                            <div class="form-group">
                                <label>Input your own skill</label>
                                <textarea required="required" name="customskills" rows="7" placeholder="Example : Baby Sitting, English Proficiency, Household Chores, ..." class="form-control"></textarea>
                            </div>
                            <div class="text-right padded">
                                <button type="submit" class="btn btn-success">Add Own Custom Skill</button>
                            </div>
                        </form>
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
                            <div class="panel-body" style="margin-top:-25px;">
                                @foreach($prog as $r)
                                    <a href="{{$r['url']}}">{{$r['content']}}</a><br/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@stop