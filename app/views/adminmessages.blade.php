@extends('layouts.usermain')

@section('title')
    Proveek | Dashboard
@stop

@section('head-content')
<style>
    body{background-color:#E9EAED;}

    .bubble {
        padding: 1em;
        border-bottom: solid 1px #ecf0f1;
    }

    .bubble-user{
        text-align: right;
        border-bottom: solid 1px #ecf0f1;
        padding: 1em;
    }

    .timestamp {
        font-size: 0.7em;
        color: #2980b9;
        font-weight: bold;
    }
</style>
<script>
    $(document).ready(function(){
        $('#ADMIN_sendMsgContent').keyup(function(){
            if($(this).val().length > 1 && $('#USERID').val() != ''){
                $('#ADMIN_sendMsgBtn').attr('disabled', false);
            }else{
                $('#ADMIN_sendMsgBtn').attr('disabled', true);
            }
        });

        $('#ADMIN_sendMsgBtn').click(function(){
            $('#ADMIN_sendMsgContent').attr('readonly', true);
            $.ajax({
                type    :   'POST',
                url     :   $('#ADMINCHATFORM').attr('action'),
                data    :   $('#ADMINCHATFORM').serialize(),
                success :   function(data){
                    var msg = '<div class="bubble-user">'+data['msg']+'<br/><span class="timestamp">'+data['tstamp']+'</span></div>';
                    $('#PANELBODY').append(msg);
                    $('#PANELBODY').scrollTop($('#PANELBODY').height());
                }
            })
            $('#ADMIN_sendMsgContent').val('').attr('readonly', false);
            $('#ADMIN_sendMsgBtn').attr('disabled', true);
        });

        $('.ADMINLIST').click(function(){
            $('#PANELBODY').empty();
            $('#USERID').val($(this).data('adminid'));
            $.ajax({
                type    :   'GET',
                url     :   '/WGTCHT='+$(this).data('adminid'),
                success :   function(data){
                    if(data == 'NOCHATHISTORY'){
                        $('#PANELBODY').empty().append('<div style="padding: 0.4em; font-size: 1.5em; text-align: center; background-color: #2980b9; color: #ffffff;">SEND A MESSAGE AND START CHATTING</div>')
                    }else{
                        $('#PANELBODY').empty();
                        $.each(data, function(key, value){
                            var msg = "";
                            if(value['sender_id'] == $('#SENDERID').val()){
                                msg = '<div class="bubble-user">'+value['content']+'<br/><span class="timestamp">'+value['created_at']+'</span></div>';
                            }else{
                                msg = '<div class="bubble">'+value['content']+'<br/><span class="timestamp">'+value['created_at']+'</span></div>';
                            }
                            $('#PANELBODY').append(msg).scrollTop($('#PANELBODY').height());
                        });
//                            GETMSG(userid, $('#SENDERID').val());
                    }
                }
            });
            $('#PANELBODY').scrollTop($('#PANELBODY').height());
            GETMSG($('#USERID').val());
        });

        function GETMSG(userid){
            setInterval(function(){
                $.ajax({
                    type    :   'GET',
                    url     :   '/WGTMSG='+userid,
                    success :   function(data){
                        if(data){
                            $.each(data, function(key, value){
                                var msg = '<div class="bubble">'+value['content']+'<br/><span class="timestamp">'+value['created_at']+'</span></div>';
                                $('#PANELBODY').append(msg).scrollTop($('#PANELBODY').height());
                            });
                        }
                    }
                })
            }, 5000);
        }
    })
</script>
@stop


@section('content')
<section>
    <input type="hidden" id="CHAT_ACTIVE" value="false" />
    <div class="container main-content lato-text">
        <div class="col-lg-3">
            @foreach($admins as $admin)
                <div class="ADMINLIST" data-adminid="{{$admin->id}}" style="background-color: #ffffff; cursor: pointer; border-bottom: 1px solid #ecf0f1; padding: 0.8em;">
                    Admin {{ $admin->firstName }}
                </div>
            @endforeach
        </div>
        <div class="col-lg-9">
            <div class="panel-header"><span id="PANELHEAD" style="font-size: 1.4em;"></span></div>
            <div class="panel-body" id="PANELBODY" style="word-wrap: break-word; height: 32em; overflow-y: auto; padding: 0; background-color: #ffffff;">
                <div class="col-md-12 padded" style="background-color: #2980B9; color: #ffffff; text-align: center">PLEASE SELECT AN ADMIN TO CHAT WITH</div>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <form method="POST" action="/SENDMSGTOADMIN" id="ADMINCHATFORM">
                        <input type="text" class="form-control" name="ADMIN_sendMsgContent" id="ADMIN_sendMsgContent" placeholder="ENTER YOUR MESSAGE"/>
                        <input type="text" style="display: none;"/>
                        <input type="hidden" name="USERID" value="" id="USERID" />
                        <input type="hidden" name="SENDERID" value="{{ Auth::user()->id }}" id="SENDERID" />
                    </form>
                    <span class="input-group-btn">
                        <button disabled type="button" id="ADMIN_sendMsgBtn" class="btn btn-primary"> Send </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('body-scripts')
@stop