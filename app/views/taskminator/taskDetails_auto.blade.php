@extends('layouts.usermain')

@section('title')
    Task Details
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('head-content')
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

@section('contents')
<section class="lato-text">
	<div class="container">
		<div class="page-title">
	        <h1 class="lato-text">
	            Task Details
	        </h1>
	    </div>
	    <div class="row">
	        <div class="col-lg-12">
	            <ul class="breadcrumb">
	                <li>
	                    <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
	                </li>
	                <li> Previous Page</li>
	                <li class="active">
	                    Task Details
	                </li>
	            </ul>
	        </div>
	        <div class="col-md-8">
	            <div class="widget-container" style="min-height: 150px; padding-bottom: 5px; padding-top: 20px;">
	                <div class="widget-content padded">
	                	<h4 style="color: blue; margin-bottom: 0; margin-top: 0.3em">{{ $task->name }}</h4>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Description </span>
						: <span style="margin-left: 5px">{{ $task->description }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Category </span>
						: <span style="margin-left: 5px">{{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Skill </span>
						: <span style="margin-left: 5px">{{ TaskItem::join('taskcategory', 'taskcategory.categorycode', '=', 'taskitems.item_categorycode')->where('taskitems.itemcode', $task->taskType)->pluck('itemname') }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Salary </span>
						: <span style="margin-left: 5px">{{ $task->salary }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Deadline </span>
						: <span style="margin-left: 5px">{{ $task->deadline }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date Created </span>
						: <span style="margin-left: 5px">{{ $task->created_at }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Location </span>
						: <span style="margin-left: 5px">{{ City::where('citycode', $task->city)->pluck('cityname') }}, {{ Barangay::where('bgycode', $task->barangay)->pluck('bgyname') }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Mode of payment </span>
						: <span style="margin-left: 5px">{{ $task->modeOfPayment }}</span><br/>
						<span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Hiring Type </span>
						: <span style="margin-left: 5px">{{ $task->hiringType}}</span><br/>
		                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">
		                    Working Time 
		                </span>:<span style="margin-left: 5px">
		                    @if($task->workTime == 'FTIME')
		                        Full Time
		                    @else
		                        Part Time
		                    @endif
		                </span><br/>
						@if($hired->count() != 0)
							<hr/>
							@foreach($hired as $h)
								@foreach(User::where('id', $h->taskminator_id)->get() as $user)
									<div class="well selected-filters">
									    sds
									</div>
								@endforeach
							@endforeach
						@endif
						@if(TaskHasTaskminator::where('task_id', $task->id)->count() == 0 && TaskHasBidder::where('task_id', $task->id)->count() == 0)
							<hr/>
							<div class="row">
								<a href="/editTask/{{ $task->id }}" class="btn btn-primary">Edit Task Details</a><br/>
								<a href="/deleteTask/{{ $task->id }}" class="btn btn-danger">Cancel Task</a>
							</div>
						@endif
	                </div>
	            </div>
	        </div>
	        <div class="col-md-4">
	            <div class="widget-container small">
	                @if(Auth::user()->profilePic == null)
	                    <div class="heading">
	                        <i class="icon-signal"></i>Please upload a profile picture
	                    </div>
	                    <div class="widget-content padded">
	                        {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
	                            <input type="file" name="profilePic" accept="image/*" class="form-control" /><br/>
	                            <button type="submit" class="btn btn-success">Upload</button>
	                        {{ Form::close() }}
	                    </div>
	                @else
	                    <div class="widget-content padded">
	                        <div class="heading">
	                            <i class="glyphicon glyphicon-user"></i>{{ Auth::user()->fullName }}
	                        </div>
	                        <div class="thumbnail">
	                            <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
	                        </div>
	                    </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
</section>
	<!--<h4 style="color: blue; margin-bottom: 0; margin-top: 0.3em">{{ $task->name }}</h4>
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
	@if($hired->count() != 0)
	<hr/>
	@foreach($hired as $h)
	@foreach(User::where('id', $h->taskminator_id)->get() as $user)
	<div style="border: 1px solid #333333; margin-bottom: 0.4em; padding: 0.2em;">
	    sds
	</div>
	@endforeach
	@endforeach
	@endif
	@if(TaskHasTaskminator::where('task_id', $task->id)->count() == 0 && TaskHasBidder::where('task_id', $task->id)->count() == 0)
	<hr/>
	<a href="/editTask/{{ $task->id }}">Edit Task Details</a><br/>
	<a href="/deleteTask/{{ $task->id }}">Cancel Task</a>
	@endif-->
@stop