<html>
    <head>
        <title>Invite Limit Reached!</title>
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
    </head>
    <body>
        <center>
        <div style="margin-top: 3em;">
            <img src="frontend/img/proveek-logo-300.png" class="img-responsive center-block">
            <div class="col-md-8 col-md-offset-2">
                <div class="widget-container padded">
                    <div class="widget-content">
                    <div class="row">
                        @if($sub)
                            <div class="col-md-6" style="text-align: left !important;">
                                    <table class="table table-hover table-condensed">
                                        <tbody>
                                            <tr>
                                                <td width="60%"><label>Subscription</label></td>
                                                <td>{{$sub->subscription_label}}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Invitation Limit (per week)</label></td>
                                                <td>{{$sub->invite_limit}}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Bookmark Limit (per week)</label></td>
                                                <td>{{$sub->worker_bookmark_limit}}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Job Ad Limit (per week)</label></td>
                                                <td>{{$sub->job_ad_limit_week}}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Job Ad Limit (per month)</label></td>
                                                <td>{{$sub->job_ad_limit_month}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="col-md-6">
                                <i style="color: #E74C3C;" class="fa fa-warning"></i> {{$msg}}
                                <br/>
                                Click <a href="/">here</a> to redirect to home<br/>
                                Click <a href="/TOPUP">here</a> to apply for a new subscription!
                            </div>
                        @else
                            <div class="col-md-12" style="padding-top: 3em;">
                                <i style="color: #E74C3C;" class="fa fa-warning fa-4x"></i><br/><br/>
                                You are not subscribed to any Proveek Packages<br/>
                                Click <a href="/TOPUP">here</a> to subscribe to a package
                            </div>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </center>
    </body>
</html>