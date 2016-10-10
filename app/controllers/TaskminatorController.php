<?php

use Carbon\Carbon;
class TaskminatorController extends \BaseController {

    function generateUniqueId(){
        $random = '';
        while(1){
            $random = md5(uniqid(rand(), true));
            if(User::where('confirmationCode', $random)->count() == 0){
                break;
            }
        }
        return $random;
    }

    function emailValidate($email){
        return preg_match('/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/', $email);
    }

    public function messages(){
        return View::make('taskminator.messages')
            ->with('threads', Thread::where('user_id', Auth::user()->id)->where('status', 'OPEN')->orderBy('created_at', 'ASC')->get());
    }

    /*
    public function bidPtime($id){
        if($this->PROFILE_PERCENTAGE_WORKER(Auth::user()->id) < 50){
            Session::flash('err_search', 'Please fill out your profile atleast 50%');
            return Redirect::to('/');
        }else{
            if(TaskHasBidder::where('task_id', $id)->where('taskminator_id', Auth::user()->id)->count() > 0){
                Session::flash('error', 'You have already placed a bid for this task');
                return Redirect::back();
            }

            if(Auth::user()->status == 'PRE_ACTIVATED'){
                Session::flash('error', 'Your account must first be fully activated by admin before you can apply for jobs');
                return Redirect::back();
            }else{
                return View::make('taskminator.bid')->with('hiringType', 'PART')->with('task_id', $id)->with('task', Task::where('id', $id)->first());
            }
        }
    }

    public function bidFtime($id){
        if($this->PROFILE_PERCENTAGE_WORKER(Auth::user()->id) < 50){
            Session::flash('err_search', 'Please fill out your profile atleast 50%');
            return Redirect::to('/');
        }else{
            if(TaskHasBidder::where('task_id', $id)->where('taskminator_id', Auth::user()->id)->count() > 0){
                Session::flash('error', 'You have already placed a bid for this task');
                return Redirect::back();
            }

            if(Auth::user()->status == 'PRE_ACTIVATED'){
                Session::flash('error', 'Your account must first be fully activated by admin before you can apply for jobs');
                return Redirect::back();
            }else{
                return View::make('taskminator.bid')->with('hiringType', 'FULL')->with('task_id', $id)->with('task', Task::where('id', $id)->first());
            }
        }
    }

    public function initBid(){
        date_default_timezone_set("Asia/Manila");
        $clientId = Task::where('id', Input::get('taskId'))->pluck('user_id');
        $clientDetails = User::where('id', $clientId)->first();
        $mobileNum = Contact::where('user_id', $clientId)->where('ctype', 'mobileNum')->pluck('content');

        // proposed rate validation
        if(!ctype_digit(Input::get('proposedRate'))){
            return Redirect::back()->with('errorMsg', 'Proposed rate must be numbers only')->withInput(Input::except('password'));
        }

        // message validation
        if(Input::get('message') == '' || Input::get('message') == null){
            return Redirect::back()->with('errorMsg', 'Message cannot be empty')->withInput(Input::except('password'));
        }

        // VALIDATE DEADLINE
        if(Input::get('proposedDuration') == '' || Input::get('proposedDuration') == null){
            return Redirect::back()->with('errorMsg', 'Please choose a Proposed Date')->withInput(Input::except('password'));
        }else if(!$this->validateDate(Input::get('proposedDuration'))){
            return Redirect::back()->with('errorMsg', 'Please choose a Proposed Date')->withInput(Input::except('password'));
        }else if(date_create(Input::get('proposedDuration')) < date_create('today')){
            return Redirect::back()->with('errorMsg', 'Proposed Date cannot be a past date')->withInput(Input::except('password'));
        }

        // update relationship between task and taskminator
        TaskHasBidder::insert(array(
            'task_id'           =>  Input::get('taskId'),
            'taskminator_id'    =>  Auth::user()->id,
            'proposedRate'      =>  Input::get('proposedRate'),
            'message'           =>  Input::get('message'),
            'created_at'        =>  date("Y:m:d H:i:s"),
            'updated_at'        =>  date("Y:m:d H:i:s")
        ));

        Notification::insert(array(
            'content'       =>  Auth::user()->fullName.' has made a bid on '.Task::where('id', Input::get('taskId'))->pluck('name'),
            'user_id'       =>  $clientId,
            'notif_url'     =>  '/taskDetails/'.Input::get('taskId'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'status'        =>  'NEW'
        ));

        $smsMessage = Auth::user()->fullName.' has made a bid on '.Task::where('id', Input::get('taskId'))->pluck('name');
        $this->sendSms($mobileNum, $smsMessage, $clientId);

        $taskDetails = Task::where('id', Input::get('taskId'))->first();

        AuditTrail::insert(array(
            'user_id'   =>  Auth::user()->id,
            'content'   =>  'Bid for task titled <span style="color: #2980B9;">'.$taskDetails->name.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/taskDetails/'.$taskDetails->id
        ));

        return Redirect::to('/tskmntr_taskBids');
    }

    public function doUploadDocuments(){
        date_default_timezone_set("Asia/Manila");
        $document = Input::file('document');
        $keySkills = Input::file('keySkills');
        $destinationPath = 'public/upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id;

        if(!isset($document)){
            return Redirect::back()->with('errorMsg', 'Please attach a document before submitting');
        }

        if(!isset($keySkills)){
            return Redirect::back()->with('errorMsg', 'Please attach at least 2 (Two) certification of skill before submitting');
        }else if(count($keySkills) < 2){
            return Redirect::back()->with('errorMsg', 'Please attach at least 2 (Two) certification of skill before submitting');
        }

        // UPLOADING DOCUMENT
        $rules = array('file' => 'required|mimes:pdf,doc,docx');
        $validator = Validator::make(array('file'=> $document), $rules);
        if($validator->passes()){
            $filename   =   $document->getClientOriginalName();
            $upload_success =   $document->move($destinationPath, $filename);

            Document::insert(array(
                'user_id'       =>  Auth::user()->id,
                'docname'       =>  $filename,
                'path'          =>  '/upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id.'/'.$filename,
                'type'          =>  'DOCUMENT',
                'created_at'    =>  date("Y:m:d H:i:s"),
                'updated_at'    =>  date("Y:m:d H:i:s"),
            ));
        }else{
            return Redirect::back()->with('errorMsg', $validator);
        }

        // UPLOADING KEYSKILLS (IMAGES)

        $rules = array('file' => 'required|mimes:png,jpeg,jpg');

        foreach($keySkills as $ks){
            $newFileName = md5(uniqid(rand(), true));
            $validator = Validator::make(array('file'=> $ks), $rules);
            if($validator->passes()){
                $filename = $newFileName.'.'.$ks->getClientOriginalExtension();
                $upload_success = $ks->move($destinationPath, $filename);

                Photo::insert(array(
                    'user_id'       =>  Auth::user()->id,
                    'imgname'       =>  $filename,
                    'path'          =>  '/upload/'.Auth::user()->confirmationCode.'_'.Auth::user()->id.'/'.$filename,
                    'type'          =>  'KEYSKILLS',
                    'created_at'    =>  date("Y:m:d H:i:s"),
                    'updated_at'    =>  date("Y:m:d H:i:s"),
                ));
            }else{
                return Redirect::back()->with('errorMsg', $validator);
            }
        }

        AuditTrail::insert(array(
            'user_id'   =>  Auth::user()->id,
            'content'   =>  'Uploaded files for full activation at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/viewUserProfile/'.Auth::user()->id
//                'module'   =>  'Logged in at '.date('D, M j, Y \a\t g:ia'),
        ));

        return Redirect::back()->with('errorMsg', 'Upload successful. Please while your profile is being reviewed. This might take more or less than (24) hours.');
    }
    public function taskDetails($id){
        $taskType = Task::where('id', $id)->pluck('hiringType');

        if($taskType == 'BIDDING'){
            return View::make('taskminator.taskDetails_bid')
                ->with('task', Task::where('id', $id)->first())
                ->with('bid', TaskHasBidder::where('taskminator_id', Auth::user()->id)->first());
//                ->with('bidders', TaskHasBidder::where('task_id', $id)->get());

        }else if($taskType == 'AUTOMATIC'){
            return View::make('taskminator.taskDetails_direct')
                ->with('task', Task::where('id', $id)->first())
                ->with('hired', TaskHasTaskminator::where('task_id', $id)->get());
        }else{
            return View::make('taskminator.taskDetails_direct')
                ->with('task', Task::where('id', $id)->first())
                ->with('bidders', TaskHasTaskminator::where('task_id', $id)->get());
        }
    }

    public function tskmntr_taskOffers(){
        $taskOffer = Task::join('taskminator_has_offer', 'tasks.id', '=', 'taskminator_has_offer.task_id')
            ->where('taskminator_has_offer.taskminator_id', Auth::user()->id)
            ->where('tasks.status', 'OPEN')
            ->select([
                'tasks.id',
                'tasks.name',
                'tasks.created_at as taskDate',
                'taskminator_has_offer.created_at as offerDate',
                'tasks.deadline',
                'tasks.user_id',
            ])
//            ->get();
            ->paginate(10);

        return View::make('taskminator.currentTask')
            ->with('taskOffer', $taskOffer)
            ->with('pageTitle', 'Task Offers');
    }

    public function tskmntr_taskBids(){
        $tasksBid = Task::join('task_has_bidders', 'tasks.id', '=', 'task_has_bidders.task_id')
            ->where('task_has_bidders.taskminator_id', Auth::user()->id)
            ->where('tasks.status', 'OPEN')
            ->select([
                'tasks.id',
                'tasks.name',
                'tasks.created_at as taskDate',
                'task_has_bidders.created_at as bidDate',
                'tasks.deadline',
                'tasks.user_id',
            ])
//            ->get();
            ->paginate(10);

        return View::make('taskminator.currentTask')
            ->with('tasksBid', $tasksBid)
            ->with('pageTitle', 'Task Bids');
    }

    public function tskmntr_onGoing(){
        $tasksTaken = Task::join('task_has_taskminator', 'tasks.id', '=', 'task_has_taskminator.task_id')
            ->where('task_has_taskminator.taskminator_id', Auth::user()->id)
            ->where('tasks.status', 'ONGOING')
            ->select([
                'tasks.id',
                'tasks.name',
                'tasks.created_at as taskDate',
                'task_has_taskminator.created_at as hireDate',
                'tasks.deadline',
                'tasks.user_id',
            ])
//            ->get();
            ->paginate(10);

        return View::make('taskminator.currentTask')
            ->with('tasksTaken', $tasksTaken)
            ->with('pageTitle', 'On Going Tasks');
    }

    public function tskmntr_completed(){
        $tasksDone = Task::join('task_has_taskminator', 'tasks.id', '=', 'task_has_taskminator.task_id')
            ->where('task_has_taskminator.taskminator_id', Auth::user()->id)
            ->where('tasks.status', 'COMPLETE')
            ->select([
                'tasks.id',
                'tasks.name',
                'tasks.created_at as taskDate',
                'task_has_taskminator.created_at as hireDate',
                'tasks.deadline',
                'tasks.user_id',
                'tasks.completed_at',
            ])
//            ->get();
            ->paginate(10);

        return View::make('taskminator.currentTask')
            ->with('tasksDone', $tasksDone)
            ->with('pageTitle', 'Completed Tasks');
    }

    public function cancelBid($id){
        TaskHasBidder::where('task_id', $id)->where('taskminator_id', Auth::user()->id)->delete();

        AuditTrail::insert(array(
            'user_id'   =>  Auth::user()->id,
            'content'   =>  'Cancelled bid on task titled <span style="color: #2980B9;">'.Task::where('id', $id)->pluck('name').'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/taskDetails/'.$id
        ));

        return Redirect::back()->with('errorMsg', 'Bid has been cancelled');
    }

    public function viewClient($id){
        $role = User::join('user_has_role', 'user_has_role.user_id', '=', 'users.id')->where('users.id', $id)->pluck('role_id');
//        if($role == 4){
//
//        }else if()
        return View::make('taskminator.viewClient')->with('client', User::where('id', $id)->first());
    }

    public function confirmOffer($taskid){
        date_default_timezone_set("Asia/Manila");
        $taskDetails = Task::where('id', $taskid)->first();
        $threadCode = $this->generateUniqueId();
        $authUserId = Auth::user()->id;
        $currentDate = date('Y:m:d H:i:s');
        $taskName = $taskDetails->name;
        $clientDetails = User::where('id', $taskDetails->user_id)->first();
        $mobileNum = Contact::where('user_id', $clientDetails->id)->where('ctype', 'mobileNum')->pluck('content');

        if($clientDetails->points < 25){
            return Redirect::back()->with('errorMsg', 'Cannot accept request because client has insufficient funds.');
        }else{
            User::where('id', $clientDetails->id)->update(array('points' => ($clientDetails->points - 25)));
        }

        TaskminatorHasOffer::where('task_id', $taskid)->delete();

        TaskHasTaskminator::insert(array(
            'task_id'   =>  $taskid,
            'taskminator_id'   =>  Auth::user()->id,
            'proposedRate'   =>  $taskDetails->salary,
//            'message'   =>  $bidInfo->message,
            'created_at'   =>  date("Y:m:d H:i:s"),
        ));

        Task::where('id', $taskid)->update(array(
            'status'    =>  'ONGOING'
        ));

        // CREATE THREAD FOR CHAT MODULE
        DB::insert("INSERT INTO `threads` (`user_id`, `task_id`,`title`, `code`, `created_at`, `status`) VALUES
            ('$authUserId', '$taskid', '$taskName', '$threadCode', '$currentDate', 'OPEN'),
            ('$clientDetails->id', '$taskid', '$taskName', '$threadCode', '$currentDate', 'OPEN')
        ");

//        DB::insert("INSERT INTO `threads` (`user_id`, `title`, `code`, `created_at`) VALUES
//            ('$authUserId', '$taskName', '$threadCode', '$currentDate'),
//            ('$clientDetails->id', '$taskName', '$threadCode', '$currentDate')
//        ");

        Notification::insert(array(
            'content'   =>  "Your offer to ".Auth::user()->fullName." has been accepted for task ".$taskDetails->name,
            'user_id'   =>  $clientDetails->id,
            'notif_url' =>  '/taskDetails_'.$taskDetails->id,
            'status'    =>  'NEW',
            'created_at'=>  date("Y:m:d H:i:s")
        ));

        $smsMessage = "Your offer to ".Auth::user()->fullName." has been accepted for task ".$taskDetails->name;
        $this->sendSms($mobileNum, $smsMessage, $clientDetails->id);

        AuditTrail::insert(array(
            'user_id'       =>  $clientDetails->id,
            'content'       =>  'Offer accepted by <span style="color:#2980B9">'.Auth::user()->fullName.'</span> for task <span style="color:#16A085">'.$taskDetails->name.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/taskDetails/'.$taskid
        ));

        AuditTrail::insert(array(
            'user_id'       =>  Auth::user()->id,
            'content'       =>  'Accepted task offered by '.$clientDetails->fullName.' for <span style="color:#16A085">'.$taskDetails->name.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/taskDetails/'.$taskid
        ));

        return Redirect::to('/taskDetails_'.$taskid)
                ->with('successMsg', 'Task has been accepted');
    }

    public function denyOffer($taskId){

        $taskDetails = Task::where('id', $taskId)->first();
        $clientDetails = User::where('id', $taskDetails->user_id)->first();
        $mobileNum = Contact::where('user_id', $clientDetails->id)->where('ctype', 'mobileNum')->pluck('content');

        date_default_timezone_set("Asia/Manila");
        TaskminatorHasOffer::where('taskminator_id', Auth::user()->id)->where('task_id', $taskId)->delete();

        Notification::insert(array(
            'content'   =>  "Your offer to ".Auth::user()->fullName." has been deniend for task ".$taskDetails->name,
            'user_id'   =>  $clientDetails->id,
            'notif_url' =>  '/taskDetails_'.$taskDetails->id,
            'status'    =>  'NEW',
            'created_at'=>  date("Y:m:d H:i:s")
        ));

        $smsMessage = "Your offer to ".Auth::user()->fullName." has been deniend for task ".$taskDetails->name;
        $this->sendSms($mobileNum, $smsMessage, $clientDetails->id);

        AuditTrail::insert(array(
            'user_id'       =>  $clientDetails->id,
            'content'       =>  'Offer denied by <span style="color:#2980B9">'.Auth::user()->fullName.'</span> for task <span style="color:#16A085">'.$taskDetails->name.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/taskDetails/'.$taskId
        ));

        AuditTrail::insert(array(
            'user_id'       =>  Auth::user()->id,
            'content'       =>  'Deniend task offered by '.$clientDetails->fullName.' for <span style="color:#16A085">'.$taskDetails->name.'</span> at '.date('D, M j, Y \a\t g:ia'),
            'created_at'    =>  date("Y:m:d H:i:s"),
            'at_url'        =>  '/taskDetails/'.$taskId
        ));

        return Redirect::back()->with('successMsg', 'Offer has been denied');
    }

    */

