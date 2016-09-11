<?php

use Carbon\Carbon;

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    function sendReply($mobile_number, $reply, $request_id, $type){
        //please see https://api.chikka.com/docs/handling-messages#reply-sms
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }

    public function sendSms($mobileNum, $message, $userId){
        date_default_timezone_set("Asia/Manila");
        $arr_post_body = array(
            "message_type"  => "SEND",
            "mobile_number" => $mobileNum,
            "shortcode"     => "2929062641",
            "message_id"    => Sms::max('id')+1,
            "message"       => urlencode($message),
            "client_id"     => "76b4f21bfbaeec04b3a79c83860fde6fc37810dd427918c21ebd973becff97e8",
            "secret_key"    => "a3e207f05220a9dae9821efe2b655444cbf5e6c366b3fc7077dbf433dd9bf39e"
        );

        $query_string = "";
        foreach($arr_post_body as $key => $frow)
        {
            $query_string .= '&'.$key.'='.$frow;
        }

        $URL = "https://post.chikka.com/smsapi/request";

        $curl_handler = curl_init();
        curl_setopt($curl_handler, CURLOPT_URL, $URL);
        curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
        curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handler);
        curl_close($curl_handler);

        Sms::insert(array(
            'user_id'       =>  $userId,
            'message'       =>  $message,
            'mobileNum'     =>  $mobileNum,
            'created_at'    =>  date("Y:m:d H:i:s")
        ));

