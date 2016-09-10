<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 7/20/2016
 * Time: 1:14 PM
 */
class SystemSettingsSeeder extends Seeder {

    public function run(){

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_POINTSPERAD",
            'value'         =>  "5"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_REPOST_POINTSPERAD",
            'value'         =>  "2.5"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_JOBADDURATION",
            'value'         =>  "168"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_CHECKOUTPRICE",
            'value'         =>  "10"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_FREE_SUB_ON_REG",
            'value'         =>  "1"
        ));

        SystemSetting::create(array(
            'type'          =>  "SYSSETTINGS_FDBACK_INIT",
            'value'         =>  "14"
        ));
    }
}