    public function editPersonalInfo(){
        return View::make('taskminator.editPersonalInfo')
                ->with('prog', TaskminatorController::WORKER_profileProgress())
                ->with('user', Auth::user())
                ->with('regions', Region::orderBy('regname', 'ASC')->get())
                ->with('prov', Province::orderBy('provname', 'ASC')->where('regcode', Auth::user()->region)->get())
                ->with('cities', City::orderBy('cityname', 'ASC')->where('regcode', Auth::user()->region)->get())
                ->with('barangays', Barangay::orderBy('bgyname', 'ASC')->where('regcode', Auth::user()->region)->get());
    }

    public function doEditPersonalInfo(){
        /*
        // FIRSTNAME VALIDATION
        if(!ctype_alpha(str_replace(' ', '', trim(Input::get('firstName'))))){
            return Redirect::back()->with('errorMsg', 'First name must be letters only')->withInput(Input::except('password'));
        }else if(strlen(trim(Input::get('firstName'))) == 0){
            return Redirect::back()->with('errorMsg', 'First name cannot be empty')->withInput(Input::except('password'));
        }

        // MIDDLE NAME VALIDATION
//        if(!ctype_alpha(str_replace(' ', '', trim(Input::get('midName'))))){
//            return Redirect::back()->with('errorMsg', 'Middle name must be letters only')->withInput(Input::except('password'));
//        }else if(strlen(trim(Input::get('midName'))) == 0){
//            return Redirect::back()->with('errorMsg', 'Middle name cannot be empty')->withInput(Input::except('password'));
//        }

        // LAST NAME VALIDATION
        if(!ctype_alpha(str_replace(' ', '', trim(Input::get('lastName'))))){
            return Redirect::back()->with('errorMsg', 'Last name must be letters only')->withInput(Input::except('password'));
        }else if(strlen(trim(Input::get('lastName'))) == 0){
            return Redirect::back()->with('errorMsg', 'Last name cannot be empty')->withInput(Input::except('password'));
        }

        // ADDRESS VALIDATION
        if(strlen(Input::get('address')) == 0){
            return Redirect::back()->with('errorMsg', 'Address cannot be empty')->withInput(Input::except('password'));
        }else if(strlen(strip_tags(Input::get('address'))) == 0){
            return Redirect::back()->with('errorMsg', 'Address cannot contain tags')->withInput(Input::except('password'));
        }

        // CITY VALIDATION
        if(Input::get('city-task') == null || Input::get('city-task') == 0){
            return Redirect::back()->with('errorMsg', 'City cannot be empty')->withInput(Input::except('password'));
        }

        // BARANGAY VALIDATION
        if(Input::get('barangay-task') == null || Input::get('barangay-task') == 0){
            return Redirect::back()->with('errorMsg', 'City cannot be empty')->withInput(Input::except('password'));
        }
        */
        $middleName = (Input::has('midName') ? Input::get('midName') : null);
        User::where('id', Auth::user()->id)->update(array(
            'firstName'         =>  Input::get('firstName'),
            'midName'           =>  $middleName,
            'lastName'          =>  Input::get('lastName'),
            'fullName'          =>  Input::get('firstName').' '.Input::get('midName').' '.Input::get('lastName'),
            'birthdate'         =>  Carbon::parse(Input::get('date')),
            'gender'            =>  Input::get('gender'),
            'address'           =>  strip_tags(Input::get('address')),
            'region'            =>  Input::get('reg-task'),
            'city'              =>  Input::get('city-task'),
            'barangay'          =>  Input::get('barangay-task'),
            'province'          =>  Input::get('edt_prov'),
//            'educationalBackground'          =>  Input::get('educBg'),
//            'experience'        =>  Input::get('experience'),
            'marital_status'    =>  Input::get('marital_status'),
        ));
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Edited personal information');
        return Redirect::back()
                ->with('successMsg', 'Personal Information has been successfully edited.');
    }