//        exit(0);
    }

    // used to get user RATINGS
    // returns NULL of user has NO RATINGS
    public function getRatings($userId){
        return Rate::where('taskminator_id', $userId)->avg('stars');
    }

    // returns ROLE of users
    public function getRole($userId){
        return User::where('users.id', $userId)
                ->join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                ->select('roles.role')
                ->pluck('roles.role')
                ->first();

    }

    // GET SKILLS OF USER - Returns array
    public function GETTASKCODES($userId){
        $skills = User::getSkillsCODE($userId);
        $myArr = array();
        foreach($skills as $s){
            array_push($myArr, $s->itemcode);
        }

        return $myArr;
    }

    public function GETAPPLICANTS($jobId){
        $APPLICANTS = User::join('job_applications', 'job_applications.applicant_id', '=', 'users.id')
            ->where('job_applications.job_id', $jobId)
            ->select([
                'users.id'
            ])
            ->get();

        $myArr = array();
        foreach($APPLICANTS as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function GETINVITEDS($jobId){
        $INVITEDS = User::join('job_invites', 'job_invites.invited_id', '=', 'users.id')
            ->where('job_invites.job_id', $jobId)
            ->select([
                'users.id'
            ])
            ->get();

        $myArr = array();
        foreach($INVITEDS as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function GETINCART($companyID){
        $INCART = User::join('carts', 'carts.worker_id', '=', 'users.id')
                    ->where('carts.company_id', $companyID)
                    ->select([
                        'users.id'
                    ])
                    ->get();

        $myArr = array();
        foreach($INCART as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public static  function GETCHECKEDOUTUSERS_STATIC($companyID){
        $P = User::join('purchases', 'purchases.worker_id', '=', 'users.id')
            ->where('purchases.company_id', $companyID)
            ->select([
                'users.id'
            ])
            ->get();


        $myArr = array();
        foreach($P as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function GETCHECKEDOUTUSERS($companyID){
        $P = User::join('purchases', 'purchases.worker_id', '=', 'users.id')
                ->where('purchases.company_id', $companyID)
            ->select([
                'users.id'
            ])
            ->get();


        $myArr = array();
        foreach($P as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public function IF_EMAIL_EXISTS($email){
        if(Contact::where('content', $email)->count() > 0){
            return true;
        }else{
            return false;
        }
    }


    public static function IS_PURCHASED($compID, $workerID){
        if(Purchase::where('company_id', $compID)->where('worker_id', $workerID)->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function WORKERGETINVITES_JOBID($workerID){
        $j = JobInvite::where('invited_id', $workerID)->get();

        $myArr = array();
        foreach($j as $o){
            array_push($myArr, $o->job_id);
        }

        return $myArr;
    }

    public function POINT_CHECK($USERPOINTS, $SCENARIO){
        switch($SCENARIO){
            case 'CREATE_JOB' :
            case 'REPOST_JOB' :
                $POINT_PER_JOB = SystemSetting::where('type', 'SYSSETTINGS_POINTSPERAD')->pluck('value');
                if($POINT_PER_JOB > $USERPOINTS){
                    return false;
                }else{
                    return true;
                }
            default :
                return false;
        }
    }

    public function GET_JOBAD_EXPIRATION($timestamp){
        $SYSSETTINGS_JOBADDURATION = SystemSetting::where('type', 'SYSSETTINGS_JOBADDURATION')->pluck('value');
        return date("Y:m:d H:i:s", time($timestamp) + ((floatval($SYSSETTINGS_JOBADDURATION) * 60 * 60)));
    }

    public function UPDATE_JOBADS($userID){
        $jobs = Job::where('user_id', $userID)->get();

        // CHECK FOR EXPIRATION
        // Updates `expired` column to TRUE if job is expired, else, FALSE
        foreach($jobs as $j){
            if(Carbon::now()->gte(Carbon::parse($j->expires_at))){
                Job::where('id', $j->id)->update(['expired' => true]);
            }
        }
    }

    public static function ROUTE_UPDATE_JOBADS($userID){
        $jobs = Job::where('user_id', $userID)->get();
        // CHECK FOR EXPIRATION
        // Updates `expired` column to TRUE if job is expired, else, FALSE
        foreach($jobs as $j){
            $bc = new BaseController();
            $url = '/jobDetails='.$j->id;
            if(Carbon::now()->gt(Carbon::parse($j->expires_at))){
                Job::where('id', $j->id)->update(['expired' => true]);
                $msg = 'Your job ad - '.$j->title.' has expired.';
                $NOTIF_EXISTS = Notification::where('user_id', $j->user_id)->where('content', $msg)->where('notif_url', $url)->count();
                if($NOTIF_EXISTS == 0){
                    $bc->NOTIFICATION_INSERT($j->user_id, $msg, $url);
                }
            }elseif(Carbon::now()->diffInDays(Carbon::parse($j->expires_at)) <= 3){
                $msg = 'Your job ad - '.$j->title.' will expire in less than 3 days';
                $NOTIF_EXISTS = Notification::where('user_id', $j->user_id)->where('content', $msg)->where('notif_url', $url)->count();
                if($NOTIF_EXISTS == 0){
                    $bc->NOTIFICATION_INSERT($j->user_id, $msg, $url);
                }
            }
        }
    }

    public function GETAPPLICATIONS_ID($workerID){
        $jobs = JobApplication::where('applicant_id', $workerID)->select(['job_id'])->get();

        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->job_id);
        }

        return $myArr;
    }

    public function NOTIFICATION_INSERT($receiverID, $msg, $url){
        Notification::insert([
            'user_id'   =>  $receiverID,
            'content'   =>  $msg,
            'notif_url' =>  $url,
            'status'    =>  'NEW',
            'created_at'=>  date("Y:m:d H:i:s")
        ]);
    }

    public function DOCUMENTS_GETEXISTINGTYPES($userID){
        $types = Document::join('document_types', 'document_types.sys_doc_type', '=', 'documents.type')
                    ->where('documents.user_id', $userID)
                    ->select(['document_types.sys_doc_type'])
                    ->get();

        $myArr = array();
        foreach($types as $o){
            array_push($myArr, $o->sys_doc_type);
        }

        return $myArr;
    }

    public function DOCUMENTS_GETEXISTINGLABELS($userID){
        $types = Document::join('document_types', 'document_types.sys_doc_type', '=', 'documents.type')
            ->where('documents.user_id', $userID)
            ->select(['document_types.sys_doc_label'])
            ->get();

        $myArr = array();
        foreach($types as $o){
            array_push($myArr, $o->sys_doc_label);
        }

        return $myArr;
    }

    public function ALL_JOBS($companyID){
        $jobs = Job::where('user_id', $companyID)->get();

        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public static function ALL_JOBS_STATIC($companyID){
        $jobs = Job::where('user_id', $companyID)->get();

        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public static function IS_AN_APPLICANT_FOR_COMPANY($workerID, $compID){
        $ALL_JOBS_OF_COMP = BaseController::ALL_JOBS_STATIC($compID);
        $flag = JobApplication::whereIn('job_id', $ALL_JOBS_OF_COMP)->where('applicant_id', $workerID)->count();
        return ($flag > 0);
    }

    public static function PROVEEK_PROFILE_PERCENTAGE_EMPLOYER($user_id){
        $user = User::where('id', $user_id)->first();
        $mobile = Contact::where('user_id', $user->id)->where('ctype', 'mobileNum')->pluck('content');
        $businessMobile = Contact::where('user_id', $user->id)->where('ctype', 'businessNum')->pluck('content');
        $email = Contact::where('user_id', $user->id)->where('ctype', 'email')->pluck('content');
        $POEA_LICENSE = Document::where('user_id', $user_id)->where('type', 'DOLE_LICENSE')->count();
        $DOLE_LICENSE = Document::where('user_id', $user_id)->where('type', 'POEA_LICENSE')->count();
        $CONTACT_PERSON = ContactPerson::where('user_id', $user_id)->count();

        $base = 0;
        $base = ($user->fullName    == null) ? $base : ++$base;
        $base = ($user->region      == null) ? $base : ++$base;
        $base = ($user->province    == null) ? $base : ++$base;
        $base = ($user->city        == null) ? $base : ++$base;
        $base = ($user->barangay    == null) ? $base : ++$base;
        $base = ($user->businessPermit          == null) ? $base : ++$base;
        $base = ($user->businessDescription     == null) ? $base : ++$base;
        $base = ($user->profilePic  == null) ? $base : ++$base;
        $base = ($mobile            == null) ? $base : ++$base;
        $base = ($businessMobile    == null) ? $base : ++$base;
        $base = ($email             == null) ? $base : ++$base;
//        $base += 4;

        $first50 = $base * (50/11);

        // computation for 2nd 50%
        $base = 0;
        $base = ($user->businessNature          ==  null) ? $base : ++$base;
        $base = ($user->years_in_operation      ==  null) ? $base : ++$base;
        $base = ($user->number_of_branches      ==  null) ? $base : ++$base;
        $base = ($CONTACT_PERSON                <=     0) ? $base : ++$base;
        $base = ($user->number_of_employees     ==  null) ? $base : ++$base;
        $base = ($user->working_hours           ==  null) ? $base : ++$base;

        if($POEA_LICENSE > 0){
            $base++;
        }elseif($DOLE_LICENSE > 0){
            $base++;
        }

        $FINAL_PERCENTAGE = $first50 + ($base * (50/7));

        // update total_profile_progress_column on users table
        User::where('id', $user->id)->update([
            'total_profile_progress' =>  $FINAL_PERCENTAGE
        ]);

        return $FINAL_PERCENTAGE;
    }

    public static function PROVEEK_PROFILE_PERCENTAGE_WORKER($user_id){
        $user = User::where('id', $user_id)->first();
        $facebook = Contact::where('user_id', $user->id)->where('ctype', 'facebook')->pluck('content');
        $mobile = Contact::where('user_id', $user->id)->where('ctype', 'mobileNum')->pluck('content');
        $email = Contact::where('user_id', $user->id)->where('ctype', 'email')->pluck('content');
        // documents
        $doc_count = Document::where('user_id', $user_id)->count();
        /*
        $PASSPORT = Document::where('user_id', $user_id)->where('type', 'PASSPORT')->count();
        $NBI = Document::where('user_id', $user_id)->where('type', 'NBI')->count();
        $VOTERS_ID = Document::where('user_id', $user_id)->where('type', 'VOTERS_ID')->count();
        $TIN = Document::where('user_id', $user_id)->where('type', 'TIN_ID')->count();
        */
        $exp = WorkerExperience::where('user_id', $user_id)->count();
        $edu = WorkerEducation::where('user_id', $user_id)->count();
        // skill
        $skill_count = TaskminatorHasSkill::where('user_id', $user->id)->count() + CustomSkill::where('created_by', $user->id)->count();

        // first 50% - 10 items
        $base = 0;
        $base = ($user->fullName    != null) ? ++$base : $base;
        $base = ($user->birthdate   != null) ? ++$base : $base;
        $base = ($user->gender      != null) ? ++$base : $base;
        $base = ($user->address     != null) ? ++$base : $base;
        $base = ($edu                   >=1) ? ++$base : $base;
        $base = ($exp                   >=1) ? ++$base : $base;
        $base = ($skill_count           >=1) ? ++$base : $base;
        $base = ($skill_count           >=2) ? ++$base : $base;
        $base = ($mobile            != null) ? ++$base : $base;
        $base = ($email             != null) ? ++$base : $base;
        $FIRST_50 = $base * (50/10);
        $base = 0;

        // second 50% - 10 items
        $base = ($user->marital_status  != null) ? ++$base : $base;
        $base = ($edu                       >=2) ? ++$base : $base;
        $base = ($edu                       >=3) ? ++$base : $base;
        $base = ($skill_count               >=3) ? ++$base : $base;
        $base = ($skill_count               >=4) ? ++$base : $base;
        $base = ($user->profilePic      != null) ? ++$base : $base;
        $base = ($doc_count                 >=1) ? ++$base : $base;
        $base = ($doc_count                 >=2) ? ++$base : $base;
        $base = ($exp                       >=2) ? ++$base : $base;
        $base = ($facebook              != null) ? ++$base : $base;
        $SECOND_50 = $base * (50/10);
        $FINAL_PERCENTAGE = $FIRST_50 + $SECOND_50;

        // UPDATE total_profile_progress column on users table
        User::where('id', $user->id)->update([
            'total_profile_progress' =>  $FINAL_PERCENTAGE
        ]);

        return $FINAL_PERCENTAGE;

        /*
        // 1st 50%
        $base = 0; // INITIALIZE
        $base = ($user->firstName       == null) ? $base : ++$base;
        $base = ($user->lastName        == null) ? $base : ++$base;
        $base = ($user->region          == null) ? $base : ++$base;
        $base = ($user->province        == null) ? $base : ++$base;
        $base = ($user->barangay        == null) ? $base : ++$base;
        $base = ($user->city            == null) ? $base : ++$base;
        $base = ($user->birthdate       == null) ? $base : ++$base;
        $base = ($user->marital_status  == null) ? $base : ++$base;
        $base = ($user->profilePic      == null) ? $base : ++$base;
        $base = ($mobile                == null) ? $base : ++$base;
        $base = ($email                 == null) ? $base : ++$base;

        if($PASSPORT > 0){
            $base++;
        }else if($NBI > 0){
            $base++;
        }else if($VOTERS_ID > 0){
            $base++;
        }else if($TIN > 0){
            $base++;
        }

        // skills and custom skills
        if(TaskminatorHasSkill::where('user_id', $user->id)->count() > 0 || CustomSkill::where('created_by', $user->id)->count() > 0){
            $base++;
        }

        $first50 = $base * (50/13);
        $base = 0;

        $base = ($user->educationalBackground   == null) ? $base : ++$base;
        $base = ($user->experience              == null) ? $base : ++$base;
        $FINAL_PERCENTAGE = $first50 + ($base * (50/2));

        // UPDATE total_profile_progress column on users table
        User::where('id', $user->id)->update([
            'total_profile_progress' =>  $FINAL_PERCENTAGE
        ]);

        return $FINAL_PERCENTAGE;
        */
    }

    public function GET_WORKER_APPLICATIONS($workerID){
        $ox = JobApplication::where('applicant_id', $workerID)->select(['job_id'])->get();
        $myArr = array();
        foreach($ox as $o){
            array_push($myArr, $o->job_id);
        }
        return $myArr;
    }

    public static function EMPLOYER_APPLICANTS($employer_id){
        $jobs = Job::join('job_applications', 'job_applications.job_id', '=', 'jobs.id')
            ->where('jobs.user_id', $employer_id)
            ->select([
                'jobs.id'
            ])
            ->get();
        $myArr = array();
        foreach($jobs as $o){
            array_push($myArr, $o->id);
        }
        return $myArr;
    }

    public function APPLICATIONS_OF_WORKER_FOR_COMPANY($companyID, $workerID){
        return Job::join('job_applications', 'job_applications.job_id', '=', 'jobs.id')
                ->where('jobs.user_id', $companyID)
                ->where('job_applications.applicant_id', $workerID)
                ->select([
                    'jobs.id',
                    'jobs.title',
                    'job_applications.created_at as applied_at'
                ])
//                ->paginate(10);
                ->get();
    }

    public function APPLY_SUBSCRIPTION_EMPLOYERS($sys_subscription_id, $employer_id){
        if($sys_subscription_id != 0){
            $sub_duration = SystemSubscription::where('id', $sys_subscription_id)->pluck('subscription_duration');
//            $total_duration = time() + ($sub_duration * 24 * 60 * 60);
//            $total_duration = date("Y:m:d H:i:s", $total_duration);
            $total_duration = Carbon::now()->addDays($sub_duration);

            $subscription_id = UserSubscription::insertGetId([
                'user_id'                   =>  $employer_id,
                'system_subscription_id'    =>  $sys_subscription_id,
                'expires_at'                =>  $total_duration,
                'created_at'                =>  Carbon::now()
            ]);

            User::where('id', $employer_id)->update([
                'accountType'   =>  $subscription_id
            ]);

            return true;
        }else{
            return false;
        }
    }

    public function SUBSCRIPTION_DURATION_MSG($user_id){
        $subscription = UserSubscription::join('system_subscriptions', 'user_subscriptions.system_subscription_id', '=', 'system_subscriptions.id')
                        ->where('user_subscriptions.user_id', $user_id)
                        ->where('user_subscriptions.expired', false)
                        ->select([
                            'system_subscriptions.subscription_label as label',
                            'user_subscriptions.expires_at'
                        ])
                        ->first();

        if($subscription){
            return 'Your '.$subscription->label.' Package will expire at '.date('m/d/y', strtotime($subscription->expires_at));
        }else{
            return '<i class="fa fa-warning"></i>&nbsp;&nbsp;You are currently not subscribed to any Proveek Packages';
        }
    }

    public function ALL_SUBSCRIPTIONS_ARRAY(){
        $ox = SystemSubscription::get();

        $myArr = array();
        foreach($ox as $o){
            array_push($myArr, $o->id);
        }

        return $myArr;
    }

    public static function SUBSCRIPTION_EXPIRED($sub_id, $userID){
        UserSubscription::where('id', $sub_id)->update([
            'expired'   =>  true
        ]);
    }

    public static function SUBSCRIPTION_UPDATE($employerID){
        $notif_days = [15,13,11,9,7,5,3,2,1];

        $url = '/TOPTUP';
        $bc = new BaseController();
        $subscription_id = User::where('id', $employerID)->pluck('accountType');
        $subscription_details = UserSubscription::where('id', $subscription_id)->first();
        if($subscription_details && !$subscription_details->expired){
            if(time() > strtotime($subscription_details->expires_at)){
                $msg = 'Your subscription has expired';
                $NOTIF_EXISTS = Notification::where('user_id', $employerID)->where('content', $msg)->where('notif_url', $url)->count();
                if($NOTIF_EXISTS == 0){
                    $bc->NOTIFICATION_INSERT($employerID, $msg, $url);
                }
                BaseController::SUBSCRIPTION_EXPIRED($subscription_id, $employerID);
            }elseif(in_array(Carbon::now()->diffInDays(Carbon::parse($subscription_details->expires_at)), $notif_days)){
                $days = Carbon::now()->diffInDays(Carbon::parse($subscription_details->expires_at));
                $msg = 'Your subscription will expire in less than '.$days.' day(s)';
                $NOTIF_EXISTS = Notification::where('user_id', $employerID)->where('content', $msg)->where('notif_url', $url)->count();
                if($NOTIF_EXISTS == 0){
                    $bc->NOTIFICATION_INSERT($employerID, $msg, $url);
                }
            }
        }
    }

    public function SUBSCRIPTION_RESTRICTIONS($userID, $restrictionType){
        // RETURNS TRUE IF RESTRICTIONS ARE VIOLATED
        $subscription_id = User::where('id', $userID)->pluck('accountType');
        $subscription_details = UserSubscription::where('id', $subscription_id)->first();
        if($subscription_details){
            $system_subscription_details = SystemSubscription::where('id', $subscription_details->system_subscription_id)->first();
            $subscription_start = $subscription_details->created_at;
            $subscription_expiration = $subscription_details->expires_at;

            switch($restrictionType){
                case 'worker_browse' :
                    return ($system_subscription_details->worker_browse) ? 0 : 1;
                    break;
                case 'worker_bookmark_limit' :
                    return $this->RSTRCTN_WORKER_BOOKMARK_LIMIT($userID, $subscription_start, $system_subscription_details->worker_bookmark_limit);
                    break;
                case 'invite_limit' :
                    return $this->RSTRCTN_INVITE_LIMIT($userID, $subscription_start, $system_subscription_details->invite_limit);
                    break;
                case 'job_ad_limit_week' :
                    return $this->RSTRCTN_JOBADLIMIT_WK($userID, $subscription_start, $system_subscription_details->job_ad_limit_week);
                    break;
                case 'job_ad_limit_month' :
                    return $this->RSTRCTN_JOBADLIMIT_MNTH($userID, $subscription_start, $subscription_expiration, $system_subscription_details->job_ad_limit_month);
                    break;
                default :
                    return 'DEFAULT';
                    break;
            }
        }else{
            return 1;
        }
    }

    public function RSTRCTN_WORKER_BOOKMARK_LIMIT($userID, $start_date, $quantity){
        $start_date = strtotime($start_date);
        $end_date = $start_date + (7 * 24 * 60 * 60);

        if(time() > $end_date){
            $start_date = $end_date + (24 * 60 * 60);
            $end_date = $start_date + (7 * 24 * 60 * 60);
        }

        $bookmarksOfTheWeek = BookmarkUser::where('company_id', $userID)
            ->whereBetween('created_at', array(date("Y:m:d H:i:s", $start_date), date("Y:m:d H:i:s", $end_date)))
            ->count();

        return ($bookmarksOfTheWeek >= $quantity) ? 1 : 0;
    }

    public function RSTRCTN_INVITE_LIMIT($userID, $start_date, $quantity){
        $start_date = strtotime($start_date);
        $end_date = $start_date + (7 * 24 * 60 * 60);

        if(time() > $end_date){
            $start_date = $end_date + (24 * 60 * 60);
            $end_date = $start_date + (7 * 24 * 60 * 60);
        }

        $inviteOfTheWeek = JobInvite::join('jobs', 'jobs.id', '=', 'job_invites.job_id')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->where('users.id', $userID)
            ->whereBetween('job_invites.created_at', array(date("Y:m:d H:i:s", $start_date), date("Y:m:d H:i:s", $end_date)))
            ->count();

        return ($inviteOfTheWeek >= $quantity) ? 1 : 0;
    }

    public function RSTRCTN_JOBADLIMIT_WK($userID, $start_date, $quantity){
        $start_date = strtotime($start_date);
        $end_date = $start_date + (7 * 24 * 60 * 60);

        if(time() > $end_date){
            $start_date = $end_date + (24 * 60 * 60);
            $end_date = $start_date + (7 * 24 * 60 * 60);
        }

        $jobAdsOfTheWeek = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->where('users.id', $userID)
            ->whereBetween('jobs.created_at', array(date("Y:m:d H:i:s", $start_date), date("Y:m:d H:i:s", $end_date)))
//            ->groupBy('jobs.id')
            ->count();

        return ($jobAdsOfTheWeek >= $quantity) ? 1 : 0;
    }

    public function RSTRCTN_JOBADLIMIT_MNTH($userID, $start_date, $end_date, $quantity){
        $jobsOfTheMonth = Job::join('users', 'users.id', '=', 'jobs.user_id')
                ->where('users.id', $userID)
                ->whereBetween('jobs.created_at', array($start_date, $end_date))
                ->count();

        return ($jobsOfTheMonth >= $quantity) ? 1 : 0;
    }

    public function SUBSCRIPTION_DETAILS($userID){
        return SystemSubscription::join('user_subscriptions', 'user_subscriptions.system_subscription_id', '=', 'system_subscriptions.id')
                ->join('users', 'users.id', '=', 'user_subscriptions.user_id')
                ->where('users.id', $userID)
                ->groupBy('system_subscriptions.id')
                ->first();
    }

    public function USERNAME_EXIST_AS_ROUTE($username){
        foreach (Route::getRoutes() as $value) {
            if($value->getPath() == $username){
                return true;
            }
        }
        return false;
    }

    public static function ROUTE_UPDATE_FEEDBACKS($userID){
        $sched = WorkerFeedbackSchedule::where('employer_id', $userID)->get();
        foreach($sched as $s){
            if(Carbon::now()->gte(Carbon::parse($s->start_date))){
                $worker = User::where('id', $s->worker_id)->first();
                $job = Job::where('id', $s->job_id)->first();
                $msg = 'Please fill out feedback form for your applicant from your job ad - '.$job->title;
                $url = '/initFeedback:'.$s->id;
                $NOTIF_EXISTS = Notification::where('user_id', $s->employer_id)->where('content', $msg)->where('notif_url', $url)->count();
                if($NOTIF_EXISTS == 0){
                    $bc = new BaseController();
                    $bc->NOTIFICATION_INSERT($s->employer_id, $msg, $url);
                }
            }
        }
    }

    public function GET_HIRED_JOBSID($worker_id){
        $ox = JobHiredWorker::where('worker_id', $worker_id)->get();
        $myArr = array();
        foreach($ox as $o){ array_push($myArr, $o->job_id); }
        return $myArr;

    }

    public function GET_HIRED_WORKERSID_JOB($jobId){
        $ox = JobHiredWorker::where('job_id', $jobId)->get();
        $myArr = array();
        foreach($ox as $o){ array_push($myArr, $o->worker_id); }
        return $myArr;
    }

    public static function CHECK_EMPLOYER_POINTS($user_id){
        $points = User::where('id', $user_id)->pluck('points');
        if($points <= 50){
            $url = '/TOPUP';
            $msg = 'You have '.$points.' points left. Click here to reload.';
            $NOTIF_EXISTS = Notification::where('user_id', $user_id)->where('content', $msg)->where('notif_url', $url)->count();
            if($NOTIF_EXISTS == 0){
                $bc = new BaseController();
                $bc->NOTIFICATION_INSERT($user_id, $msg, $url);
            }
            return true;
        }else{
            return false;
        }
    }

    public function INSERT_AUDIT_TRAIL($user_id, $msg){
        AuditTrail::insert([
            'user_id'   => $user_id,
            'content'   => $msg,
            'at_url'    => Request::url(),
            'ip_address'=> Request::getClientIp(),
            'created_at'=> Carbon::now()
        ]);
    }

    public function GET_ALL_CHECKEDOUT_WORKERS($companyID){
        $ox = Purchase::where('company_id', $companyID)->get();
        $myArr = array();
        foreach($ox as $o){ array_push($myArr, $o->worker_id); }
        return $myArr;
    }

    public function ADMIN_GET_CHECKEDOUT_WORKERS(){
        $myArr = array();
        foreach(Purchase::get() as $o){ array_push($myArr, $o->worker_id); }
        return $myArr;
    }

    public static function ADMIN_GET_ALL_ADMIN_ID($role){
        $admins = AdminRole::join('admin_has_roles', 'admin_has_roles.admin_role_id', '=', 'admin_roles.id')
            ->whereIn('admin_roles.role', $role)
            ->select(['admin_has_roles.user_id'])
            ->get();
        $myArr = array();
        foreach($admins as $o){ array_push($myArr, $o->user_id); }
        return $myArr;
    }

    public static function GET_ALL_ADMIN(){
        $admins = AdminHasRole::select(['user_id'])->groupBy('user_id')->get();
        $myArr = array();
        foreach($admins as $o){ array_push($myArr, $o->user_id); }
        return $myArr;
    }

    public function CHECKOUT_UPDATE($user_id){
        $bc = new BaseController();
        foreach(Purchase::where('company_id', $user_id)->get() as $p){
            if(Carbon::now()->gte(Carbon::parse($p->expires_at))){
                Purchase::where('id', $p->id)->delete();
                $msg = 'Your checkout for '.User::where('id', $p->worker_id)->pluck('fullName').' has expired.';
                $bc->NOTIFICATION_INSERT($p->company_id, $msg, '/checkouts');
            }elseif(Carbon::now()->diffInDays(Carbon::parse($p->expires_at)) <= 3){
                $msg = 'Your checkout for '.User::where('id', $p->worker_id)->pluck('fullName').' is about to expire in '.Carbon::now()->diffInDays(Carbon::parse($p->expires_at)).' days.';
                $NOTIF_EXISTS = Notification::where('user_id', $p->company_id)->where('content', $msg)->where('notif_url', '/checkouts')->count();
                if($NOTIF_EXISTS == 0){
                    $bc->NOTIFICATION_INSERT($p->company_id, $msg, '/checkouts');
                }
            }
        }
    }
    // AUTHORED BY Jan Sarmiento -- END
}
