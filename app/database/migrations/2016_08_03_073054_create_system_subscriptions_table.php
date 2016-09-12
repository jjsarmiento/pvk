<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_subscriptions', function(Blueprint $table)
		{
			$table->increments('id');
            // subscription details
            $table->string('subscription_code')->unique();        // type of subscription
            $table->string('subscription_label');        // type of subscription
            $table->string('subscription_duration')->nullable();    // duration of subscription
            $table->float('subscription_price')->nullable();       // price of subscription
            // info
			$table->boolean('worker_browse')->nullable();        // BROWSE RESUME
			$table->string('worker_bookmark_limit')->nullable();      // CAN BOOKMARK RESUMES
			$table->string('invite_limit')->nullable();         // CAN NOTIFY # OF WORKERS
			$table->string('job_ad_limit_week')->nullable();         // POST JOB ADS
			$table->string('job_ad_limit_month')->nullable();         // POST JOB ADS
			$table->string('featured_job_ads')->nullable();         // featured JOB ADS
			$table->boolean('sms_notif')->nullable();         // POST JOB ADS
			$table->integer('free_resume')->nullable();         // FREE PROFILES OF WORKERS (QUANTITY)
			$table->boolean('bulk_invite')->nullable();         // BULK INVITATION
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_subscriptions');
	}

}
