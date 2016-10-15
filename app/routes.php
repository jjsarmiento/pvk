<?php

// TEMPORARY ROUTES
Route::get('/pre-release/register', 'HomeController@pre_release_register');

//Admin Messages
Route::get('/inquiry-messages', 'AdminController@INQUIRYMESSAGES');

// PLACE NON PROTECTED ROUTES HERE -- START
Route::get('/login', 'HomeController@login');
Route::post('/doLogin', 'HomeController@doLogin');
Route::get('/TOPUP', 'HomeController@TOPUP');

    Route::get('/', 'HomeController@index');
    Route::get('/more', 'HomeController@more');
    Route::get('/moreWorkers={categoryId}={skillId}={region}={city}={province}={profilePercentage}', 'HomeController@moreWorkers');
    Route::get('/moreJobs', 'HomeController@moreJobs');
    Route::get('/moreJobs:{keyword}:{region}:{city}:{category}:{skill}:{orderBy}:{workDuration}', 'HomeController@moreJobsSEARCH');

    Route::get('/PRVKUPDTJBDS', 'HomeController@UPDATE_JOBADS_GLOBAL');
    Route::get('/PRVKUPDTSBSCRPTNS={user_id}', 'HomeController@PRVKUPDTSBSCRPTNS');
// Route::get('/home', 'HomeController@home');
    Route::get('/employer','HomeController@employer');
    Route::get('/howitworks', 'HomeController@howitworks');
    Route::get('/whychooseproveek', 'HomeController@whychooseproveek');
    Route::get('/pricing', 'HomeController@pricing');
    Route::get('/faq', 'HomeController@seeFAQ');
    Route::get('/faqTag', 'HomeController@seeFAQTAG');
    Route::get('/about', 'HomeController@seeAbout');
    Route::get('/workercategory={categorycode}', 'HomeController@landingJobAd');
    Route::get('/workercategory:{title}:{duration}:{region}:{city}:{category}:{skill}:{orderBy}:{province}', 'HomeController@doJobSearchForGuest');

    Route::get('/register', 'HomeController@register');
    Route::post('/doRegisterIndi', 'HomeController@doRegisterIndi');
    Route::post('/doRegisterComp', 'HomeController@doRegisterComp');
    Route::post('/doRegisterTaskminator', 'HomeController@doRegisterTaskminator');
    Route::get('/chainRegion', 'HomeController@chainRegion');
    Route::get('/chainCity', 'HomeController@chainCity');
    Route::get('/chainProvince', 'HomeController@chainProvince');
    Route::get('/regTaskminator', 'HomeController@regTaskminator');
    Route::post('/regTaskminator', 'HomeController@regTaskminator');
    Route::get('/regClientIndi', 'HomeController@regClientIndi');
    Route::get('/regClientComp', 'HomeController@regClientComp');
    Route::post('/regClientComp', 'HomeController@regClientComp');
    Route::get('/getProfilePercentage/{id}', 'HomeController@getProfilePercentage');
    Route::get('/SLFACTVT={time}={userid}', 'HomeController@SLFACTVT');
    Route::get('/ACTVTACCT={userid}', 'HomeController@ACTVTACCT');
    Route::get('/VRFYACCT={code}', 'HomeController@VRFYACCT');
    Route::get('/RESENDVALIDATION={userid}', 'HomeController@RESENDVALIDATION');
    Route::post('/CHKRGWRKR', 'HomeController@CHKRGWRKR');
    Route::get('/CHAINREG', 'HomeController@CHAINREG');
    Route::post('/ContactUs', 'HomeController@ContactUs');

    Route::get('/LOCCHAIN:{chainType}:{locationID}', 'HomeController@LOCCHAIN');
    Route::get('/CHAINCATEGORYANDSKILL:{categoryID}', 'HomeController@CHAINCATEGORYANDSKILL');

    Route::post('/regWorker', 'HomeController@regWorker');
    Route::post('/regEmployer', 'HomeController@regEmployer');

