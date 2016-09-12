<html>
    <head>
        <title>Proveek Beta - Pricing Package</title>
        {{ HTML::style('frontend/css/bootstrap.min.css') }}
        {{ HTML::style('frontend/css/custom.css') }}
        {{ HTML::script('frontend/js/jquery.js') }}
        {{ HTML::script('frontend/js/bootstrap.min.js') }}
        {{ HTML::style('frontend/font-awesome/css/font-awesome.min.css') }}
        <style>
            body {
                background-color: #E9EAED;
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            }
        </style>
        <script>
            $(document).ready(function(){
            });
        </script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-top: 3em;">
                <i class="fa fa-home"></i> Click <a href="/">here</a> to go home<br/><br/>
                <div class="widget-container fluid-height padded">
                    <div class="widget-content">
                        <table class="table table-striped" style="font-size: 0.9em;">
                            <thead>
                                <tr>
                                    <th>Packages</th>
                                    <th>Browse Workers</th>
                                    <th>Notification via SMS</th>
                                    <th>Bookmark Workers</th>
                                    <th>Job Ad Invitations</th>
                                    <th>Posting Job Ads</th>
                                    <th>Featured Job Ads</th>
                                    <th>Free resumes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subs as $s)
                                    <tr>
                                        <td><b>{{$s->subscription_label}}<br/>(P{{$s->subscription_price}} monthly)</b></td>
                                        <td class="text-center">{{($s->worker_browse) ? '<i style="font-size: 1.5em; color : #2ECC71;" class="fa fa-check-circle"></i>' : '<i style="font-size: 1.5em; color : #E74C3C;" class="fa fa-close"></i>'}}</td>
                                        <td class="text-center">{{($s->sms_notif) ? '<i style="font-size: 1.5em; color : #2ECC71;" class="fa fa-check-circle"></i>' : '<i style="font-size: 1.5em; color : #E74C3C;" class="fa fa-close"></i>'}}</td>
                                        <td>{{$s->worker_bookmark_limit}} weekly</td>
                                        <td>{{$s->invite_limit}} weekly</td>
                                        <td>
                                            {{$s->job_ad_limit_week}} weekly<br/>
                                            {{$s->job_ad_limit_month}} monthly
                                        </td>
                                        <td>{{$s->featured_job_ads}}</td>
                                        <td>{{$s->free_resume}} profiles</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-center">
                                <b>Tell us what you need and we’ll choose the people for you!</b><br/>
                                (We’ll provide pre-screened, pre-interviewed and background checked
                                profiles to you and you’ll just pay for what you hire)
                                <br/><br/>
                                Get Quotation Now at <b style="color: #3498DB;">service.proveek@gmail.com</b>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h3 style="margin-top: 0;"><i class="fa fa-info-circle" style="color: #F39C12;"></i> How to avail Proveek Packages</h3>
                                <ol>
                                    <li>Transfer amount to BPI Account under <b style="color: #3498DB">MARC BRIONES - Acct # 0919282118</b></li>
                                    <li>Send a screenshot / photo of official receipt or confirmation to <b style="color: #3498DB">service.proveek@gmail.com</b></li>
                                    <li>Wait for confirmation of purchase</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <center><i class="fa fa-copyright"></i> Proveek Beta - 2016</center>
                </div>
            </div>
        </div>
    </body>
</html>