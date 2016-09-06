@extends('layouts.usermain')

@section('title')
    {{ $users->companyName }} | Profile Page
@stop
<style type="text/css">
    .col-md-12{
        display: table;
        margin: auto;
        text-align: center;
    }
    span {
        font-size: 16px;
    }
    button.btn.btn-default.btn-trans {
        padding: 9px;
    }
    @media (max-width: 320px) {
        span.mob {
            font-size: 27px;
        }
    }
    @media (max-width: 767px) {
        .header-content-inner.wow.fadeIn.text-center {
            margin-top: 50px;
        }        
    }
</style>
@section('content')
    <!-- HEADER SEARCH SECTION -->
    <header style="min-height:70%;">
        <div class="vegas.overlay" style="width:100%; height:100%; background-color:rgba(0,0,0,.7);">
            <div class="header-content">
                <div class="header-content-inner wow fadeIn text-center" data-wow-delay="0s" > <!--style="background-color:rgba(0,0,0,.5); padding-top: 35px; padding-bottom:15px; border-radius: 8px;" -->
                    @if($users->profilePic)
                        <img class="userProfile" src="{{$users->profilePic}}" />
                    @else
                        <img class="userProfile" src="/images/default_profile_pic.png" />
                    @endif

                    <h2 class="lato-text">
                        {{ $users->companyName }}
                    </h2>
                    <p style="margin:auto;" class="btn btn-primary lato-text">
                        {{ $users->businessNature }}
                    </p>
                </div>
            </div>
        </div>
    </header>
    <!-- END OF -->

    <section id="next" style="border-bottom:1px solid #222; padding-top:40px;">
        <div class="container lato-text">
            <div class="row">
                <div class="col-md-6"> 
                    <i class="fa fa-3x fa-info-circle text-primary">
                    <span class="section-heading lato-text" style="font-size: 30px; color:#333;">General Info</span></i>
                    <hr class="hrLine">                    
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar accumsan arcu, a interdum eros sollicitudin porta. Nulla facilisi. Nunc feugiat venenatis nulla, non fringilla ante. Pellentesque vestibulum turpis at posuere pellentesque. Donec leo risus, dignissim at nisi at, congue dignissim dolor. Nullam ac feugiat massa. Nunc vel justo sem. Ut vestibulum congue est sit amet malesuada. Maecenas leo dui, bibendum vitae leo eget, tempor elementum ante.
                    </p>    
                    <p>
                        Cras nisl arcu, mollis id nisi et, facilisis viverra augue. Mauris ullamcorper enim quis sapien tristique, ornare dictum diam faucibus. Vivamus pharetra sit amet metus sit amet consectetur. Donec dictum eros vel augue lobortis lobortis. In interdum nisi turpis, non rhoncus lacus semper sit amet. Donec rutrum dolor libero, at commodo erat placerat nec. Proin cursus vulputate nibh et laoreet. Mauris ultrices nulla at velit euismod, ut dapibus purus aliquam.
                    </p>     
                    </hr>

                    <span><b>Business Address: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pulvinar accumsan arcu, a interdum eros sollicitudin porta. Nulla facilisi. Nunc feugiat venenatis nulla, non fringilla ante</span><br><br>
                </div>
                <div stlye="clear:both;"></div>
                <div class="col-md-6">
                    <i class="fa fa-3x fa-briefcase text-primary">
                    <span class="section-heading lato-text mob" style="font-size: 30px; color:#333;">Company Snapshots</span></i>
                    {{--<hr class="hrLine">--}}
                    <div class="col-12-lg lato-text" style="padding-top: 20px;">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td width="50%"><label>Years in operation</label></td>
                                    <td>{{$users->years_in_operation}}</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>Number of branches</label></td>
                                    <td>{{$users->number_of_branches}}</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>Number of Employees</label></td>
                                    <td>39</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>Working Hours</label></td>
                                    <td>{{$users->working_hours}}</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>DOLE License</label></td>
                                    <td>
                                        @if($license)
                                            <i style="font-size: 1.3em; color: #2ECC71;" class="fa fa-check-circle"></i>
                                        @else
                                            <i style="font-size: 1.3em; color: #E74C3C;" class="fa fa-close"></i>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- DESCRIPTION -->
<!--     <section id="next" style="border-bottom:1px solid #222; padding-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center lato-text" style="word-wrap: break-word;">
                    <i class="fa fa-4x fa-info-circle text-primary" aria-hidden="true"></i>
                    <h2 class="section-heading">About Us</h2>
                    <hr class="hrLine">
                    <p style="font-size: 14pt;">
                        {{ $users->businessDescription}}
                    </p>
                </div>

                <div class="col-lg-4 text-center lato-text">
                    <i class="fa fa-4x fa-leaf text-primary"></i>
                    <h2 class="section-heading">Nature</h2>
                    <hr class="hrLine">
                    <p style="font-size: 14pt;">
                        {{ $users->businessNature}}
                    </p>
                </div>

                <div class="col-lg-4 text-center lato-text">
                    <i class="fa fa-4x fa-map-marker text-primary"></i>
                    <h2 class="section-heading">Business Address</h2>
                    <hr class="hrLine">
                    <p style="font-size: 14pt;">
                        {{$users->regname}}, {{$users->provname}}
                        
                        {{$users->address}}<br/>
                        {{$users->regname}}<br/>
                        {{$users->cityname}}, {{$users->bgyname}}
                        
                    </p>
                </div>

                <br/><br/><br/><br/>
                <div class="col-lg-6 text-center">
                    <i class="fa fa-4x fa-briefcase text-primary" aria-hidden="true"></i>
                    <h2 class="section-heading">Company Snapshots</h2>
                    {{--<hr class="hrLine">--}}
                    <div class="col-12-lg lato-text">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td width="50%"><label>Years in operation</label></td>
                                    <td>{{$users->years_in_operation}}</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>Number of branches</label></td>
                                    <td>{{$users->number_of_branches}}</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>Working Hours</label></td>
                                    <td>{{$users->working_hours}}</td>
                                </tr>
                                <tr>
                                    <td width="50%"><label>DOLE Lisence</label></td>
                                    <td>
                                        @if($license)
                                            <i style="font-size: 1.3em; color: #2ECC71;" class="fa fa-check-circle"></i>
                                        @else
                                            <i style="font-size: 1.3em; color: #E74C3C;" class="fa fa-close"></i>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<!-- All scripts and plugin should be placed here so the page can load -->

@stop

@section('body-scripts')
<!-- FOR HEADER SLIDER -->
    <script>
        $('header').vegas({
          overlay: true,
          preload: true,
          preloadImage: true,
          transition: 'fade', 
          transitionDuration: 4000,
          delay: 10000,
          animation: 'random',
          shuffle: true,
          timer:false,
          animationDuration: 20000,
          slides: [
            { src: 'frontend/img/slideshow/10.jpg' }
            //{ src: 'frontend/img/slideshow/03.jpg' },
            //{ src: 'frontend/img/slideshow/05.jpg' },
            //{ src: 'frontend/img/slideshow/07.jpg' },
            //{ src: 'frontend/img/slideshow/02.jpg' },
            //{ src: 'frontend/img/slideshow/04.jpg' },
            //{ src: 'frontend/img/slideshow/06.jpg' }
          ]
        });
    </script>
    {{ HTML::script('frontend/js/creative.js') }}
<!-- END OF HEADER SLIDER -->
@stop