// SEARCH ROUTE TEST
    Route::get('/searchform', 'searchTestController@index');

    Route::get('/logout', 'HomeController@logout');
    Route::get('/changePassword', 'HomeController@changePassword');
    Route::post('/forgotPassword', 'HomeController@changePassword');
    Route::post('/changePassword', 'HomeController@changePassword');
    Route::get('/activateChangePass/{confirmationCode}', 'HomeController@activateChangePass');
    Route::get('/activateResetPass/{confirmationCode}', 'HomeController@activateResetPass');
    Route::post('/confirmReset', 'HomeController@confirmReset');
    Route::post('/confirmChange', 'HomeController@confirmChange');
    Route::post('/chainCategoryItems', 'HomeController@chainCategoryItems');
// Route::get('/profile/{id}', 'HomeController@profile'); --- old profile page
    Route::get('/VERIFY_changeEmail_{userID}', 'HomeController@VERIFY_changeEmail');
    Route::post('/doVERIFY_changeEmail', 'HomeController@doVERIFY_changeEmail');



// CHIKKA SMS ROUTES -- START
    Route::post('/taskminator/receive', 'SMSAPIController@receive'); //register  http://yourserver.com/yourapp/receive  on the message receiver on API dashboard
    Route::post('/taskminator/notify', 'SMSAPIController@notify'); //http://yourserver.com/yourapp/notify for the delivery notification
// CHIKKA SMS ROUTES -- END

// PLACE NON PROTECTED ROUTES HERE -- END

Route::get('/regClient', function() {
    return View::make('reg-client');
});

Route::group(array('before' => 'auth'), function(){
    // NOTIF -- 2016 Jan Sarmiento
    Route::get('/n_{notifID}:/{destinationUrl}', 'HomeController@catchNotif');

    Route::get('/editContactPerson', 'HomeController@editContactPerson');
    Route::post('/doEditContactPerson', 'HomeController@doEditContactPerson');
    Route::get('/editProfile', 'HomeController@editProfile');
    Route::post('/uploadProfilePic', 'HomeController@uploadProfilePic');
    Route::get('/getNotification', 'HomeController@getNotification');
    Route::get('/showAllNotif', 'HomeController@showAllNotif');
    Route::get('/messages', 'HomeController@messages');
    Route::get('/getMessages/{threadcode}', 'HomeController@getMessages');
    Route::post('/sendMsg', 'HomeController@sendMsg');
    Route::get('/checkMsgs={threadcode}', 'HomeController@checkMsgs');
    Route::get('/checkMsgThread={threadcode}', 'HomeController@checkMsgThread');
    Route::get('/checkMsgCount', 'HomeController@checkMsgCount');

    Route::post('/CHNGPSS', 'HomeController@CHNGPSS');

    Route::post('/DEACACCT', 'HomeController@DEACACCT');

    // ADMIN MESSAGING FUNCTION -- START
    Route::get('/admessages', 'HomeController@adminMessages');
    Route::post('/SENDMSGTOADMIN', 'HomeController@SENDMSGTOADMIN');
    Route::get('/WGTCHT={adminId}', 'HomeController@WGTCHT');
    Route::get('/WGTMSG={userid}', 'HomeController@WGTMSG');
    // ADMIN MESSAGING FUNCTION -- END
});