    public function editContactInfo(){
        return View::make('taskminator.editContactInfo')
            ->with('prog', TaskminatorController::WORKER_profileProgress())
            ->with('contacts', Contact::where('user_id', Auth::user()->id)->orderBy('content', 'DESC')->get());
    }

    public function doEditContactInfo(){
        // EMAIL VALIDATION
        if(!$this->emailValidate(Input::get('email'))){
            return Redirect::back()->with('errorMsg', 'Please enter valid email')->withInput(Input::except('password'));
        }else if(Contact::where('ctype', 'email')->where('content', Input::get('email'))->whereNotIn('user_id', [Auth::user()->id])->count() > 0){
            return Redirect::back()->with('errorMsg', 'Email is already taken')->withInput(Input::except('password'));
        }

        /*
        // FACEBOOK VALIDATION
        if(strlen(trim(strip_tags(Input::get('facebook')))) == 0){
            return Redirect::back()->with('errorMsg', 'Facebook field cannot be empty')->withInput(Input::except('password'));
        }

        // LINKEDIN VALIDATION
        if(strlen(trim(strip_tags(Input::get('linkedin')))) == 0){
            return Redirect::back()->with('errorMsg', 'LinkedIn field cannot be empty')->withInput(Input::except('password'));
        }
        */

        // MOBILE NUMBER VALIDATION
        if(!ctype_digit(Input::get('mobileNum'))){
            return Redirect::back()->with('errorMsg', 'Mobile number must be numbers only')->withInput(Input::except('password'));
        }else if(strlen(Input::get('mobileNum')) == 0 || strlen(Input::get('mobileNum')) < 11){
            return Redirect::back()->with('errorMsg', 'Mobile number cannot be empty and must be more than 11 digits')->withInput(Input::except('password'));
        }

        $mobileNum = Contact::where('user_id', Auth::user()->id )->where('ctype', 'mobileNum')->pluck('content');
        if($mobileNum != Input::get('mobileNum')){
                    //Generate NEW PIN CODE
                    $letters = '01234ABCDEFGHIJKLM56789NOPQRSTUVWXYZ';
                    $key = '';
                    for($i = 1; $i <= 5; $i++)
                    {
                     $key .= $letters[mt_rand(0, strlen($letters) - 1)];
                    }
                    //END OF Generate NEW PIN CODE
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'mobileNum')->update(['content' => Input::get('mobileNum'), 'pincode' => $key]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'mobileNum')->update(['content' => Input::get('mobileNum'), 'pincode' => $key]); 
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'email')->update(['content' => Input::get('email'), 'pincode' => $key]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'facebook')->update(['content' => Input::get('facebook'), 'pincode' => $key]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'linkedin')->update(['content' => Input::get('linkedin'), 'pincode' => $key]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'twitter')->update(['content' => Input::get('twitter'), 'pincode' => $key]);
        }else{
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'mobileNum')->update(['content' => Input::get('mobileNum')]); 
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'email')->update(['content' => Input::get('email')]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'facebook')->update(['content' => Input::get('facebook')]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'linkedin')->update(['content' => Input::get('linkedin')]);
        Contact::where('user_id', Auth::user()->id)->where('ctype', 'twitter')->update(['content' => Input::get('twitter')]);
        }




        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Edited contact information');
        return Redirect::back()->with('successMsg', 'Successfully edited contact information.');
    }

    public function editSkillInfo(){
        $query = TaskminatorHasSkill::join('taskcategory', 'taskcategory.categorycode', '=', 'taskminator_has_skills.taskcategory_code')
            ->join('taskitems', 'taskitems.itemcode', '=', 'taskminator_has_skills.taskitem_code')
            ->where('taskminator_has_skills.user_id', Auth::user()->id)
            ->select([
                'taskminator_has_skills.taskitem_code',
                'taskminator_has_skills.taskcategory_code',
                'taskminator_has_skills.user_id',
                'taskitems.itemname',
                'taskcategory.categoryname',
            ])
            ->get();

        $custom_skills = CustomSkill::get();
        $worker_cust_skills = CustomSkill::where('created_by', Auth::user()->id)->get();
        return View::make('taskminator.editSkillInfo')
            ->with('prog', TaskminatorController::WORKER_profileProgress())
            ->with('skills', $query)
            ->with('categories', TaskCategory::orderBy('categoryname', 'ASC')->get())
            ->with('categorySkills', TaskItem::where('item_categorycode', '006')->orderBy('itemname', 'ASC')->get())
            ->with('custom_skills', $custom_skills)
            ->with('worker_cust_skills', $worker_cust_skills);
    }

    public function doEditSkillInfo(){
        $query = TaskminatorHasSkill::where('user_id', Auth::user()->id);
        if($query->where('taskitem_code', Input::get('taskitems'))->count() > 0){
            return Redirect::back()->with('errorMsg', 'You already have this skill');
        }else{
            TaskminatorHasSkill::insert(array(
                'user_id'           =>  Auth::user()->id,
                'taskitem_code'     =>  Input::get('taskitems'),
                'taskcategory_code' =>  Input::get('taskcategory')
            ));

            $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Edited custom skills information');
            return Redirect::back()->with('successMsg', 'Skill successfully added');
        }
    }

    public function removeSkill($taskitemId){
        TaskminatorHasSkill::where('user_id', Auth::user()->id)
            ->where('taskitem_code', $taskitemId)->delete();

        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Removed system skill information');
        return Redirect::back()->with('successMsg', 'Skill successfully deleted');
    }

    public function editPass(){
        return View::make('taskminator.changePass');
    }

    public function doEditPass(){
        if(!Auth::attempt(array('username'=>Auth::user()->username, 'password' => Input::get('oldPass')))){
            return Redirect::back()->with('errorMsg', 'Your old password is incorrect');
        }

        if(Input::get('newPass') != Input::get('confirmNewPass')){
            return Redirect::back()->with('errorMsg', 'Passwords does not match');
        }

        // PASSWORD VALIDATION
        if(!ctype_alnum(Input::get('newPass'))){
            return Redirect::back()->with('errorMsg', 'Password must be alphanumeric (numbers and letters) only');
        }else if(strlen(Input::get('newPass')) < 8){
            return Redirect::back()->with('errorMsg', 'Password must be more than 8 characters');
        }

        User::where('id', Auth::user()->id)->update(array(
            'password'  =>  Hash::make(Input::get('newPass'))
        ));

        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Changed password');
        return Redirect::back()->with('successMsg', 'Password successfully changed');
    }

        //SMS bY MDSR

    public function sendSmsCode(){
          if(Contact::where('user_id', Auth::user()->id)->pluck('pincode') == 'verified'){
            //return View::make('editProfile_tskmntr')->with('user', User::where('id', Auth::user()->id)->first());       
           // return View::make('verifysuccess');
            echo "user is here";
            
            echo str_random(32);
            
           // echo "mobile number = ".$mobileNum;
        }else{
            include('ChikkaSMS.php');
             $SMSCODE = Contact::where('user_id', Auth::user()->id )->where('ctype', 'mobileNum')->pluck('pincode');
             $mobileNum = Contact::where('user_id', Auth::user()->id )->where('ctype', 'mobileNum')->pluck('content');
             //edit mobile number for sending sms text
             $mobileNum = "63".substr($mobileNum,1);
        
            $clientId = '6df7472869b1ae7542fedd1244bc588aa4215564a0ad064a08a2001f8701fdb2';
            $secretKey = '6389e577850a038b66a1274c789e7b8c13493efcfeda56a15b4e57f171d216b0';
            $shortCode = '292906377';
            $SMSmessage =  'WELCOME TO PROVEEK.      Code:'. $SMSCODE.'. Use this to verify your mobile number in Proveek.';
            $messageID = mt_rand(100000,999999);

            $chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
            $response = $chikkaAPI->sendText($messageID, $mobileNum, $SMSmessage);
            header("HTTP/1.1 " . $response->status . " " . $response->message);
           // exit($response->description);

            /*
             $arr_post_body = array(
            "message_type" => "SEND",
            "mobile_number" =>  $mobileNum,
            "shortcode" => "292906377",
            "message_id" => str_random(32),
            "message" => urlencode("WELCOME TO PROVEEK.   ".$SMSCODE.". Use this to verify your mobile number in Proveek.") , 
            "client_id" => "6df7472869b1ae7542fedd1244bc588aa4215564a0ad064a08a2001f8701fdb2",
            "secret_key" => "6389e577850a038b66a1274c789e7b8c13493efcfeda56a15b4e57f171d216b0"
             );

             $query_string = "";
        foreach($arr_post_body as $key => $frow){
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

        echo "Accepted";
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Send SMS Verification code');
       return Redirect::back()->with('successMsg', 'SMS Code Sent!');

       */
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'SMS Code is sent');
        return Redirect::back()->with('successMsg', 'SMS Code sent!');
        }



        
    }

    public function verifySmsCode(){

         $SMSCODE = Contact::where('user_id', Auth::user()->id )->where('ctype', 'mobileNum')->pluck('pincode');



    }







    public function sendVerificationCode(){
        // pincode already verified
        if(Contact::where('user_id', Auth::user()->id)->pluck('pincode') == 'verified'){
            //return View::make('editProfile_tskmntr')->with('user', User::where('id', Auth::user()->id)->first());       
            return View::make('verifysuccess');
        }
        //Generate PIN CODE
        $letters = '01234ABCDEFGHIJKLM56789NOPQRSTUVWXYZ';
        $key = '';
        for($i = 1; $i <= 5; $i++)
        {
         $key .= $letters[mt_rand(0, strlen($letters) - 1)];
        }
        //END OF Generate PIN CODE


        //INSERT PINCODE TO DB
         DB::table('contacts')
                ->where('user_id', Auth::user()->id)
                ->update(['pincode' => $key]);

        //GET Mobile Number
        $mobileNum = Contact::where('user_id', Auth::user()->id )->where('ctype', 'mobileNum')->pluck('content');
	$mobileNum = "63".substr($mobileNum,1);
        //Send PIN to Mobile Number via SMS
        $arr_post_body = array(
            "message_type" => "SEND",
            "mobile_number" =>  $mobileNum,
            "shortcode" => "292906377",
            "message_id" => str_random(32),
            "message" => $key.". Use this to verify your mobile number in Proveek.", 
            "client_id" => "6df7472869b1ae7542fedd1244bc588aa4215564a0ad064a08a2001f8701fdb2",
            "secret_key" => "6389e577850a038b66a1274c789e7b8c13493efcfeda56a15b4e57f171d216b0"
        );

        $query_string = "";
        foreach($arr_post_body as $key => $frow){
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

        return View::make('taskminator.doVerifyMobileNumber')
           ->with('contacts', Contact::where('user_id', Auth::user()->id)->get());
    }    

    public function doVerifyMobileNumber(){
        $pincode = Contact::where('user_id', Auth::user()->id)->pluck('pincode');
        // pincode already verified
        if($pincode == 'verified'){
            //return View::make('editProfile_tskmntr')->with('user', User::where('id', Auth::user()->id)->first());       
            return View::make('verifysuccess');
        }
        // no pincode
        if($pincode == null){
            $this->sendVerificationCode();    
        }
    
        return View::make('taskminator.doVerifyMobileNumber')
           ->with('contacts', Contact::where('user_id', Auth::user()->id)->get());
    }

    public function verifyPIN(){
        // trim white space
        Input::merge(array_map('trim', Input::all()));

        //GET PIN FROM DB
        $pin = Contact::where('user_id',  Auth::user()->id)->pluck('pincode');

        // pincode already verified
        if($pin == 'verified'){
            //return View::make('editProfile_tskmntr')->with('user', User::where('id', Auth::user()->id)->first());       
            return View::make('verifysuccess');
        }

        //VALIDATE USER INPUT
        $rules = array(
            'pinCode' => "required"
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            //echo $validator->messages()->first();
            return Redirect::back()->with('errorMsg', $validator->messages()->first());
        }

        // check if matched
        if(Input::get('pinCode') == $pin){

            //UPDATE THE CONTACT STATUS OF MOBILE NUMBER
             DB::table('contacts')
                ->where('user_id', Auth::user()->id)
                ->where('ctype', 'mobileNum' )
                ->update(['pincode' => 'verified']);          

	    Auth::logout();
            //return View::make('editProfile_tskmntr')->with('user', User::where('id', Auth::user()->id)->first());       
            return View::make('verifysuccess');
        }
        else{
            return Redirect::back()->with('errorMsg', 'Wrong Pin Code')->withInput(Input::except('inputpin'));
        }
    }

    public function WSRCH($keyword){
        if($keyword == "NONE"){
            $keyword = "";
        }

        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->whereIn('user_has_role.role_id', [3,4])
            ->whereNotIn('users.status', ['PRE_ACTIVATED'])


            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])
            ->where('users.fullName', 'LIKE', '%'.$keyword.'%')
            ->paginate(10);


        $skillCodeArray = $this->GETTASKCODES(Auth::user()->id);
        $tasks = Task::where('hiringType', 'BIDDING')
            ->where('name', 'LIKE', '%'.$keyword.'%')
            ->where('status', 'OPEN')
            ->whereIn('taskType', $skillCodeArray)
            ->orderBy('created_at','DESC')->paginate(10);

