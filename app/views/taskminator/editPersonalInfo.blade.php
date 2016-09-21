@extends('layouts.usermain')

@section('title')
    Edit Personal Information
@stop

@section('head-content')
{{ HTML::script('frontend/datepicker/bootstrap-datepicker.min.js') }}

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

    .datepicker {
        font-family: Lato;
    }
</style>
@stop

@section('body-scripts')
        {{ HTML::script('js/taskminator.js') }}
        <script>
            $(document).ready(function(){
                var citydropdown = $('#city-task');
                var ALLCTY = citydropdown.children('option');

                CHAINLOCATION($('#reg-task'), $('#edt_prov'));
                CHAINLOCATION($('#reg-task'), $('#city-task'));
                CHAINLOCATION($('#city-task'), $('#barangay-task'));
                CHAINLOCATION($('#edt_prov'), $('#city-task'));
//                locationChain($('#city-task'), $('#barangay-task'),$('#editPersonalInfo'), '/chainCity');
//                $('#reg-task').change(function(){
//                    citydropdown.prop('disabled', true);
//                    $('#barangay-task').prop('disabled', true);
//                    var regcode = 'city-value-'+$(this).val();
//                    var options = $('.'+regcode);
//                    citydropdown.val(options.eq(0).val());
//                    citydropdown.children('option').hide()
//                    options.show();
//                    citydropdown.prop('disabled', false);
//                });
                var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'mm/dd/yyyy',
                    container: container,
                    todayHighlight: true,
                    autoclose: true
                };
                date_input.datepicker(options);
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

            @if(Session::has('errorMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        {{ @Session::get('errorMsg') }}
                    </div>
                </div>
            @endif
            @if(Session::has('successMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ @Session::get('successMsg') }}
                    </div>
                </div>
            @endif

            <div class="col-md-8">
                <div class="widget-container" style="min-height: 150px; padding-bottom: 5px; padding-top: 20px;">
                    <div class="widget-content padded">
                        <form method="POST" action="/doEditPersonalInfo" id="editPersonalInfo">
                            <div class="col-md-3">
                                First Name : 
                            </div>
                            <div class="col-md-9">
                                <input type="text"  class="form-control"value="{{ $user->firstName }}" name="firstName" required="required"/><br/>
                            </div>
                            <div class="col-md-3">
                                Middle Name : 
                            </div>
                            <div class="col-md-9">
                                <input type="text"  class="form-control"value="{{ $user->midName }}" name="midName"/><br/>
                            </div>
                            <div class="col-md-3">
                                Last Name : 
                            </div>
                            <div class="col-md-9">
                                <input type="text"  class="form-control"value="{{ $user->lastName }}" name="lastName" required="required"/><br/>
                            </div>
                            <div class="col-md-3">
                                Birth Date :
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" value="{{date('m/d/Y', strtotime($user->birthdate))}}" id="date" name="date" placeholder="MM/DD/YYY" type="text"/><br/>
                            </div>
                            <div class="col-md-3">
                                Street :
                            </div>
                            <div class="col-md-9">
                                <input type="text"  class="form-control" value="{{ $user->address }}" name="address"/><br/>
                            </div>
                            <div class="col-md-3">
                                Region :
                            </div>
                            <div class="col-md-9">
                                <select name="reg-task" id="reg-task" data-loctype="REGION_TO_PROVINCE" class="form-control">
                                    <option value="">Please Select your region</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->regcode}}" <?php if($region->regcode == $user->region){ echo('selected'); } ?> >{{ $region->regname }}</option>
                                    @endforeach
                                </select><br/>
                            </div>

                            <div class="col-md-3">
                                Province :
                            </div>
                            <div class="col-md-9">
                                <select name="edt_prov" id="edt_prov" data-loctype="REGION_TO_PROVINCE" class="form-control" data-loctypeother="PROVINCE_TO_CITY">
                                    <option value="">Please Select your province</option>
                                    @foreach($prov as $p)
                                        <option <?php if($p->provcode == Auth::user()->province){echo 'selected';} ?> value="{{$p->provcode}}">{{$p->provname}}</option>
                                    @endforeach
                                </select><br/>
                            </div>

                            <div class="col-md-3">
                                City : 
                            </div>
                            <div class="col-md-9">
                                <select name="city-task" data-loctype="REGION_TO_CITY" id="city-task" class="form-control">
                                    @foreach($cities as $city)
                                        <option <?php if($city->citycode == Auth::user()->city){echo 'selected';} ?> class="city-value-{{$city->regcode}}" data-regcode="{{$city->regcode}}" value="{{$city->citycode}}" <?php if($city->citycode == $user->city){ echo('selected'); } ?> >{{ $city->cityname }}</option>
                                    @endforeach
                                </select><br/>
                            </div>
                            <div class="col-md-3">
                                Barangay : 
                            </div>
                            <div class="col-md-9">
                                <select data-loctype="CITY_TO_BARANGAY" name="barangay-task" id="barangay-task" class="form-control">
                                    @foreach($barangays as $bgy)
                                        <option value="{{$bgy->bgycode}}" <?php if($bgy->bgycode == $user->barangay){ echo('selected'); } ?> >{{ $bgy->bgyname }}</option>
                                    @endforeach
                                </select><br/>
                            </div>
                            <div class="col-md-3">
                                Gender : 
                            </div>
                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value="">Please Select your gender</option>
                                    <option value="FEMALE" <?php if($user->gender == 'FEMALE'){ echo('selected'); } ?>>Female</option>
                                    <option value="MALE" <?php if($user->gender == 'MALE'){ echo('selected'); } ?>>Male</option>
                                </select><br/>
                            </div>
                            <div class="col-md-3">
                                Civil Status :
                            </div>
                            <div class="col-md-9">
                                <select name="marital_status" class="form-control">
                                    <option value="">Please Select your Civil Status</option>
                                    <option <?php if($user->marital_status == 'SINGLE'){ echo 'selected'; } ?> value="SINGLE">Single</option>
                                    <option <?php if($user->marital_status == 'MARRIED'){ echo 'selected'; } ?> value="MARRIED">Married</option>
                                    <option <?php if($user->marital_status == 'WIDOWED'){ echo 'selected'; } ?> value="WIDOWED">Widowed</option>
                                </select><br/>
                            </div>
                            <br/><div class="text-right padded"><button type="submit" class="btn btn-primary">Save</button></div>
                        </form>
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
                <br>
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
            
            <!--<h1>Edit Personal Information</h1>
            <span style="color: red; font-weight: bold">{{ @Session::get('errorMsg') }}</span>
            <span style="color: green; font-weight: bold">{{ @Session::get('successMsg') }}</span>
            <form method="POST" action="/doEditPersonalInfo" id="editPersonalInfo">
                First Name : <input type="text" value="{{ $user->firstName }}" name="firstName" required="required"/><br/>
                Middle Name : <input type="text" value="{{ $user->midName }}" name="midName" required="required"/><br/>
                Last Name : <input type="text" value="{{ $user->lastName }}" name="lastName" required="required"/><br/>
                Address : <input type="text" value="{{ $user->address }}" name="address" required="required"/><br/>
                City : <select name="city-task" id="city-task">
                    @foreach($cities as $city)
                        <option value="{{$city->citycode}}" <?php if($city->citycode == $user->city){ echo('selected'); } ?> >{{ $city->cityname }}</option>
                    @endforeach
                </select><br/>
                Barangay : <select name="barangay-task" id="barangay-task">
                    @foreach($barangays as $bgy)
                    <option value="{{$bgy->bgycode}}" <?php if($bgy->bgycode == $user->barangay){ echo('selected'); } ?> >{{ $bgy->bgyname }}</option>
                    @endforeach
                </select><br/>
                Gender : <select name="gender">
                    <option value="FEMALE" <?php if($user->gender == 'FEMALE'){ echo('selected'); } ?>>Female</option>
                    <option value="MALE" <?php if($user->gender == 'MALE'){ echo('selected'); } ?>>Male</option>
                </select><br/>
                <button type="submit">Edit</button>
            </form>-->
    </div>
</section>
@stop