Route::group(array('before' => 'ADMIN-ONLY'), function(){
    Route::get('/admin', 'AdminController@index');
    Route::group(['before' => 'SUPER_ADMINISTRATOR'], function(){

        // JOB ADS ROUTES
        Route::get('/showJobAds', 'AdminController@showJobAds');
        Route::get('/ADMINJbSrch:{keyword}:{regcode}:{citycode}:{hiringType}:{orderBy}:{category}:{skill}', 'AdminController@ADMINJbSrch');

        // MANAGE ADMIN
        Route::get('/CREATE_ADMIN', 'AdminController@CREATE_ADMIN');
        Route::post('/doCREATE_ADMIN', 'AdminController@doCREATE_ADMIN');
        Route::get('/DELETE_ADMIN:{user_id}', 'AdminController@DELETE_ADMIN');
        Route::get('/EDIT_ADMIN:{user_id}', 'AdminController@EDIT_ADMIN');
        Route::post('/doEDIT_ADMIN', 'AdminController@doEDIT_ADMIN');
        Route::get('/DEACTIVATE_ADMIN:{user_id}', 'AdminController@DEACTIVATE_ADMIN');
        Route::get('/ACTIVATE_ADMIN:{user_id}', 'AdminController@ACTIVATE_ADMIN');

        // POINTS
        Route::get('/points={user_id}', 'AdminController@points');
        Route::post('/doAddPoints', 'AdminController@doAddPoints');
        Route::post('/doSubtractPoints', 'AdminController@doSubtractPoints');

        // ADD SUBSCRIPTION TO USER
        Route::get('/addSubscription={user_id}', 'AdminController@addSubscription');
        Route::post('/doAddSubscription', 'AdminController@doAddSubscription');
        Route::get('/RMVSBSCRPTN={sub_id}', 'AdminController@RMVSBSCRPTN');

        // SYSTEM SETTINGS ROUTE
        Route::get('/SYSTEMSETTINGS', 'AdminController@SYSTEMSETTINGS');
        Route::post('/doSYSTEMSETTINGS','AdminController@doSYSTEMSETTINGS');
        Route::get('/DELETEDOC:{docID}', 'AdminController@DELETEDOC');
        Route::get('/DISABLEDOC:{doctypeID}', 'AdminController@DISABLEDOC');
        Route::get('/ENABLEDOC:{doctypeID}', 'AdminController@ENABLEDOC');
        Route::post('/SYS_ADD_DOC', 'AdminController@SYS_ADD_DOC');
        Route::get('/COMPANYDOCUMENTS', 'AdminController@COMPANYDOCUMENTS');
        Route::get('/WORKERDOCUMENTS', 'AdminController@WORKERDOCUMENTS');
        Route::get('/TOS', 'AdminController@TOS');
        Route::get('/POLICY', 'AdminController@POLICY');

        //SUBSCRIPTIONS
        Route::get('/CREATE_SUBSCRIPTION', 'AdminController@CREATE_SUBSCRIPTION');
        Route::get('/subscriptions:{subsID}', 'AdminController@subscriptions');
        Route::get('/deleteSubscription:{subsID}', 'AdminController@deleteSubscription');
        Route::post('/UPDATESUBSCRIPTION', 'AdminController@UPDATESUBSCRIPTION');
        Route::post('/CREATESUBSCRIPTION', 'AdminController@CREATESUBSCRIPTION');

        // SKILLS ROUTE
        Route::get('/skills', 'AdminController@skills');
        Route::get('/editCategory={category}', 'AdminController@editCategory');
        Route::post('/doEditCategory', 'AdminController@doEditCategory');
        Route::get('/categoryFullDetails={cat_id}', 'AdminController@categoryFullDetails');
        Route::get('/customSkills', 'AdminController@customSkills');
        Route::get('/DELCSTSKLL={skillID}', 'AdminController@DELCSTSKLL');
        Route::post('/doEditCategorySkill', 'AdminController@doEditCategorySkill');
        Route::post('/doAddSkillToCategory', 'AdminController@doAddSkillToCategory');
        Route::post('/doAddCategory', 'AdminController@doAddCategory');
        Route::get('/deleteCategory={categorycode}', 'AdminController@deleteCategory');
        Route::get('/deleteSkill={skillcode}', 'AdminController@deleteSkill');

        // AUDIT TRAIL NEW -- Jan Sarmiento
        Route::get('/auditTrail={user_id}', 'AdminController@auditTrail');

        // THE ROLE BASED ROUTES FOR ADMINISTRATORS GOES HERE
        Route::get('/userList', 'AdminController@userList');
        Route::get('/userListTaskminators', 'AdminController@userListTaskminators');
        Route::get('/UsrAccntLstCMPNY', 'AdminController@UsrAccntLstCMPNY');
        Route::get('/admin/taskDetails/{taskid}', 'AdminController@taskDetails');
        Route::get('/viewRatings={tskmntrId}', 'AdminController@viewRatings');
        Route::get('/searchWorker:{acctStatus}:{rating}:{hiring}:{orderBy}:{keyword}:{checkout}', 'AdminController@searchWorker');
        Route::get('/userListTaskminators=search={searchBy}={searchWord}', 'AdminController@userListTaskminatorsSearch');
        Route::get('/userListClientIndi=search={keyword}={acctStatus}={acctType}={orderBy}={searchBy}={region}={city}={province}', 'AdminController@userListClientIndiSearch');
        Route::get('/userListClientComp=search={searchBy}={searchWord}', 'AdminController@userListClientCompSearch');
        Route::get('/adminDoSearch', 'searchTestController@doSearch');
        Route::get('/search_PUSR={keyword}={acctType}={orderBy}', 'AdminController@search_PUSR');

        Route::post('/adminSearchChatUser', 'AdminController@adminSearchChatUser');
        Route::get('/getCHAT={with_userId}', 'AdminController@getCHAT');
        Route::post('/ADMINSENDMESSAGE', 'AdminController@ADMINSENDMESSAGE');

        Route::get('/ADMINGETNEWMSG={userid}={senderid}', 'AdminController@ADMINGETNEWMSG');
        Route::get('/adminMessages', 'TaskminatorController@adminMessages');
        Route::get('/ADMINNavSearch={keyword}', 'AdminController@ADMINNavSearch');
    });

    Route::group(['before' => 'ADMINISTRATOR'], function(){
        // EXCLUSIVE ROUTES FOR ADMINISTRATOR
        Route::group(['before' => 'XCLSV_ADMINISTRATOR'], function(){
            Route::get('/subadmin/pending_users', 'SubAdminController@pending_users');
            Route::get('/subadmin/workers', 'SubAdminController@workers');
            Route::get('/subadmin/employers', 'SubAdminController@employers');
            Route::get('/subadmin/jobads', 'SubAdminController@jobads');
        });

        // INHERITED ROUTES - ROLE AND SUPER_ADMIN CAN ACCESS THESE ROUTES
        Route::get('/adminDeactivate/{id}', 'AdminController@adminDeactivate');
        Route::get('/adminActivate/{id}', 'AdminController@adminActivate');

        Route::get('/ADMIN_DELETEJOB={jobId}', 'AdminController@ADMIN_DELETEJOB');
    });

    Route::group(['before' => 'ADMINISTRATOR_SUPPORT'], function(){
        // SEARCH PENDING USERS
        Route::get('/subadmin/pending_users={acctType}={orderBy}={keyword}', 'SubAdminController@pending_users_SEARCH');
        // SEARCH WORKERS
        Route::get('/subadmin/workers={checkoutStatus}={acctStatus}={orderBy}={keyword}={title}', 'SubAdminController@workers_SEARCH');
        // SEARCH EMPLOYERS
        Route::get('/subadmin/employers={keyword}={status}={acctType}={orderBy}={searchBy}={region}={city}={province}={title}', 'SubAdminController@employers_SEARCH');

        Route::get('/viewUserProfile/{id}', 'AdminController@viewUserProfile');
        Route::get('/allJobAds_user/{user_id}', 'AdminController@allJobAds_user');
        Route::get('/ADMIN_jobDetails={job_id}', 'AdminController@ADMIN_jobDetails');
    });

    Route::group(['before' => 'ADMINISTRATOR_CONTENTEDITOR'], function(){
        Route::get('/subadmin/terms_of_service', 'SubAdminController@terms_of_service');
        Route::get('/subadmin/policy', 'SubAdminController@policy');
        Route::post('/POLICY_SAVE_ES', 'AdminController@POLICY_SAVE_ES');
        Route::post('/POLICY_SAVE_TG', 'AdminController@POLICY_SAVE_TG');

        Route::post('/TOS_SAVE_ES', 'AdminController@TOS_SAVE_ES');
        Route::post('/TOS_SAVE_TG', 'AdminController@TOS_SAVE_TG');
    });

    Route::group(['before' => 'SUPPORT'], function(){
        // EXCLUSIVE ROUTES FOR SUPPORT
        Route::group(['before' => 'XCLSV_SUPPORT'], function(){
            Route::get('/subadmin/view_pending_users','SubAdminController@pending_users');
            Route::get('/subadmin/view_workers','SubAdminController@workers');
            Route::get('/subadmin/view_employers','SubAdminController@employers');
            Route::get('/subadmin/view_jobads','SubAdminController@jobads');
        });
    });

    Route::group(['before' => 'CONTENT_EDITOR'], function(){
        // EXCLUSIVE ROUTES FOR CONTENT EDITOR
        Route::group(['before' => 'XCLSV_CONTENT_EDITOR'], function(){

        });
    });
    /*
    Route::get('/taskListBidding', 'AdminController@taskListBidding');
    Route::get('/taskListBidding=search={searchBy}={searchWord}={workTimeValue}={status}', 'AdminController@taskListBiddingSearch');
    Route::get('/taskListAuto', 'AdminController@taskListAuto');
    Route::get('/taskListAuto=search={searchBy}={searchWord}={workTimeValue}={status}', 'AdminController@taskListAutoSearch');
    Route::get('/taskListDirect', 'AdminController@taskListDirect');
    Route::get('/taskListDirect=search={searchBy}={searchWord}={workTimeValue}={status}', 'AdminController@taskListDirectSearch');
    Route::post('/userListClientIndi=search', 'AdminController@adminClientIndiSearch');
    Route::post('/userListClientComp=search', 'AdminController@adminClientCompSearch');
    Route::post('/pendingTskmntr=search', 'AdminController@pendingTskmntrsSearch');
    Route::post('/pendingClientIndi=search', 'AdminController@pendingClientIndiSearch');
    Route::post('/pendingClientComp=search', 'AdminController@pendingClientCompSearch');
    Route::post('/taskListBidding=search', 'AdminController@taskListBiddingSearch');
    Route::post('/taskListAuto=search', 'AdminController@taskListAutoSearch');
    Route::post('/taskListDirect=search', 'AdminController@taskListDirectSearch');
    Route::get('/viewUsersTasks/{clientid}', 'AdminController@viewUsersTasks');
    Route::post('/viewUsersTasks=search', 'AdminController@viewUsersTasksSearch');
    Route::get('/jobAds={adType}', 'AdminController@jobAds');
    Route::get('/pendingUserSearch={searchBy}={searchUserType}={searchVal}', 'AdminController@pendingUserSearch');
    */
});

