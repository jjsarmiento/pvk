@extends('layouts.usermain')

@section('title')
    Edit Personal Information
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
    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/taskminator.js') }}
    <script>
        $(document).ready(function(){
            var citydropdown = $('#city');
            var ALLCTY = citydropdown.children('option');

            CHAINLOCATION($('#reg-task'), $('#edt_prov'));
            CHAINLOCATION($('#reg-task'), $('#city'));
            CHAINLOCATION($('#city'), $('#barangay'));
            CHAINLOCATION($('#edt_prov'), $('#city'));

            /*
            locationChain($('#city'), $('#barangay'),$('#editPersonalInfo'), '/chainCity');
            $('#reg-task').change(function(){
                citydropdown.prop('disabled', true);
                $('#barangay').prop('disabled', true);
                var regcode = 'city-value-'+$(this).val();
                var options = $('.'+regcode);
                citydropdown.val(options.eq(0).val());
                citydropdown.children('option').hide()
                options.show();
                citydropdown.prop('disabled', false);
            });
//            locationChain($('#city'), $('#barangay'),$('#editPersonalInfo'), '/chainCity');
            */
        });
    </script>
@stop

@section('body-scripts')
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
    <section class="lato-text">
        <div class="container">
            <div class="page-title">
                <h1 class="lato-text">
                    Edit Company Information
                </h1>
            </div>
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                        </li>
                        <li>
                            <a href="/editProfile">Edit Profile</a>
                        </li>
                        <li class="active">
                            Edit Company Information
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

                <form method="POST" action="{{$formUrl}}" id="editPersonalInfo">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="widget-container">
                                <div class="widget-content padded">
                                    <h4 style="margin: 0; padding: 0; border-bottom: 1px solid #ECF0F1; padding-bottom: 0.6em; margin-bottom: 0.6em;"><i class="fa fa-briefcase"></i> Company Details</h4>
                                    @if(UserHasRole::where('user_id', Auth::user()->id)->pluck('role_id') == 4)
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" value="{{ $user->companyName }}" name="companyName" required="required"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nature of Business</label>
                                            <input type="text" class="form-control" value="{{ $user->businessNature }}" name="businessNature"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Business Permit</label>
                                            <input class="form-control" type="text" value="{{ $user->businessPermit }}" name="businessPermit"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Business Description</label>
                                            <textarea class="form-control" rows="5" name="businessDescription" >{{ $user->businessDescription }}</textarea>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" type="text" value="{{ $user->firstName }}" name="firstName" required="required"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control" type="text" value="{{ $user->midName }}" name="midName"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" type="text" value="{{ $user->lastName }}" name="lastName" required="required"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                               <option value="FEMALE" <?php if($user->gender == 'FEMALE'){ echo('selected'); } ?>>Female</option>
                                               <option value="MALE" <?php if($user->gender == 'MALE'){ echo('selected'); } ?>>Male</option>
                                           </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget-container">
                                <div class="widget-content padded">
                                    <h4 style="margin: 0; padding: 0; border-bottom: 1px solid #ECF0F1; padding-bottom: 0.6em; margin-bottom: 0.6em;"><i class="fa fa-plus"></i> Additional Information</h4>
                                    <div class="form-group">
                                        <label>Years in Operation</label>
                                        <input value="{{Auth::user()->years_in_operation}}" type="text" class="form-control" name="YIO" id="YIO"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Branches</label>
                                        <input value="{{Auth::user()->number_of_branches}}" type="text" class="form-control" name="NOB" id="NOB"/>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Contact Person Position</label>
                                        <input value="{{Auth::user()->contact_person_position}}" type="text" class="form-control" name="CPP" id="CPP"/>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Number of employees</label>
                                        <input value="{{Auth::user()->number_of_employees}}" type="text" class="form-control" name="NOE" id="NOE"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Working Hours</label>
                                        <input value="{{Auth::user()->working_hours}}" type="text" class="form-control" name="WH" id="WH"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget-container">
                                <div class="widget-content padded">
                                    <h4 style="margin: 0; padding: 0; border-bottom: 1px solid #ECF0F1; padding-bottom: 0.6em; margin-bottom: 0.6em;"><i class="fa fa-map-marker"></i> Location Details</h4>
                                    <div class="form-group">
                                        <label>Street</label>
                                       <input class="form-control" type="text" value="{{ $user->address }}" name="address"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select name="reg-task" id="reg-task" class="form-control" data-loctype="REGION_TO_PROVINCE">
                                            <option value="">Select a region</option>
                                            @foreach($regions as $region)
                                                <option value="{{$region->regcode}}" <?php if($region->regcode == $user->region){ echo('selected'); } ?> >{{ $region->regname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Province</label>
                                        <select name="edt_prov" id="edt_prov" data-loctype="REGION_TO_PROVINCE" data-loctypeother="PROVINCE_TO_CITY" class="form-control">
                                            <option value="">Select a province</option>
                                            @foreach($prov as $p)
                                                <option <?php if($p->provcode == Auth::user()->province){echo 'selected';} ?> value="{{$p->provcode}}">{{$p->provname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>City/Municipality    </label>
                                       <select name="city-comp" id="city" data-loctype="REGION_TO_CITY" class="form-control">
                                            <option value="">Select a city</option>
                                           @foreach($cities as $city)
                                              <option class="city-value-{{$city->regcode}}" value="{{$city->citycode}}" <?php if($city->citycode == $user->city){ echo('selected'); } ?> >{{ $city->cityname }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Barangay</label>
                                       <select class="form-control" data-loctype="CITY_TO_BARANGAY" name="barangay-comp" id="barangay">
                                        <option value="">Select a barangay</option>
                                          @foreach($barangays as $bgy)
                                          <option value="{{$bgy->bgycode}}" <?php if($bgy->bgycode == $user->barangay){ echo('selected'); } ?> >{{ $bgy->bgyname }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="job-post">
                                <div class="col-lg-12 no-padding">
                                    <div class="widget-container" style="min-height:30px;">
                                        <div class="panel-body">
                                            <h4 style="margin: 0;padding: 0;border-bottom: 1px solid #ECF0F1;padding-bottom: 0.6em;margin-bottom: 0.6em;"><i class="fa fa-edit" aria-hidden="true"></i> Profile Progress</h4>
                                        </div>
                                        <div class="panel-body" style="padding-top: 0px; margin-top: -5px;">
                                            @foreach($prog as $r)
                                                <a href="{{$r['url']}}">{{$r['content']}}</a><br/>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success pull-left" style="border-radius: 0.3em;" type="submit">Save Profile Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--
       <form method="POST" action="{{$formUrl}}" id="editPersonalInfo">
           Address : <input type="text" value="{{ $user->address }}" name="address" required="required"/><br/>
           City : <select name="city-comp" id="city">
               @foreach($cities as $city)
               <option value="{{$city->citycode}}" <?php if($city->citycode == $user->city){ echo('selected'); } ?> >{{ $city->cityname }}</option>
               @endforeach
           </select><br/>
           Barangay : <select name="barangay-comp" id="barangay">
               @foreach($barangays as $bgy)
               <option value="{{$bgy->bgycode}}" <?php if($bgy->bgycode == $user->barangay){ echo('selected'); } ?> >{{ $bgy->bgyname }}</option>
               @endforeach
           </select><br/>
           <button type="submit">Edit</button>
       </form>
    -->
@stop