//        $tasks = Task::where('name', 'LIKE', '%'.$keyword.'%')
//            ->paginate(10);s

        return View::make('taskminator.general_search')
                ->with('keyword', $keyword)
                ->with('users', $users)
                ->with('tasks', $tasks)
                ->with('TOTALPROG', $this->PROFILE_PERCENTAGE_WORKER(Auth::user()->id));
    }

    public function jbdtls($jobId){
        $HIRED = JobHiredWorker::where('job_id', $jobId)->where('worker_id', Auth::user()->id)->first();
        $job = Job::join('taskcategory', 'jobs.skill_category_code', '=', 'taskcategory.categorycode')
            ->join('taskitems', 'jobs.skill_code', '=', 'taskitems.itemcode')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->leftJoin('barangays', 'barangays.bgycode', '=', 'jobs.bgycode')
            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
            ->where('jobs.id', $jobId)
            ->select([
                'jobs.id as jobId',
                'jobs.title',
                'jobs.created_at',
                'jobs.description',
                'jobs.requirements',
                'jobs.salary',
                'jobs.hiring_type',
                'jobs.Industry',
                'jobs.AverageProcessingTime',
                'jobs.CompanySize',
                'jobs.WorkingHours',
                'jobs.DressCode',
                'jobs.expired',
                'regions.regname',
                'regions.regcode',
                'barangays.bgyname',
                'barangays.bgycode',
                'cities.cityname',
                'cities.citycode',
                'taskcategory.categoryname',
                'taskcategory.categorycode',
                'taskitems.itemname',
                'taskitems.itemcode',
                'users.fullName',
                'users.username',
                'users.id as companyID',
            ])
            ->first();

        $custom_skills = CustomSkill::where('company_job_id', $jobId)->get();
        $application = JobApplication::where('job_id', $jobId)
            ->where('applicant_id', Auth::user()->id)
            ->first();

        $hasInvite = JobInvite::where('job_id', $jobId)
            ->where('invited_id', Auth::user()->id)
            ->first();

        return View::make('taskminator.jbdtls')
            ->with('HIRED', $HIRED)
            ->with('job', $job)
            ->with('custom_skills', $custom_skills)
            ->with('application', $application)
            ->with('hasInvite', $hasInvite);
    }

    public function APPLYFRJB(){
        if(JobApplication::where('job_id', Input::get('application_jobID'))->where('applicant_id', Auth::user()->id)->count() == 0){
            JobApplication::insert([
                'applicant_id'  =>  Auth::user()->id,
                'job_id'        =>  Input::get('application_jobID'),
//                'message'       =>  Input::get('application_message'),
                'created_at'    =>  date("Y:m:d H:i:s")
            ]);
        }

        $job = Job::where('id', Input::get('application_jobID'))->first();
        $client = User::where('id', $job->user_id)->first();

        // NOTIFICATION
        $this->NOTIFICATION_INSERT($client->id, 'Worker has applied for <b>'.$job->title.'</b>', '/jobDetails='.$job->id);
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Sent application for a <a href="/ADMIN_jobDetails='.Input::get('application_jobID').'">job</a>');

        return Redirect::back();
    }

    public function CNCLAPPLCTN($jobId){
        $job = Job::where('id', $jobId)->first();
        Cart::where('worker_id', Auth::user()->id)
            ->where('company_id', $job->user_id)
            ->delete();

        WorkerFeedbackSchedule::where('job_id', $jobId)->where('worker_id', Auth::user()->id)->delete();

        JobApplication::where('job_id', $jobId)
            ->where('applicant_id', Auth::user()->id)
            ->delete();
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Cancelled application for a <a href="/ADMIN_jobDetails='.$jobId.'">job</a>');
        return Redirect::back();
    }

    public function WRKR_APPLCTNS(){
        $JOB_APPLICATIONS = $this->GETAPPLICATIONS_ID(Auth::user()->id);
        $JOB_HIRED = $this->GET_HIRED_JOBSID(Auth::user()->id);
        $JOB_INVITES = $this->WORKERGETINVITES_JOBID(Auth::user()->id);
        $skillCodeArray = $this->GETTASKCODES(Auth::user()->id);

        $jobs = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
            ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->whereIn('jobs.skill_code', $skillCodeArray)
            ->whereNotIn('jobs.id', array_merge($JOB_APPLICATIONS, $JOB_HIRED, $JOB_INVITES))
//            ->whereNotIn('jobs.id', $this->GETAPPLICATIONS_ID(Auth::user()->id))
//            ->whereNotIn('jobs.id', $this->GET_HIRED_JOBSID(Auth::user()->id))
            ->where('expired', false)
            ->orderBy('jobs.created_at', 'DESC')
            ->select([
                'users.id as user_id',
                'users.fullName',
                'users.profilePic',
                'jobs.title',
                'jobs.id as job_id',
                'jobs.expires_at',
                'jobs.expired',
                'jobs.salary',
                'jobs.created_at',
                'jobs.description',
                'jobs.hiring_type',
                'cities.cityname',
                'regions.regname',
            ])
            ->paginate(10);

        $applications = JobApplication::join('jobs', 'jobs.id', '=', 'job_applications.job_id')
                        ->join('users', 'users.id', '=', 'jobs.user_id')
                        ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                        ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
//                        ->whereNotIn('jobs.id', array_merge($JOB_INVITES))
                        ->where('job_applications.applicant_id', Auth::user()->id)
                        ->select([
                            'users.id as user_id',
                            'users.fullName',
                            'users.profilePic',
                            'jobs.title',
                            'jobs.id as jobID',
                            'jobs.expires_at',
                            'jobs.expired',
                            'jobs.salary',
                            'jobs.created_at',
                            'jobs.description',
                            'jobs.hiring_type',
                            'cities.cityname',
                            'regions.regname',
//                            'jobs.title',
//                            'jobs.id as jobID',
                            'job_applications.id as jobAppID',
                            'job_applications.created_at'
                        ])
                        ->orderBy('job_applications.created_at', 'desc')
                        ->get();

        return View::make('taskminator.WRKR_APPLCTNS')
                ->with('jobs', $jobs)
                ->with('applications', $applications);
    }

    public function WRKR_INVTS(){
        $APPLICATIONS = $this->GETAPPLICATIONS_ID(Auth::user()->id);
        $invites = JobInvite::join('jobs', 'job_invites.job_id', '=', 'jobs.id')
                    ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                    ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
                    ->where('invited_id', Auth::user()->id)
                    ->whereNotIn('jobs.id', $APPLICATIONS)
                    ->select([
                        'jobs.title',
                        'jobs.id as job_id',
                        'jobs.expires_at',
                        'jobs.salary',
                        'jobs.created_at',
                        'jobs.description',
                        'jobs.hiring_type',
                        'cities.cityname',
                        'regions.regname',
                    ])
                    ->groupBy('jobs.id')
                    ->paginate(10);

        return View::make('taskminator.WRKR_INVTS')
                ->with('jobs' , $invites);
    }

    public function ADDOWNSKILL(){
        $other_skills = array_map('trim', explode(',', Input::get('customskills')));
        foreach($other_skills as $os){
            if(strip_tags($os) != ""){
                CustomSkill::insert([
                    'created_by'        =>  Auth::user()->id,
                    'skill'             =>  strip_tags($os),
                    'created_at'        =>  date("Y:m:d H:i:s")
                ]);

                $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Added custom skill - '.strip_tags($os));
            }
        }
        return Redirect::back();
    }

    public function RMVCSTMSKLL($custom_skill_id){
        $skillName = CustomSkill::where('id', $custom_skill_id)->pluck('skill');
        CustomSkill::where('id', $custom_skill_id)->delete();
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Removed custom skill - '.$skillName);
        return Redirect::back();
    }

    public function jobSearch($keyword, $workDuration, $regionFIELD, $city, $categoryFIELD, $skill, $orderBy){
        if($keyword == 'NO_KW_INPT'){   $keyword = "";}

        $jobs = Job::join('users', 'users.id', '=', 'jobs.user_id')
                    ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                    ->join('regions', 'regions.regcode', '=', 'jobs.regcode')

                    ->leftJoin('custom_skills', 'custom_skills.company_job_id', '=', 'jobs.id')
                    ->orWhere('custom_skills.skill', 'LIKE', '%'.$keyword.'%')

                    ->orWhere('jobs.title', 'LIKE', '%'.$keyword.'%')
                    ->where('jobs.expired', false);

        if($workDuration != 'ALL'){     $jobs = $jobs->where('jobs.hiring_type', $workDuration);}
        if($regionFIELD != 'ALL'){      $jobs = $jobs->where('jobs.regcode', $regionFIELD);}
        if($city != 'ALL'){             $jobs = $jobs->where('jobs.citycode', $city);}
        if($categoryFIELD != 'ALL'){    $jobs = $jobs->where('jobs.skill_category_code', $categoryFIELD);}
        if($skill != 'ALL'){            $jobs = $jobs->where('jobs.skill_code', $skill);}

        $jobs = $jobs->orderBy('created_at', $orderBy)
                ->select([
                    'users.id as user_id',
                    'users.fullName',
                    'users.profilePic',
                    'jobs.title',
                    'jobs.id as job_id',
                    'jobs.expires_at',
                    'jobs.salary',
                    'jobs.created_at',
                    'jobs.description',
                    'jobs.hiring_type',
                    'cities.cityname',
                    'regions.regname',

                ])
                ->groupBy('jobs.id')
                ->paginate(10);

        $regions = Region::orderBy('regname', 'ASC')->get();
        $category = TaskCategory::orderBy('categoryname', 'ASC')->get();

        if($categoryFIELD != 'ALL'){
            $skills_OBJECTS = TaskItem::where('item_categorycode', $categoryFIELD)->orderBy('itemname', 'ASC')->get();
        }else{
            $skills_OBJECTS = NULL;
        }

        return View::make('taskminator.jobSearch')
                ->with('skills_OBJECTS', $skills_OBJECTS)
                ->with('jobs', $jobs)
                ->with('keyword', $keyword)
                ->with('workDuration', $workDuration)
                ->with('regionFIELD', $regionFIELD)
                ->with('city', $city)
                ->with('categoryFIELD', $categoryFIELD)
                ->with('skill', $skill)
                ->with('orderBy', $orderBy)
                ->with('category', $category)
                ->with('regions', $regions);
    }

    public function editDocuments(){
        $EXISTING_DOCUMENTS = $this->DOCUMENTS_GETEXISTINGTYPES(Auth::user()->id);
        $doc_types = DocumentType::orderBy('sys_doc_label', 'ASC')
            ->where('sys_doc_role', 'WORKER')
            ->where('sys_doc_disabled', false)
            ->whereNotIn('sys_doc_type', $EXISTING_DOCUMENTS)
            ->get();

        $user_docs = Document::leftJoin('document_types', 'document_types.sys_doc_type', '=', 'documents.type')
            ->where('documents.user_id', Auth::user()->id)
            ->select([
                'documents.id',
                'documents.user_id',
                'documents.created_at',
                'documents.path',
                'documents.docname',
                'documents.type',
                'documents.label',
                'document_types.sys_doc_label'
            ])
            ->orderBy('documents.created_at')
            ->paginate(10);

//        $user_docs = Document::get();
        return View::make('taskminator.editDocuments')
            ->with('prog', TaskminatorController::WORKER_profileProgress())
            ->with('user_docs', $user_docs)
            ->with('doc_types', $doc_types);
    }

    public function doUploadDocumentsWRKR(){
        $doc_file = Input::file('DOC_FILE');
        $doc_type = Input::get('DOC_TYPE');

        if(!isset($doc_file)){
            Session::flash('errorMsg', 'Please attach a document before uploading');
            return Redirect::back();
        }else{
            // FOR LOCALHOST
            $destinationPath = 'public/upload/documents/'.Auth::user()->confirmationCode.'_'.Auth::user()->id;

            // FOR LIVE SITE
            $destinationPath = 'upload/documents/'.Auth::user()->confirmationCode.'_'.Auth::user()->id;

            $doc_label = DocumentType::where('sys_doc_type', $doc_type)->pluck('sys_doc_label');
            $file_label = $doc_label.' - '.Auth::user()->fullName;
            $file_name = md5(uniqid(time(), true)).'.'.$doc_file->getClientOriginalExtension();

            $doc_check = Document::where('user_id', Auth::user()->id)
                ->where('docname', $file_name)
                ->where('label', $file_label)
                ->where('type', $doc_type)
                ->count();

            if($doc_check == 0){
                // INITIALIZE UPLOAD
                $INIT_UPLOAD = $doc_file->move('public/'.$destinationPath, $file_name);

                Document::insert([
                    'user_id'       =>  Auth::user()->id,
                    'docname'       =>  $file_name,
                    // PATH FOR LOCALHOST
                    // 'path'          =>  $destinationPath.'/'.$file_name,
                    // PATH FOR LIVE SITE
                    'path'          =>  'public/'.$destinationPath.'/'.$file_name,
                    'label'         =>  $file_label,
                    'type'          =>  $doc_type,
                    'created_at'    =>  date("Y:m:d H:i:s"),
                ]);

                Session::flash('successMsg', 'Document has been uploaded!');
                $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Uploaded document - '.$doc_label);
                return Redirect::back();
            }else{
                Session::flash('errorMsg', 'A document of this type has already been uploaded.');
                return Redirect::back();
            }
        }
    }

    public function DELETE_DOC($docID){
        $docName = Document::where('id', $docID)->pluck('label');
        Document::where('id', $docID)->delete();
        $this->INSERT_AUDIT_TRAIL(Auth::user()->id, 'Deleted document - '.$docName);
        return Redirect::back();
    }

    public function WRKR_HIRED(){
        $jobs = Job::join('job_hired_workers', 'jobs.id', '=', 'job_hired_workers.job_id')
                ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
                ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
                ->where('job_hired_workers.worker_id', Auth::user()->id)
                ->select([
                    'jobs.id',
                    'jobs.title',
                    'jobs.salary',
                    'jobs.expires_at',
                    'jobs.hiring_type',
                    'cities.cityname',
                    'regions.regname'
                ])
                ->paginate(10);

        return View::make('taskminator.WRKR_HIRED')
                ->with('jobs', $jobs);
    }

    public static function WORKER_profileProgress(){
        $check = '<i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;';
        $close = '<i style="color: #E74C3C; font-size: 1.2em" class="fa fa-close"></i>&nbsp;&nbsp;';

        $mobile = Contact::where('user_id', Auth::user()->id)->where('ctype', 'mobileNum')->pluck('content');
        $email = Contact::where('user_id', Auth::user()->id)->where('ctype', 'email')->pluck('content');

        $PASSPORT = Document::where('user_id', Auth::user()->id)->where('type', 'PASSPORT')->count();
        $NBI = Document::where('user_id', Auth::user()->id)->where('type', 'NBI')->count();
        $VOTERS_ID = Document::where('user_id', Auth::user()->id)->where('type', 'VOTERS_ID')->count();
        $TIN = Document::where('user_id', Auth::user()->id)->where('type', 'TIN_ID')->count();
        $exp = WorkerExperience::where('user_id', Auth::user()->id)->count();
        $edu = WorkerEducation::where('user_id', Auth::user()->id)->count();
        $skill_count = TaskminatorHasSkill::where('user_id', Auth::user()->id)->count() + CustomSkill::where('created_by', Auth::user()->id)->count();
        $doc_count = Document::where('user_id', Auth::user()->id)->count();
        $facebook = Contact::where('user_id', Auth::user()->id)->where('ctype', 'facebook')->pluck('content');
        $ARRAY = array();

        $reg = Region::where('regcode', Auth::user()->region)->pluck('regname');
        $cty = City::where('citycode', Auth::user()->city)->pluck('cityname');
        $prv = Province::where('provcode', Auth::user()->province)->pluck('provname');
        $bgy = Barangay::where('bgycode', Auth::user()->barangay)->pluck('bgyname');
        if(Auth::user()->address && $reg && $cty && $prv && $bgy){
            $full_address_flag = true;
        }else{
            $full_address_flag = false;
        }

        array_push($ARRAY, ['content'  => ((Auth::user()->fullName)             ? $check.'Full Name'                : $close.'Full Name'),              'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->birthdate)            ? $check.'Birthdate'                : $close.'Birthdate'),              'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->gender)               ? $check.'Gender'                   : $close.'Gender'),                 'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => (($full_address_flag)                 ? $check.'Address'                  : $close.'Address (Must have Region, City, Province and Barangay and Street Address)'),     'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => (($edu >= 3)                          ? $check.'Educational Background'   : $close.'Educational Background - Atleast 3 ('.$edu.' registered)'),   'url'    => '/editEducationalBackground']);
        array_push($ARRAY, ['content'  => (($exp >= 2)                          ? $check.'Relevant Experience'      : $close.'Relevant Experience - Atleast 2('.$exp.' registered)'),       'url'    => '/editExperience']);
        array_push($ARRAY, ['content'  => (($skill_count >= 4)                  ? $check.'Skills'                   : $close.'Skills (At least 4 System/Custom Skill) ('.$skill_count.' registered)'),    'url'    => '/editSkillInfo']);
        array_push($ARRAY, ['content'  => (($mobile)                            ? $check.'Mobile Number'            : $close.'Mobile Number'),          'url'    => '/editContactInfo']);
        array_push($ARRAY, ['content'  => (($email)                             ? $check.'Email'                    : $close.'Email'),                  'url'    => '/editContactInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->marital_status)       ? $check.'Civil Status'           : $close.'Civil Status'),         'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->profilePic)           ? $check.'Profile Picture'          : $close.'Profile Picture'),        'url'    => '/editProfile']);
        array_push($ARRAY, ['content'  => (($doc_count >= 2)                    ? $check.'Supporting Documents'     : $close.'Supporting Documents - Atleast 2 ('.$doc_count.' registered)'), 'url'    => '/editDocuments']);
        array_push($ARRAY, ['content'  => (($facebook)                          ? $check.'Facebook'                 : $close.'Facebook'),               'url'    => '/editPersonalInfo']);
        return $ARRAY;
    }

    public function wprofileProgress(){
        $check = '<i style="color: #1ABC9C; font-size: 1.2em" class="fa fa-check-circle"></i>&nbsp;&nbsp;';
        $close = '<i style="color: #E74C3C; font-size: 1.2em" class="fa fa-close"></i>&nbsp;&nbsp;';

        $mobile = Contact::where('user_id', Auth::user()->id)->where('ctype', 'mobileNum')->pluck('content');
        $email = Contact::where('user_id', Auth::user()->id)->where('ctype', 'email')->pluck('content');

        $PASSPORT = Document::where('user_id', Auth::user()->id)->where('type', 'PASSPORT')->count();
        $NBI = Document::where('user_id', Auth::user()->id)->where('type', 'NBI')->count();
        $VOTERS_ID = Document::where('user_id', Auth::user()->id)->where('type', 'VOTERS_ID')->count();
        $TIN = Document::where('user_id', Auth::user()->id)->where('type', 'TIN_ID')->count();
        $exp = WorkerExperience::where('user_id', Auth::user()->id)->count();
        $edu = WorkerEducation::where('user_id', Auth::user()->id)->count();
        $skill_count = TaskminatorHasSkill::where('user_id', Auth::user()->id)->count() + CustomSkill::where('created_by', Auth::user()->id)->count();
        $doc_count = Document::where('user_id', Auth::user()->id)->count();
        $facebook = Contact::where('user_id', Auth::user()->id)->where('ctype', 'facebook')->pluck('content');
        $ARRAY = array();

        array_push($ARRAY, ['content'  => ((Auth::user()->fullName)             ? $check.'Full Name'                : $close.'Full Name'),              'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->birthdate)            ? $check.'Birthdate'                : $close.'Birthdate'),              'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->gender)               ? $check.'Gender'                   : $close.'Gender'),                 'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->address)              ? $check.'Address'                  : $close.'Address'),                'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => (($edu >= 3)                          ? $check.'Educational Background'   : $close.'Educational Background - Atleast 3 ('.$edu.' registered)'), 'url'    => '/editEducationalBackground']);
        array_push($ARRAY, ['content'  => (($exp >= 2)                          ? $check.'Relevant Experience'      : $close.'Relevant Experience - Atleast 2('.$exp.' registered)'),    'url'    => '/editExperience']);
        array_push($ARRAY, ['content'  => (($skill_count >= 4)                  ? $check.'Skills (At least 4 System/Custom Skill)'      : $close.'Skills (At least 4 System/Custom Skill) ('.$skill_count.' registered)'),    'url'    => '/editSkillInfo']);
        array_push($ARRAY, ['content'  => (($mobile)                            ? $check.'Mobile Number'            : $close.'Mobile Number'),          'url'    => '/editContactInfo']);
        array_push($ARRAY, ['content'  => (($email)                             ? $check.'Email'                    : $close.'Email'),                  'url'    => '/editContactInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->marital_status)       ? $check.'Civil Status'           : $close.'Civil Status'),         'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->profilePic)           ? $check.'Profile Picture'          : $close.'Profile Picture'),        'url'    => '/editProfile']);
        array_push($ARRAY, ['content'  => (($doc_count >= 2)                    ? $check.'Supporting Documents'     : $close.'Supporting Documents - Atleast 2 ('.$doc_count.' registered)'), 'url'    => '/editDocuments']);
        array_push($ARRAY, ['content'  => (($facebook)                          ? $check.'Facebook'                 : $close.'Facebook'),               'url'    => '/editPersonalInfo']);

        /*
        array_push($ARRAY, ['content'  => ((Auth::user()->firstName)            ? $check.'First Name'               : $close.'First Name'),             'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->lastName)             ? $check.'Last Name'                : $close.'Last Name'),              'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->region)               ? $check.'Region'                   : $close.'Region'),                 'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->province)             ? $check.'Province'                 : $close.'Province'),               'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->barangay)             ? $check.'Barangay'                 : $close.'Barangay'),               'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->city)                 ? $check.'City'                     : $close.'City'),                   'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->birthdate)            ? $check.'Birthdate'                : $close.'Birthdate'),              'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->marital_status)       ? $check.'Civil Status'           : $close.'Civil Status'),         'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->profilePic)           ? $check.'Profile Picture'          : $close.'Profile Picture'),        'url'    => '/editProfile']);
        array_push($ARRAY, ['content'  => ((Auth::user()->educationalBackground)? $check.'Educational Background'   : $close.'Educational Background'), 'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => ((Auth::user()->experience)           ? $check.'Experience'               : $close.'Experience'),             'url'    => '/editPersonalInfo']);
        array_push($ARRAY, ['content'  => (($mobile)                            ? $check.'Mobile Number'            : $close.'Mobile Number'),          'url'    => '/editContactInfo']);
        array_push($ARRAY, ['content'  => (($email)                             ? $check.'Email'                    : $close.'Email'),                  'url'    => '/editContactInfo']);

        if(TaskminatorHasSkill::where('user_id', Auth::user()->id)->count() > 0 || CustomSkill::where('created_by', Auth::user()->id)->count() > 0){
            array_push($ARRAY, ['content'  => $check.'Skill / Custom Skill', 'url'    => '/editSkillInfo']);
        }else{
            array_push($ARRAY, ['content'  => $close.'Skill / Custom Skill', 'url'    => '/editSkillInfo']);
        }

        if($PASSPORT > 0 || $NBI > 0 || $VOTERS_ID > 0 || $TIN > 0){
            array_push($ARRAY, ['content'  => $check.'Supporting Documents (NBI, Passport, Voters ID, or TIN)', 'url'    => '/editDocuments']);
        }else{
            array_push($ARRAY, ['content'  => $close.'Supporting Documents (NBI, Passport, Voters ID, or TIN)', 'url'    => '/editDocuments']);
        }
        */
        return View::make('wprofileProgress')
            ->with('reqs', $ARRAY);
    }

    public function editEducationalBackground(){
        return View::make('taskminator.editEducationalBackground')
            ->with('prog', TaskminatorController::WORKER_profileProgress())
            ->with('educs', WorkerEducation::where('user_id', Auth::user()->id)->get());
    }

    public function doEditEducationalBackground(){
        if(Input::has('course')){
            WorkerEducation::insert([
                'user_id'       =>  Auth::user()->id,
                'course_major'  =>  Input::get('course'),
                'level'         =>  Input::get('level'),
                'school_name'   =>  Input::get('school_name'),
                'school_year'   =>  Input::get('school_year'),
                'awards'        =>  Input::get('awards'),
                'created_at'    =>  Carbon::now()
            ]);
        }else{
            WorkerEducation::insert([
                'user_id'       =>  Auth::user()->id,
                'level'         =>  Input::get('level'),
                'school_name'   =>  Input::get('school_name'),
                'school_year'   =>  Input::get('school_year'),
                'awards'        =>  Input::get('awards'),
                'created_at'    =>  Carbon::now()
            ]);
        }

        Session::flash('successMsg', 'Educational Information Successfully Added!');
        return Redirect::back();
    }

    public function deleteEduc($educ_id){
        WorkerEducation::where('id', $educ_id)->delete();
        return Redirect::back();
    }

    public function editEduc($educ_id){
        return View::make('taskminator.editEduc')
            ->with('e', WorkerEducation::where('id', $educ_id)->first());
    }

    public function doEditEduc(){
        if(Input::has('course')){
            WorkerEducation::where('id', Input::get('educ_id'))->update([
                'course_major'  =>  Input::get('course'),
                'level'         =>  Input::get('level'),
                'school_name'   =>  Input::get('school_name'),
                'school_year'   =>  Input::get('school_year'),
                'awards'        =>  Input::get('awards'),
                'created_at'    =>  Carbon::now()
            ]);

        }else{
            WorkerEducation::where('id', Input::get('educ_id'))->update([
                'level'         =>  Input::get('level'),
                'school_name'   =>  Input::get('school_name'),
                'school_year'   =>  Input::get('school_year'),
                'awards'        =>  Input::get('awards'),
                'updated_at'    =>  Carbon::now()
            ]);
        }

        Session::flash('successMsg', 'Educational Information Successfully Edited!');
        return Redirect::back();
    }

    public function editExperience(){
        return View::make('taskminator.editExperience')
            ->with('prog', TaskminatorController::WORKER_profileProgress())
            ->with('exps', WorkerExperience::where('user_id', Auth::user()->id)->get());
    }

    public function doEditExperience(){
        WorkerExperience::insert([
            'user_id'           =>  Auth::user()->id,
            'company_name'      =>  Input::get('company_name'),
            'position'          =>  Input::get('position'),
            'location'          =>  Input::get('location'),
            'time_period'       =>  Input::get('time_period'),
            'roles_and_resp'    =>  Input::get('roles_and_resp'),
            'created_at'        =>  Carbon::now()
        ]);

        return Redirect::back();
    }

    public function deleteExp($exp_id){
        WorkerExperience::where('id', $exp_id)->delete();
        return Redirect::back();
    }

    public function editExp($exp_id){
        return View::make('taskminator.editExp')
            ->with('e', WorkerExperience::where('id', $exp_id)->first());
    }

    public function doEditExp(){
        WorkerExperience::where('id', Input::get('exp_id'))->update([
            'company_name'      =>  Input::get('company_name'),
            'position'          =>  Input::get('position'),
            'location'          =>  Input::get('location'),
            'time_period'       =>  Input::get('time_period'),
            'roles_and_resp'    =>  Input::get('roles_and_resp'),
            'updated_at'        =>  Carbon::now()
        ]);

        return Redirect::back();
    }

    public function certifications(){
        return View::make('taskminator.certifications')
            ->with('prog', TaskminatorController::WORKER_profileProgress())
            ->with('certs', WorkerCertification::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10));
    }

    public function doAddCertifications(){
        WorkerCertification::insert([
            'user_id'           =>  Auth::user()->id,
            'title'             =>  Input::get('certificate_name'),
            'date'              =>  Input::get('date'),
            'organizer_company' =>  Input::get('organizer_company'),
            'created_at'        =>  Carbon::now()
        ]);

        Session::flash('successMsg', 'Certification has been successfully added');
        return Redirect::back();
    }

    public function editCertification($cert_id){
        return View::make('taskminator.editCertification')
            ->with('cert', WorkerCertification::where('id', $cert_id)->first());
    }

    public function doEditCertification(){
        WorkerCertification::where('id', Input::get('cert_id'))->update([
            'user_id'           =>  Auth::user()->id,
            'title'             =>  Input::get('certificate_name'),
            'date'              =>  Input::get('date'),
            'organizer_company' =>  Input::get('organizer_company'),
            'created_at'        =>  Carbon::now()
        ]);

        Session::flash('successMsg', 'Certification has been successfully edited');
        return Redirect::back();
    }
}