Route::group(array('before' => 'TASKMINATOR-ONLY'), function(){
    // CERTIFICATIONS
    Route::get('/certifications', 'TaskminatorController@certifications');
    Route::post('/doAddCertifications', 'TaskminatorController@doAddCertifications');
    Route::get('/editCertification:{cert_id}', 'TaskminatorController@editCertification');
    Route::post('/doEditCertification', 'TaskminatorController@doEditCertification');

    // EDIT EDUCATIONAL BACKGROUND -- JAN
    Route::get('/editEducationalBackground', 'TaskminatorController@editEducationalBackground');
    Route::post('/doEditEducationalBackground', 'TaskminatorController@doEditEducationalBackground');
    Route::get('/deleteEduc={educ_id}', 'TaskminatorController@deleteEduc');
    Route::get('/editEduc={educ_id}', 'TaskminatorController@editEduc');
    Route::post('/doEditEduc', 'TaskminatorController@doEditEduc');

    // EDIT EXPERIENCE -- JAN
    Route::get('/editExperience', 'TaskminatorController@editExperience');
    Route::post('/doEditExperience', 'TaskminatorController@doEditExperience');
    Route::get('/deleteExp={exp_id}', 'TaskminatorController@deleteExp');
    Route::get('/editExp={exp_id}', 'TaskminatorController@editExp');
    Route::post('/doEditExp', 'TaskminatorController@doEditExp');

    Route::get('/wprofileProgress', 'TaskminatorController@wprofileProgress');
    Route::group(array('before' => 'WORKER-UPDATE-PROFILE-PROGRESS'), function(){
//        Route::get('/APPLYFRJB:{jobId}', 'TaskminatorController@APPLYFRJB');
//        Route::get('/WRKR_HIRED', 'TaskminatorController@WRKR_HIRED');
        Route::get('/WRKR_INVTS', 'TaskminatorController@WRKR_INVTS');
        Route::get('/WRKR_APPLCTNS', 'TaskminatorController@WRKR_APPLCTNS');
        Route::get('/jbdtls={jobId}', 'TaskminatorController@jbdtls');
        Route::post('/APPLYFRJB', 'TaskminatorController@APPLYFRJB');
        Route::get('/jobSearch:{keyword}:{workDuration}:{region}:{city}:{category}:{skill}:{orderBy}', 'TaskminatorController@jobSearch');
    });

    // DOCUMENTS MODULE
    Route::get('/editDocuments', 'TaskminatorController@editDocuments');
    Route::get('/DELETE_DOC_{docID}', 'TaskminatorController@DELETE_DOC');
    Route::post('/doUploadDocumentsWRKR', 'TaskminatorController@doUploadDocumentsWRKR');
    Route::post('/doUploadDocuments', 'TaskminatorController@doUploadDocuments');

    Route::get('/editPersonalInfo', 'TaskminatorController@editPersonalInfo');
    Route::post('/doEditPersonalInfo', 'TaskminatorController@doEditPersonalInfo');
    Route::get('/editContactInfo', 'TaskminatorController@editContactInfo');
    Route::get('/editSkillInfo', 'TaskminatorController@editSkillInfo');
    Route::post('/doEditContactInfo', 'TaskminatorController@doEditContactInfo');
    Route::post('/doEditSkillInfo', 'TaskminatorController@doEditSkillInfo');
    Route::get('/removeSkill={taskitemId}', 'TaskminatorController@removeSkill');
    Route::get('/editPass', 'TaskminatorController@editPass');
    Route::post('/doEditPass', 'TaskminatorController@doEditPass');

    // JOBS MODULE ROUTES -- START by JAN SARMIENTO
    Route::get('/CNCLAPPLCTN:{jobId}', 'TaskminatorController@CNCLAPPLCTN');
    Route::post('/ADDOWNSKILL', 'TaskminatorController@ADDOWNSKILL');
    Route::get('/RMVCSTMSKLL={custom_skill_id}', 'TaskminatorController@RMVCSTMSKLL');
    // JOBS MODULE ROUTES -- END by JAN SARMIENTO

//    Route::get('/tskmntr/taskSearch', 'TaskminatorController@taskSearch');

    // SEARCH ROUTES by Jan Sarmiento
   // Route::post('/tskmntr/doTaskSearch', 'TaskminatorController@doTaskSearch');
   // Route::get('/tskmntr/doTaskSearch={workingTime}={searchField}={searchCity}={searchWord}={rateRange}={rangeValue}', 'TaskminatorController@doTaskSearch');

    /*
    Route::get('/tskmntr/currentTask', 'TaskminatorController@currentTask');
    Route::get('/bidPTIME/{id}', 'TaskminatorController@bidPtime');
    Route::get('/bidFTIME/{id}', 'TaskminatorController@bidFtime');
    Route::post('/initBid', 'TaskminatorController@initBid');
    Route::get('/taskDetails_{id}', 'TaskminatorController@taskDetails');
    Route::get('/tskmntr_taskOffers', 'TaskminatorController@tskmntr_taskOffers');
    Route::get('/tskmntr_taskBids', 'TaskminatorController@tskmntr_taskBids');
    Route::get('/tskmntr_onGoing', 'TaskminatorController@tskmntr_onGoing');
    Route::get('/tskmntr_completed', 'TaskminatorController@tskmntr_completed');
    Route::get('/cancelBid/{id}', 'TaskminatorController@cancelBid');
    Route::get('/viewClient_{id}', 'TaskminatorController@viewClient');
    Route::get('/confirmOffer/{taskid}', 'TaskminatorController@confirmOffer');
    Route::get('/denyOffer/{taskid}', 'TaskminatorController@denyOffer');
    */

    // sms verification by MDSR
    Route::get('/doVerifyMobileNumber', 'TaskminatorController@doVerifyMobileNumber');
    Route::post('/verifyPin', 'TaskminatorController@verifyPin');
    Route::get('/sendVerificationCode', 'TaskminatorController@sendVerificationCode');

    Route::get('/sendSmsCode', 'TaskminatorController@sendSmsCode');
    Route::post('/confirmSmsCode', 'TaskminatorController@confirmSmsCode');
    //EDN OF SMS


    
    Route::get('/workerDoSearch', 'searchTestController@workerDoSearch');
    Route::get('/WSRCH={keyword}', 'TaskminatorController@WSRCH');
});

