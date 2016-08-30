@extends('layouts.admin.master')
    @section('head')
        <script>
            $(document).ready(function() {
                $('#INIT_SEARCH').click(function() {
                    var chkout = $('#checkOut').val(),
                        acctSt = $('#acctStatus').val(),
                        orderBy = $('#orderBy').val(),
                        keyword = ($('#keyword').val() ? $('#keyword').val() : 'NONE');

                    location.href = '/subadmin/workers='+chkout+'='+acctSt+'='+orderBy+'='+keyword+'='+$('#PAGE_TITLE').text();
                });
            });
        </script>
    @stop

    @section('title')
        {{$title}} | Proveek
    @stop

    @section('content_header')
      <h1><span id="PAGE_TITLE">{{$title}}</span>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin">Dashboard</a></li>
        <li>{{$title}}</li>
      </ol>
    @stop

    @section('body')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            @if($title == 'Workers - User Accounts List')
                                <div class="col-md-3">
                                    <select class="form-control" id="checkOut" name="checkOut">
                                        <option value="ALL">Display All Checkout Status</option>
                                        <option <?php if($checkout == 1){ echo 'selected'; } ?> value="1">Checked Out</option>
                                        <option <?php if($checkout == 0){ echo 'selected'; } ?> value="0">Not Checked Out</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="acctStatus" name="acctStatus">
                                        <option value="ALL">Display All Account Status</option>
                                        <option <?php if(@$acctStatus == "ACTIVATED"){ echo('selected'); } ?> value="ACTIVATED">Activated</option>
                                        <option <?php if(@$acctStatus == "DEACTIVATED"){ echo('selected'); } ?> value="DEACTIVATED">Deactivated</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="orderBy" name="orderBy">
                                        <option value="DESC" <?php if(@$orderBy == "DESC"){ echo('selected'); } ?>>Oldest first</option>
                                        <option value="ASC" <?php if(@$orderBy == "ASC"){ echo('selected'); } ?>>Newest first</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input value="{{@$keyword}}" type="text" class="form-control" name="keyword" id="keyword" placeholder="Search by name or username">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" id="INIT_SEARCH"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($users->count() > 0)
                            <table class="table table-condensed table-hover table-responsive">
                                <thead>
                                    <th>Username</th>
                                    <th>FullName</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR'], Auth::user()->id))
                                        <th>Action</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td><a href="/{{$u->username}}">{{$u->username}}</a></td>
                                            <td><a href="/viewUserProfile/{{$u->id}}">{{$u->fullName}}</a></td>
                                            <td>{{$u->created_at}}</td>
                                            <td>{{$u->status}}</td>
                                            @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR'], Auth::user()->id))
                                                <td>
                                                    @if($u->status == 'ACTIVATED')
                                                        <a data-message="Confirm account DEACTIVATION of {{$u->fullName}}" class="btn-block a-validate  btn btn-danger btn-xs" data-href="/adminDeactivate/{{$u->id}}">DEACTIVATE</a>
                                                    @elseif($u->status == 'DEACTIVATED' || $u->status == 'SELF_DEACTIVATED' || $u->status == 'ADMIN_DEACTIVATED')
                                                        <a data-message="Confirm account ACTIVATION of {{$u->fullName}}" class="btn-block a-validate  btn btn-success btn-xs" data-href="/adminActivate/{{$u->id}}">ACTIVATE</a>
                                                    @else
                                                        <a data-message="Confirm account DEACTIVATION of {{$u->fullName}}" class="btn-block a-validate btn btn-danger btn-xs" data-href="/adminDeactivate/{{$u->id}}">DEACTIVATE</a>
                                                        <a data-message="Confirm account ACTIVATION of {{$u->fullName}}" class="btn-block a-validate  btn btn-success btn-xs" data-href="/adminActivate/{{$u->id}}">ACTIVATE</a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <center>No data available</center>
                        @endif
                    </div>
                    <div class="panel-footer">
                        @if($users)
                            <center>{{$users->links()}}</center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @stop
@stop