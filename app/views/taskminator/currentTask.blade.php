@extends('layouts.usermain')

@section('title')
    Taskminator - Task Offers
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

@section('body-scripts')
        <script>
            $(document).ready(function(){
                $('.bid-cancel-btn').click(function(){
                    if(confirm('Do you want to cancel your bid for '+$(this).attr('data-task')+'?')){
                        location.href = $(this).attr('data-href');
                    }
                });

                $('.task-take').click(function(){
                    if(confirm("Accepting this task means you are willing to comply with the client's task details. Do you want to take this task?")){
                        location.href = $(this).attr('data-href');
                    }
                });

                $('.task-deny').click(function(){
                    if(confirm("Denying this task will remove this from your offered task list. Do you want to deny this task?")){
                        location.href = $(this).attr('data-href');
                    }
                });
            })
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
                {{ $pageTitle }}
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

            @if(Session::has('errorMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        {{ @Session::has('errorMsg') }}
                    </div>
                </div>
            @endif
            @if(Session::has('successMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ @Session::has('successMsg') }}
                    </div>
                </div>
            @endif

            <div class="col-md-8">
                @if(@$tasksBid)
                    @if($tasksBid->count() == 0)
                        <div class="well selected-filters" style="text-align: center">
                            <font style="color: red">You have not yet made a bid for a task yet.</font>
                        </div>
                    @else
                        <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                            <div class="widget-content padded">
                                <h4>Task Bids : </h4>
                                @foreach($tasksBid as $tt)
                                    <div style="border: 1px solid #333333; padding: 0.4em">
                                        <span style="color: blue; font-weight: bold;"><a href="/taskDetails_{{$tt->id}}">{{ $tt->name }}</a></span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Date</span>
                                         : <span style="margin-left: 5px">{{ $tt->taskDate }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Deadline</span>
                                         : <span style="margin-left: 5px">{{ $tt->deadline }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date of Bid</span>
                                         : <span style="margin-left: 5px">{{ $tt->bidDate }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task owner</span>
                                         : <span style="margin-left: 5px"><a target="_tab" href="/profile/{{User::where('id', $tt->user_id)->pluck('id')}}">{{ User::where('id', $tt->user_id)->pluck('fullName') }}</a></span>
                                        <hr/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Your Bid</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Proposed Rate</span>
                                         : <span style="margin-left: 5px">P{{ TaskHasBidder::where('task_id', $tt->id)->where('taskminator_id', Auth::user()->id)->pluck('proposedRate') }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Message</span>
                                         : <span style="margin-left: 5px">{{ TaskHasBidder::where('task_id', $tt->id)->where('taskminator_id', Auth::user()->id)->pluck('message') }}</span><br/>
                                        <hr/>
                                        <a href="#" class="bid-cancel-btn btn btn-danger" data-task="{{ $tt->name }}" data-href="/cancelBid/{{$tt->id}}">Cancel Bid</a>
                                    </div>
                                @endforeach
                                <br/>
                                {{ $tasksBid->links() }}
                            </div>
                        </div>
                    @endif
                @endif()

                @if(@$taskOffer)
                    @if($taskOffer->count() == 0)
                        <div class="well selected-filters" style="text-align: center">
                            <font style="color: red">You currently have no offers.</font>
                        </div>
                    @else
                        @foreach($taskOffer as $tt)
                            <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                                <div class="widget-content padded">
                                    <span style="color: blue; font-weight: bold;"><a href="/taskDetails_{{$tt->id}}">{{ $tt->name }}</a></span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Date</span>
                                     : <span style="margin-left: 5px">{{ $tt->taskDate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Deadline</span>
                                     : <span style="margin-left: 5px">{{ $tt->deadline }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date Offered</span>
                                    : <span style="margin-left: 5px">{{ $tt->offerDate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task owner</span>
                                     : <span style="margin-left: 5px"><a target="_tab" href="/profile/{{User::where('id', $tt->user_id)->pluck('id')}}">{{ User::where('id', $tt->user_id)->pluck('fullName') }}</a></span>
                                    <hr/>
                                    <div class="row" style="padding-left:15px;">
                                        <a class="task-take btn btn-primary" href="#" data-task="{{ $tt->name }}" data-href="/confirmOffer/{{$tt->id}}">Take</a>
                                        <a class="task-deny btn btn-danger" href="#" data-task="{{ $tt->name }}" data-href="/denyOffer/{{$tt->id}}">Deny</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                        <br/>
                        {{ $taskOffer->links() }}
                    @endif
                @endif

                @if(@$tasksTaken)
                    @if($tasksTaken->count() == 0)
                        <div class="well selected-filters" style="text-align: center">
                            <font style="color: red">You currently have no ongoing tasks.</font>
                        </div>
                    @else
                        <h4>Ongoing Tasks :</h4>
                        @foreach($tasksTaken as $tt)
                            <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                                <div class="widget-content padded">
                                    <span style="color: blue; font-weight: bold;"><a href="/taskDetails_{{$tt->id}}">{{ $tt->name }}</a></span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Date</span>
                                     : <span style="margin-left: 5px">{{ $tt->taskDate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Deadline</span>
                                     : <span style="margin-left: 5px">{{ $tt->deadline }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date Hired</span>
                                     : <span style="margin-left: 5px">{{ $tt->hireDate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task owner</span>
                                     : <span style="margin-left: 5px"><a target="_tab" href="/profile/{{User::where('id', $tt->user_id)->pluck('id')}}">{{ User::where('id', $tt->user_id)->pluck('fullName') }}</a></span>
                                </div>
                            </div>
                        @endforeach
                        {{ $tasksTaken->links() }}
                    @endif
                @endif

                @if(@$tasksDone)
                    @if($tasksDone->count() == 0)
                        <div class="well selected-filters" style="text-align: center">
                            <font style="color: red">You have not completed a task yet.</font>
                        </div>
                    @else
                        <h4>Tasks Completed :</h4>
                        @foreach($tasksDone as $tt)
                            <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                                <div class="widget-content padded">
                                    <span style="color: blue; font-weight: bold;"><a href="/taskDetails_{{$tt->id}}">{{ $tt->name }}</a></span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task Created Date</span>
                                     : <span style="margin-left: 5px">{{ $tt->taskDate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date Hired</span>
                                     : <span style="margin-left: 5px">{{ $tt->hireDate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date Completed</span>
                                     : <span style="margin-left: 5px">{{ $tt->completed_at }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Task owner</span>
                                     : <span style="margin-left: 5px"><a target="_tab" href="/profile/{{User::where('id', $tt->user_id)->pluck('id')}}">{{ User::where('id', $tt->user_id)->pluck('fullName') }}</a></span>
                                    <hr/>
                                    <?php $ratings = Rate::where('taskminator_id', Auth::user()->id)->where('client_id', $tt->user_id)->first() ?>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Ratings</span>
                                     : <span style="margin-left: 5px">{{ $ratings->stars }}/5 Stars</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Review</span>
                                     : <span style="margin-left: 5px">{{ $ratings->message }}</span>
                                </div>
                            </div>
                        @endforeach
                        {{ $tasksDone->links() }}
                    @endif

                @endif
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
@stop