Route::group(array('before' => 'CLIENT-ONLY'), function(){
    Route::get('/cprofileProgress', 'ClientIndiController@cprofileProgress');
    Route::get('/cltEditPersonalInfo', 'ClientIndiController@cltEditPersonalInfo');
    Route::post('/doCltEditPersonalInfo', 'ClientIndiController@doCltEditPersonalInfo');
    Route::get('/cltEditContactInfo', 'ClientIndiController@cltEditContactInfo');
    Route::get('/cltEditAcctInfo', 'ClientIndiController@cltEditAcctInfo');
    Route::post('/doCltEditContactInfo', 'ClientIndiController@doCltEditContactInfo');
    Route::post('/doCltEditIndiContactInfo', 'ClientIndiController@doCltEditIndiContactInfo');
    Route::post('/doCltEditPass', 'ClientIndiController@doCltEditPass');
    Route::post('/doCltIndiEditPersonalInfo', 'ClientIndiController@doCltIndiEditPersonalInfo');

    // DOCUMENTS
    Route::get('/editDocumentsCMP', 'ClientIndiController@editDocumentsCMP');
    Route::post('/doUploadDocumentsCMP', 'ClientIndiController@doUploadDocumentsCMP');
    Route::get('/DELDOCCMP_{docID}', 'ClientIndiController@DELDOCCMP');

    // EMPLOYER MUST HAVE ATLEAST 50% PROFILE PROGRESS TO ACCESS THESE ROUTES -- JAN SARMIENTO
    Route::group(array('before' => 'EMPLOYER-UPDATE-PROFILE-PROGRESS'), function(){
        // SEEN / VIEW PROFILE THROUGH JOB AD
        Route::get('/VWPRFL:{jobapp_id}/{url}', 'ClientIndiController@VWPRFL');

        Route::get('/initFeedback:{sched_id}', 'ClientIndiController@initFeedback');
        Route::post('/doFeedback', 'ClientIndiController@doFeedback');
        Route::get('/reviews', 'ClientIndiController@reviews');
        Route::get('/dispReview/{review_id}', 'ClientIndiController@dispReview');

        // SUBSCRIPTION RESTRICTION - JOB LIMITS
        Route::group(array('before' => 'JOB_LIMITS'), function(){
            Route::get('/createJob', 'ClientIndiController@createJob');
            Route::get('/REPOST_JOB:{jobID}', 'ClientIndiController@REPOST_JOB');
            Route::post('/doCreateJob', 'ClientIndiController@doCreateJob');
        });

        Route::post('/doEditJob', 'ClientIndiController@doEditJob');
        Route::get('/editJob={jobId}', 'ClientIndiController@editJob');
        Route::get('/deleteJob={jobId}', 'ClientIndiController@deleteJob');
        Route::get('/jobDetails={jobId}', 'ClientIndiController@jobDetails');
        Route::get('/jobs', 'ClientIndiController@jobs');

        // SUBSCRIPTION RESTRICTION - INVITATION LIMITS
        Route::group(array('before' => 'invite_limit'), function(){
            // MULTIPLE INVITE ROUTES
            Route::post('/SENDMULTIPLEINVITE', 'ClientIndiController@SENDMULTIPLEINVITE');
            // MULTIPLE JOB FOR SINGLE INVITE
            Route::post('/INVITEMULTIJOB', 'ClientIndiController@INVITEMULTIJOB');

            Route::post('/DOSNDINVT', 'ClientIndiController@DOSNDINVT');

            // BULK INVITE FROM BOOKMARK
            Route::get('/BulkInviteToApply={user_id}', 'ClientIndiController@BulkInviteToApply');
        });

        // HIRE WORKER
        Route::get('/hireWorker={worker_id}={job_id}', 'ClientIndiController@hireWorker');
        Route::get('/doHireWorker={worker_id}={job_id}', 'ClientIndiController@doHireWorker');

        Route::get('/SNDINVT:{invitedId}:{jobId}', 'ClientIndiController@SNDINVT');
        Route::get('/cancelInvite:{jobID}:{workerID}', 'ClientIndiController@cancelInvite');
        Route::get('/ShowInvited:{jobId}', 'ClientIndiController@ShowInvited');
        Route::get('/JOB_DELETECUSTSKILL={custom_skill_id}', 'ClientIndiController@JOB_DELETECUSTSKILL');

        // CART
        Route::get('/addToCart={worker_id}', 'ClientIndiController@addToCart');
        Route::get('/GET_CART_CONTENTS', 'ClientIndiController@GET_CART_CONTENTS');
//        Route::post('/doCheckout', 'ClientIndiController@doCheckout');    // OLD CHECKOUT PROCEDURE -- Jan Sarmiento
        Route::get('/doCheckout={worker_id}', 'ClientIndiController@doCheckout');       // NEW CHECKOUT PROCEDURE -- Jan Sarmiento
        Route::get('/checkouts', 'ClientIndiController@checkouts');
        Route::get('/removeCartItem:{cartID}', 'ClientIndiController@removeCartItem');
        Route::get('/compDoSearch', 'searchTestController@compDoSearch');
        Route::get('/CISRCH/{prog}={keyword}', 'ClientIndiController@CISRCH');

        Route::get('/SRCHWRKRSKLL={categoryId}={skillId}={region}={city}={province}={profilePercentage}={keyword}', 'ClientIndiController@SRCHWRKRSKLL');

        // BOOKMARK ROUTES
        Route::group(array('before' => 'worker_bookmark_limit'), function(){
            Route::get('/ADD_BOOKMARK:{worker_id}', 'ClientIndiController@ADD_BOOKMARK');
        });

        Route::get('/REMOVE_BOOKMARK:{book}', 'ClientIndiController@REMOVE_BOOKMARK');
        Route::get('/bookmarkedUsers', 'ClientIndiController@bookmarkedUsers');

        Route::get('/WRKRSRCH:{jobId}:{categoryCode}:{skillCode}:{customSkill}', 'ClientIndiController@WRKRSRCH');
    });
//    Route::get('/createTask', 'ClientIndiController@createTask');
//    Route::post('/createTask', 'ClientIndiController@doCreateTask');
//    Route::get('/editTask/{id}', 'ClientIndiController@editTask');
//    Route::get('/deleteTask/{id}', 'ClientIndiController@deleteTask'); // this is actually "CANCEL" task
//    Route::post('/doEditTask', 'ClientIndiController@doEditTask');
//    Route::get('/tasks', 'ClientIndiController@tasks');
//    Route::get('/taskDetails/{id}', 'ClientIndiController@taskDetails');
//    Route::get('/hireTskmntr/{userid}/{taskid}', 'ClientIndiController@hireTskmntr');
//    Route::get('/tskmntrSearch', 'ClientIndiController@tskmntrSearch');
//    Route::get('/doTskmntrSearch={searchField}={searchKeyword}={city}', 'ClientIndiController@doTskmntrSearch');
//    Route::get('/viewTaskminator_{id}', 'ClientIndiController@viewTaskminator');
//    Route::get('/directHire_{id}', 'ClientIndiController@directHire');
//    Route::get('/doDirectHire_{taskminatorid}.{taskid}', 'ClientIndiController@doDirectHire');
//    Route::get('/retractOffer/{taskId}/{tskmntrId}', 'ClientIndiController@retractOffer');
//    Route::get('/completeTask/taskid:{taskid}', 'ClientIndiController@completeTask');
//    Route::post('/rateTaskminator', 'ClientIndiController@rateTaskminator');
//    Route::get('/accomplishedTasks', 'ClientIndiController@accomplishedTasks');
//    Route::get('/cancelledTasks', 'ClientIndiController@cancelledTasks');
//    Route::get('/automaticSearch/{taskId}', 'ClientIndiController@automaticSearch');
//    Route::get('/automaticOffer/{taskId}={userid}', 'ClientIndiController@automaticOffer');
    Route::get('/SKILLCATCHAIN={categoryId}', 'ClientIndiController@SKILLCATCHAIN');
});

Route::get('/test', 'HomeController@TESTINGROUTE'); // TESTING


Route::get('/{username}', 'HomeController@toProfile'); // new profile page viewer

// THIS FUNCTION IS FOR ROUTE PROTECTION - IT REDIRECTS THE SYSTEM WHEN cTHE ROUTE/METHOD IS NOT FOUND AND/OR DOESN'T EXIST - Jan Sarmiento
App::missing(function(){
    return View::make('ERRORPAGE');
});

// THIS FUNCTION REDIRECTS USER TO INDEX or '/' IF THE PAGE MAKES AN ERROR - Jan Sarmiento
//App::error(function(Exception $exception, $code){
//    return View::make('ERRORPAGE');
//});
