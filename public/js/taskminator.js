/**
 * Created by Jan on 4/24/15.
 */

function registrationPage(){
    $('.client-btn').click(function(){
        $('.account-type-btns').hide();
        $('.client-type-btns').fadeIn('fast');
    });

    $('.taskminator-btn').click(function(){
        $('.account-type-btns').hide();
        $('.taskminator-form').fadeIn('fast');
    });

    $('.indi-btn').click(function(){
        $('.client-type-btns').hide();
        $('.client-form-indi').fadeIn('fast');
    });

    $('.comp-btn').click(function(){
        $('.client-type-btns').hide();
        $('.client-form-comp').fadeIn('fast');
    });
}

function locationChain(dropdown, chainee, form, route){
    dropdown.change(function(){
        chainee.prop('disabled', true);
        $.ajax({
            type    :   'GET',
            url     :   route,
            data    :   form.serialize(),
            success :   function(data){
                chainee.empty();
                if(chainee.attr('name') == 'city' || chainee.attr('name') == 'city-comp' || chainee.attr('name') == 'city-task'){
                    $('#barangay').empty();
                    $('#barangay-comp').empty();
                    $.each(data, function(key,value){
                        chainee.append('<option data-citycode="'+value['citycode']+'" value="'+value['citycode']+'">'+value['cityname']+'</option>');
                    });
                }else if(chainee.attr('name') == 'barangay' || chainee.attr('name') == 'barangay-comp' || chainee.attr('name') == 'barangay-task'){
                    $.each(data, function(key,value){
                        chainee.append('<option data-citycode="'+value['bgycode']+'" value="'+value['bgycode']+'">'+value['bgyname']+'</option>');
                    });
                }else if(chainee.attr('name') == 'province' || chainee.attr('name') == 'province-comp' || chainee.attr('name') == 'province-task'){
                    $.each(data, function(key,value){
                        chainee.append('<option data-citycode="'+value['provcode']+'" value="'+value['provcode']+'">'+value['provname']+'</option>');
                    });
                }
                chainee.prop('disabled', false);
            },error :   function(){
                console.log('Please check network connectivity. - TASKMINATOR.JS');
                chainee.prop('disabled', false);
            }
        });
    });
}

function CHAINLOCATION(SENDER, RECEIVER){
    SENDER.change(function(){
        SENDER.prop('disabled', true);
        RECEIVER.prop('disabled', true).empty();

        var ROUTE = '/LOCCHAIN:'+SENDER.data('loctype')+':'+SENDER.val();

        $.ajax({
            type    :   'GET',
            url     :   ROUTE,
            success :   function(data){
                RECEIVER.append('<option value="ALL">Display all cities from region</option>');
                $.each(data, function(key,value){
                    RECEIVER.append('<option value="'+value['citycode']+'">'+value['cityname']+'</option>');
                });

                SENDER.prop('disabled', false);
                RECEIVER.val('ALL').prop('disabled', false);
            }
        });
    })
}

function CHAINCATEGORYANDSKILL(CATEGORY, SKILL){
    CATEGORY.change(function () {
        CATEGORY.prop('disabled', true);
        SKILL.prop('disabled', true).empty();

        var ROUTE = '/CHAINCATEGORYANDSKILL:'+CATEGORY.val();
        $.ajax({
            type    :   'GET',
            url     :   ROUTE,
            success :   function(data){
                SKILL.append('<option value="ALL">Display everything from category</option>');
                $.each(data, function(key,value){
                    SKILL.append('<option value="'+value['itemcode']+'">'+value['itemname']+'</option>');
                });

                CATEGORY.prop('disabled', false);
                SKILL.prop('disabled', false);
            }
        })
    })
}