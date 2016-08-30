@extends('layouts.admin.master')
    @section('head')
        <script>
            $(document).ready(function() {
                CHAINLOCATION($('#cmpSearch_Region'), $('#cmpSearch_City'));
                CHAINLOCATION($('#cmpSearch_Region'), $('#cmpSearch_Province'));
                CHAINLOCATION($('#cmpSearch_Province'), $('#cmpSearch_City'));

                $('#INIT_SEARCH').click(function() {
                    var chkout = $('#checkOut').val(),
                        acctSt = $('#acctStatus').val(),
                        orderBy = $('#orderBy').val(),
                        keyword = ($('#keyword').val() ? $('#keyword').val() : 'NONE');

                    location.href = '/subadmin/workers='+chkout+'='+acctSt+'='+orderBy+'='+keyword+'='+$('#PAGE_TITLE').text();
                });

                $('#INIT_SEARCH_MPLYRS').click(function(){
                    var searchWord = ($('#keyword').val() == '') ? false : $('#keyword').val(),
                        acctStatus = ($('#acct_status').val() == '') ? false : $('#acct_status').val(),
                        accountType = ($('#acctType').val() == '') ? false :$('#acctType').val(),
                        orderBy = $('#adminCMP_orderBy').val(),
                        searchBy = $('#adminCMP_SrchBy').val(),
                        region = ($('#cmpSearch_Region').val() == 'ALL') ? false : $('#cmpSearch_Region').val(),
                        city = ($('#cmpSearch_City').val() == 'ALL') ? false : $('#cmpSearch_City').val(),
                        province = ($('#cmpSearch_Province').val() == 'ALL') ? false : $('#cmpSearch_Province').val();

                    location.href = '/subadmin/employers='+searchWord+'='+acctStatus+'='+accountType+'='+orderBy+'='+searchBy+'='+region+'='+city+'='+province+'='+$('#PAGE_TITLE').text();
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
                                        <option <?php if(@$checkout == '1'){ echo 'selected'; } ?> value="1">Checked Out</option>
                                        <option <?php if(@$checkout == '0'){ echo 'selected'; } ?> value="0">Not Checked Out</option>
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
                            @elseif($title == 'Employers - User Accounts List')
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" name="cmpSearch_Region" id="cmpSearch_Region">
                                                <option value="ALL">All regions</option>
                                                @foreach($regions as $r)
                                                    <option <?php if(@$cmpSearch_Region == $r->regcode){ echo 'selected'; } ?> value="{{$r->regcode}}">{{$r->regname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="cmpSearch_Province" id="cmpSearch_Province" data-loctype="REGION_TO_PROVINCE" data-loctypeother="PROVINCE_TO_CITY">
                                                <option value="ALL">All provinces</option>
                                                @foreach($provinces as $p)
                                                    <option <?php if(@$cmpSearch_Province == $p->provcode){ echo 'selected'; } ?> value="{{$p->provcode}}">{{$p->provname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" name="cmpSearch_City" id="cmpSearch_City" data-loctype="REGION_TO_CITY">
                                                <option value="ALL">All cities</option>
                                                @foreach($cities as $c)
                                                    <option <?php if(@$cmpSearch_City == $c->citycode){ echo 'selected'; } ?> value="{{$c->citycode}}">{{$c->cityname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="acct_status" id="acct_status">
                                                <option value="">All Account Status</option>
                                                <option <?php if(@$acct_status == 'DEACTIVATED'){echo 'selected';} ?> value="DEACTIVATED">Deactivated</option>
                                                <option <?php if(@$acct_status == 'ACTIVATED'){echo 'selected';} ?> value="ACTIVATED">Activated</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" name="acctType" id="acctType">
                                                <option value="">All Account Type</option>
                                                @foreach($subs as $s)
                                                    <option <?php if(@$adminCMP_accountType == $s->subscription_code){echo 'selected';} ?> value="{{$s->subscription_code}}">{{$s->subscription_label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="adminCMP_orderBy" id="adminCMP_orderBy">
                                                <option <?php if(@$orderBy == 'ASC'){echo 'selected';} ?>  value="ASC">Oldest to Newest</option>
                                                <option <?php if(@$orderBy == 'DESC'){echo 'selected';} ?> value="DESC">Newest to Oldest</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input value="{{@$keyword}}" type="text" class="form-control" name="keyword" id="keyword" placeholder="Search by name or username">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" id="INIT_SEARCH_MPLYRS"><i class="glyphicon glyphicon-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control" name="adminCMP_SrchBy" id="adminCMP_SrchBy">
                                                <option <?php if(@$adminCMP_SrchBy == 'username'){echo 'selected';} ?> value="username">Search by Username</option>
                                                <option <?php if(@$adminCMP_SrchBy == 'fullName'){echo 'selected';} ?> value="fullName">Search by Name</option>
                                            </select>
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