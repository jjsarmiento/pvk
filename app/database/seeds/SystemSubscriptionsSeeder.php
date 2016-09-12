<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 8/3/2016
 * Time: 8:10 AM
 */

class SystemSubscriptionsSeeder extends Seeder {
    public function run(){
        // FREE SUBSCRIPTION
        SystemSubscription::create([
            'subscription_code'     => 'FREE',
            'subscription_label'    => 'Free',
            'subscription_duration' => '30',
            'subscription_price'    => 0,
            'worker_browse'         => true,
            'worker_bookmark_limit' => '5',
            'invite_limit'          => '2',
            'job_ad_limit_week'     => '10',
            'job_ad_limit_month'    => '40',
            'featured_job_ads'      => '0',
            'sms_notif'             => false,
            'free_resume'           => 0,
            'bulk_invite'           => 1,
        ]);

        // BASIC SUBSCRIPTION
        SystemSubscription::create([
            'subscription_code'     => 'BASIC',
            'subscription_label'    => 'Basic',
            'subscription_duration' => '30',
            'subscription_price'    => 2499.00,
            'worker_browse'         => true,
            'worker_bookmark_limit' => '100',
            'invite_limit'          => '50',
            'job_ad_limit_week'     => '10',
            'job_ad_limit_month'    => '40',
            'featured_job_ads'      => '3',
            'sms_notif'             => true,
            'free_resume'           => 0,
            'bulk_invite'           => 1,
        ]);

        // PREMIUM SUBSCRIPTION
        SystemSubscription::create([
            'subscription_code'     => 'PREMIUM',
            'subscription_label'    => 'Premium',
            'subscription_duration' => '30',
            'subscription_price'    => 4999.00,
            'worker_browse'         => true,
            'worker_bookmark_limit' => '200',
            'invite_limit'          => '75',
            'job_ad_limit_week'     => '10',
            'job_ad_limit_month'    => '40',
            'featured_job_ads'      => '5',
            'sms_notif'             => true,
            'free_resume'           => 0,
            'bulk_invite'           => 1,
        ]);
    }
}