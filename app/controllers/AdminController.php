<?php

use Carbon\Carbon;
class AdminController extends \BaseController {

    public function userList(){
        return View::make('admin.userlist')
                ->with('users', User::orderBy('name')->get());
    }

    public function userListTaskminators(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')

                    // join ROLES table
                    ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                    // join RATINGS table
                    ->leftJoin('ratings', 'ratings.taskminator_id', '=', 'users.id')
                    // join region/city/barangay
                    ->leftJoin('regions', 'regions.regcode', '=', 'users.region')
                    ->leftJoin('cities', 'cities.citycode', '=', 'users.city')
                    ->leftJoin('barangays', 'barangays.bgycode', '=', 'users.barangay')

                    ->where('user_has_role.role_id', '=', '2')
                    ->whereNotIn('users.status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION'])
                    ->select([
                        'users.id',
                        'users.fullName',
                        'users.status',
                        'users.profilePic',
                        'users.username',
                        DB::raw('AVG(ratings.stars) as avg_stars'),
                        'users.created_at',
                        'regions.regname',
                        'cities.cityname',
                        'barangays.bgyname',
                    ])
                    ->orderBy('users.created_at', 'DESC')
                    ->groupBy('users.id')
                    ->paginate(10);

        // return View::make('admin.userlist_taskminators')
        //         ->with('users', $userList);

        return View::make('admin.index')
            ->with('users', $userList);
    }

    public function userListClientIndi(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])
            ->paginate(10);

        return View::make('admin.userlist_client_indi')
            ->with('users', $userList);
    }

    public function userListClientComp(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])
            ->paginate(10   );

        return View::make('admin.userlist_client_comp')
            ->with('users', $userList);
    }

    public function adminActivate($id){
        $query = User::where('id', $id);

        $query->update(array(
            'status'    =>  'ACTIVATED'
        ));

        Session::flash('successMsg', 'User has been activated');
        return Redirect::back();
    }

    public function adminDeactivate($id){
        $query = User::where('id', $id);
        $query->update(array(
            'status'    =>  'ADMIN_DEACTIVATED'
        ));

        Session::flash('successMsg', 'User has been deactivated');
        return Redirect::back();
    }

    public function viewUserProfile($id){
        if(UserHasRole::where('user_id', $id)->pluck('role_id') == '1'){
            Auth::logout();
            return Redirect::to('/');
        }else if(UserHasRole::where('user_id', $id)->pluck('role_id') == '2'){
            $maxStars = Rate::where('taskminator_id', $id)->max('stars');
            $starCount = Rate::where('taskminator_id', $id)->count();

            if($maxStars != 0 && $starCount != 0){
                $starRatings = $maxStars / $starCount;
            }else{
                $starRatings = 0;
            }

            return View::make('admin.viewUserProfile_tskmntr')
                ->with('certs', WorkerCertification::where('user_id', $id)->get())
                ->with('edu', WorkerEducation::where('user_id', $id)->get())
                ->with('exp', WorkerExperience::where('user_id', $id)->get())
                ->with('user', User::where('id', $id)->first())
                ->with('contactpersons', ContactPerson::where('user_id', $id)->get())
                ->with('keyskills', Photo::where('user_id', $id)->where('type', 'KEYSKILLS')->get())
                ->with('photos', Photo::where('user_id', $id)->whereNotIn('type', ['KEYSKILLS', 'DOCUMENT'])->get())
                ->with('docs', Document::where('user_id', $id)->get())
                ->with('miscDocs', Document::where('user_id', $id)->whereNotIn('type', ['KEYSKILLS', 'DOCUMENT'])->get())
                ->with('ratings', Rate::where('taskminator_id', $id)->count())
                ->with('starRatings', $starRatings)
                ->with('skills', TaskminatorHasSkill::where('user_id', $id)->get());
        }else if(UserHasRole::where('user_id', $id)->pluck('role_id') == '3'){
            return View::make('admin.viewUserProfile_cindi')
                ->with('user', User::where('id', $id)->first())
                ->with('contactpersons', ContactPerson::where('user_id', $id)->get())
                ->with('docs', Document::where('user_id', $id)->get())
                ->with('photos', Document::where('user_id', $id));
        }else if(UserHasRole::where('user_id', $id)->pluck('role_id') == '4'){
            return View::make('admin.viewUserProfile_ccomp')
                ->with('user', User::where('id', $id)->first())
                ->with('keyperson', ContactPerson::where('user_id', $id)->get())
                ->with('photos', Photo::where('user_id', $id)->get())
                ->with('docs', Document::where('user_id', $id)->get())
                ->with('miscDocs', Document::where('user_id', $id)->whereNotIn('type', ['KEYSKILLS', 'DOCUMENT'])->get());
        }else{
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function pendingTskmntr(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '2')
            ->where('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('pageTitle', 'Pending Taskminator Accounts')
            ->with('formUrl', '/pendingTskmntr=search');
    }

    public function pendingTskmntrSearch($searchBy, $searchWord){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '2')
            ->where('users.status', ['PRE_ACTIVATED']);

        if($searchBy != '0'){
            $searchByQuery = 'users.'.$searchBy;
            $searchWordQuery = 'users.'.$searchWord;

            $userList = $userList->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
        }

        $userList = $userList->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('pageTitle', 'Pending Taskminator Accounts')
            ->with('formUrl', '/pendingTskmntr=search');
    }

    public function pendingClientIndi(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->where('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.status',
            ])->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('pageTitle', 'Pending Client (Individual) Accounts')
            ->with('formUrl', '/pendingClientIndi=search');
    }

    public function pendingClientIndiSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->where('users.status', 'PRE_ACTIVATED');

        if($searchBy != '0'){
            $searchByQuery = 'users.'.$searchBy;
            $searchWordQuery = 'users.'.$searchWord;

            $query = $query->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('pageTitle', 'Pending Client (Individual) Accounts')
            ->with('users', $query)
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('formUrl', '/pendingClientIndi=search');
    }

    public function pendingClientComp(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->where('users.status', ['PRE_ACTIVATED'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('users', $userList)
            ->with('pageTitle', 'Pending Client (Company) Accounts')
            ->with('formUrl', '/pendingClientComp=search');
    }

    public function pendingClientCompSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->where('users.status', 'PRE_ACTIVATED');

        if($searchBy != '0'){
            $searchByQuery = 'users.'.$searchBy;
            $searchWordQuery = 'users.'.$searchWord;

            $query = $query->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])->paginate(10);

        return View::make('admin.viewUsers_pending')
            ->with('pageTitle', 'Pending Client (Company) Accounts')
            ->with('users', $query)
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('formUrl', '/pendingClientComp=search');
    }

//    public function categoryAndSkills(){
    public function skills(){
        return View::make('admin.categoryAndSkills')
            ->with('taskCategory', TaskCategory::orderBy('categoryname', 'ASC')->paginate(10));
    }

    public function auditTrail($user_id){
        return View::make('admin.auditTrail')
                ->with('trails', AuditTrail::where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(10))
                ->with('user', User::where('id', $user_id)->first());
    }
    /*
    public function auditTrail($role){
        $query = User::join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
                     ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                    ->leftJoin('regions', 'regions.regcode', '=', 'users.region')
                    ->leftJoin('cities', 'cities.citycode', '=', 'users.city');

        switch($role){
            case 'workers'  :
                $query->where('roles.role', 'TASKMINATOR');
                break;
            case 'companies'  :
                $query->whereIn('roles.role', ['CLIENT_IND', 'CLIENT_CMP']);
                break;
            default :
                return Redirect::back()->with('errorMsg', 'UNKNOWN REQUEST');
        }

        $query->select(array(
            'users.id',
            'users.fullName',
            'users.status',
            'users.created_at',
            'cities.cityname',
            'regions.regname',
        ));

        return View::make('admin.AT_userList')->with('users', $query->paginate(10));
    }

    public function userAuditTrail($id){
        return View::make('admin.userTrail')
            ->with('user', User::where('id', $id)->first())
            ->with('trails', AuditTrail::where('user_id', $id)->paginate(10));
    }
    */

    public function taskDetails($taskid){
        $taskQuery = Task::where('id', $taskid)->first();
        $taskminator = null;

        if($taskQuery->status == 'ONGOING' || $taskQuery->status == 'COMPLETE'){
            $taskminator = User::join('task_has_taskminator', 'task_has_taskminator.taskminator_id', '=', 'users.id')
                            ->where('task_has_taskminator.task_id', $taskQuery->id)
                            ->select([
                                'users.fullName',
                                'users.id',
                                'task_has_taskminator.created_at'
                            ])
                            ->first();
        }

        return View::make('admin.taskDetails')
                ->with('task', $taskQuery)
                ->with('client', User::where('id', $taskQuery->user_id)->first())
                ->with('taskminator', $taskminator);
    }

    public function viewRatings($tskmntrId){
        return View::make('admin.ratings')
                ->with('ratings', Rate::where('ratings.taskminator_id', $tskmntrId)->get())
                ->with('tskmntr', User::where('id', $tskmntrId)->first());
    }

    public function index(){
        if(!AdminController::IF_ADMIN_IS(['SUPER_ADMINISTRATOR'], Auth::user()->id)){
            return View::make('admin.subadmin.dashboard')
                ->with('roles', $this->GET_USER_ADMIN_ROLES(Auth::user()->id));
        }else{
            $users = User::leftJoin('regions', 'regions.regcode', '=', 'users.region')
                ->leftJoin('cities', 'cities.citycode', '=', 'users.city')
                ->whereIn('users.status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION'])
                ->orderBy('users.created_at', 'ASC')
                ->select([
                    'users.id as userID',
                    'users.username',
                    'users.created_at',
                    'users.fullName',
                    'users.total_profile_progress',
                    'cities.cityname',
                    'regions.regname',
                ])
                ->groupBy('users.id')
                ->paginate(10);

            return View::make('admin.taskList')
                ->with('pendingCount', $this->countPendingUsers())
                ->with('pendingUsers', $users)
                ->with('pageName', 'Proveek Admin | Dashboard')
                ->with('formUrl', '/pendingUserSearch');
        }
    }

    public function taskListBiddingSearch($searchBy, $searchWord, $workTimeValue, $status){
        $query = Task::where('hiringType', 'BIDDING')->orderBy('created_at', 'ASC');

        if($searchBy == 'name'){
            if($searchWord != ''){
                $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
            }
        }else if($searchBy == 'workTime'){
            $query = $query->where($searchBy, $workTimeValue);
            if($searchWord != ''){
                $query = $query->where('name', 'LIKE', '%'.$searchWord.'%');
            }
        }

        if($status != 'ALL'){
            $query = $query->where('status', $status);
        }

//        return View::make('admin.taskList')
        return View::make('admin.jobAds')
            ->with('tasks', $query->paginate(10))
            ->with('pageName', 'Bidding Tasks')
            ->with('formUrl', '/taskListBidding=search')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('workTimeValue', $workTimeValue)
            ->with('status', $status);
    }

    public function taskListAuto(){
        return View::make('admin.taskList')
            ->with('tasks', Task::where('hiringType', 'AUTOMATIC')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Automatic Tasks')
            ->with('formUrl', '/taskListAuto=search');
    }

    public function taskListAutoSearch($searchBy, $searchWord, $workTimeValue, $status){
        $query = Task::where('hiringType', 'AUTOMATIC')->orderBy('created_at', 'ASC');

        if($searchBy == 'name'){
            if($searchWord != ''){
                $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
            }
        }else if($searchBy == 'workTime'){
            $query = $query->where($searchBy, $workTimeValue);
            if($searchWord != ''){
                $query = $query->where('name', 'LIKE', '%'.$searchWord.'%');
            }
        }

        if($status != 'ALL'){
            $query = $query->where('status', $status);
        }

        return View::make('admin.taskList')
            ->with('tasks', $query->paginate(10))
            ->with('pageName', 'Automatic Tasks')
            ->with('formUrl', '/taskListAuto=search')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('workTimeValue', $workTimeValue)
            ->with('status', $status);
    }

    public function taskListDirect(){
        return View::make('admin.taskList')
            ->with('tasks', Task::where('hiringType', 'DIRECT')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Direct Tasks')
            ->with('formUrl', '/taskListDirect=search');
    }

    public function taskListDirectSearch($searchBy, $searchWord, $workTimeValue, $status){
        $query = Task::where('hiringType', 'DIRECT')->orderBy('created_at', 'ASC');

        if($searchBy == 'name'){
            if($searchWord != ''){
                $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
            }
        }else if($searchBy == 'workTime'){
            $query = $query->where($searchBy, $workTimeValue);
            if($searchWord != ''){
                $query = $query->where('name', 'LIKE', '%'.$searchWord.'%');
            }
        }

        if($status != 'ALL'){
            $query = $query->where('status', $status);
        }

        return View::make('admin.taskList')
            ->with('tasks', $query->paginate(10))
            ->with('pageName', 'Direct Tasks')
            ->with('formUrl', '/taskListDirect=search')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('workTimeValue', $workTimeValue)
            ->with('status', $status);
    }


    public function searchWorker($acctStatus, $rating, $hiring, $orderBy, $keyword, $checkout){
        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '2');

        if($keyword != 'NONE'){
            $users = $users->where('users.username', 'LIKE', '%'.$keyword.'%')
                ->orWhere('users.fullName', 'LIKE', '%'.$keyword.'%');
        }else{
            $keyword = null;
        }

        if($acctStatus != 'ALL'){
            $users = $users->where('users.status', $acctStatus);
        }

        if($checkout != 'ALL'){
            $users_checked_out_ID = $this->ADMIN_GET_CHECKEDOUT_WORKERS();
            if($checkout){
                // checked out
                $users = $users->whereIn('users.id', $users_checked_out_ID);
            }else{
                // not checked out
                $users = $users->whereNotIn('users.id', $users_checked_out_ID);
            }
        }

        $users = $users
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
                'users.created_at',
            ])
            ->orderBy('users.created_at', $orderBy)
            ->groupBy('users.id')
            ->paginate(10);

        return View::make('admin.index')
            ->with('users', $users)
            ->with('rating', $rating)
            ->with('orderBy', $orderBy)
            ->with('acctStatus', $acctStatus)
            ->with('keyword', $keyword);

//        NOTE : whereNotIn clause inserted multiple times.
//        bugs occur because of conditional additions of queries
//        to adapt to  multiple search parameters
//        - Jan Sarmiento
        /*
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
                    ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
                    ->leftJoin('ratings', 'ratings.taskminator_id', '=', 'users.id')
                    ->where('user_has_role.role_id', '2')
                    ->whereNotIn('users.status', ['PRE_ACTIVATED']);

        if($keyword != 'NONE'){
            $query->where('users.fullName', 'LIKE', '%'.$keyword.'%')
                ->orWhere('users.username', 'LIKE', '%'.$keyword.'%')
                ->where('user_has_role.role_id', '2')
                ->whereNotIn('users.status', ['PRE_ACTIVATED']);
        }else{
            $keyword = null;
        }


        $query->whereNotIn('users.status', ['PRE_ACTIVATED'])
            ->where('users.status', $acctStatus)
            ->orderBy('users.created_at', $orderBy)
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
                'users.created_at',
            ])
            ->groupBy('users.id');

        return View::make('admin.index')
                ->with('users', $query->paginate(10))
                ->with('rating', $rating)
                ->with('orderBy', $orderBy)
                ->with('acctStatus', $acctStatus)
                ->with('keyword', $keyword);
        */
    }

//    public function adminTskmntrSearch(){
//        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
//            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
//            ->where('user_has_role.role_id', '2')
//            ->whereNotIn('users.status', ['PRE_ACTIVATED']);
//
//        if(Input::get('searchBy') != '0'){
//            if(Input::get('searchWord') != ''){
//                $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
//            }
//        }
//
//        $query = $query->orderBy('users.created_at', 'DESC')
//                    ->select([
//                        'users.id',
//                        'users.fullName',
//                        'users.status',
//                        'users.username',
//                    ]);
//        return View::make('admin.userlist_taskminators')
//                ->with('users', $query->get())
//                ->with('searchBy', Input::get('searchBy'))
//                ->with('searchWord', Input::get('searchWord'));
//    }

    public function adminClientIndiSearch(){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '3')
            ->whereNotIn('users.status', ['PRE_ACTIVATED']);

        if(Input::get('searchBy') != '0'){
            if(Input::get('searchWord') != ''){
                $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ]);

        return View::make('admin.userlist_client_indi')
            ->with('users', $query->get())
            ->with('searchBy', Input::get('searchBy'))
            ->with('searchWord', Input::get('searchWord'));
    }

    public function adminClientCompSearch(){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->where('user_has_role.role_id', '4')
            ->whereNotIn('users.status', ['PRE_ACTIVATED']);
//            ->orderBy('users.created_at', 'DESC')
//            ->select([
//                'users.id',
//                'users.fullName',
//                'users.username',
//                'users.status',
//            ])->get();

        if(Input::get('searchBy') != '0'){
            if(Input::get('searchWord') != ''){
                $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }

        $query = $query->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ]);

        return View::make('admin.userlist_client_comp')
            ->with('users', $query->get())
            ->with('searchBy', Input::get('searchBy'))
            ->with('searchWord', Input::get('searchWord'));
    }

//    public function viewUsersTasks($clientid){
//        return View::make('admin.clientTask')
//                ->with('tasks', Task::where('user_id', $clientid)->orderBy('created_at', 'DESC')->paginate(10))
//                ->with('client', User::where('id', $clientid)->first());
//    }

    public function viewUsersTasksSearch(){
        $query = Task::where('user_id', Input::get('clientid'));

        if(Input::get('hiringType') != 'ALL'){
            $query = $query->where('hiringType', Input::get('hiringType'));
        }

        if(Input::get('searchBy') == 'name'){
            if(Input::get('searchWord') != ''){
                $query = $query->where(Input::get('searchBy'), 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }else if(Input::get('searchBy') == 'workTime'){
            $query = $query->where(Input::get('searchBy'), Input::get('workTimeValue'));
            if(Input::get('searchWord') != ''){
                $query = $query->where('name', 'LIKE', '%'.Input::get('searchWord').'%');
            }
        }

        if(Input::get('status') != 'ALL'){
            $query = $query->where('status', Input::get('status'));
        }

        return View::make('admin.clientTask')
            ->with('tasks', $query->get())
            ->with('client', User::where('id', Input::get('clientid'))->first())
            ->with('searchBy', Input::get('searchBy'))
            ->with('workTimeValue', Input::get('workTimeValue'))
            ->with('hiringType', Input::get('hiringType'));
    }

    public function userListTaskminatorsSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
                    ->where('users.status', 'ACTIVATED')
                    ->where('user_has_role.role_id', '2');

        if($searchBy != '0'){
            $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
        }

        return View::make('admin.index')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('users', $query->orderBy('created_at', 'ASC')->paginate(10));
    }

    public function userListClientIndiSearch($keyword, $status, $accountType, $orderBy, $searchBy, $region, $city, $province){
        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->leftJoin('cities', 'cities.citycode', '=', 'users.city')
            ->leftJoin('provinces', 'provinces.provcode', '=', 'users.province')
            ->leftJoin('regions', 'regions.regcode', '=', 'users.region')
            ->whereIn('user_has_role.role_id', [3, 4]);
        $cities = [];
        $regions = Region::get();
        $provinces = [];

        if($keyword != 'false'){
            $users = $users->where('users.'.$searchBy, 'LIKE', '%'.$keyword.'%');
        }
        if($status != 'false'){
            $users = $users->where('users.status', $status);
        }
        if($accountType != 'false'){
            $users = $users->join('user_subscriptions', 'user_subscriptions.id', '=', 'users.accountType')
                ->join('system_subscriptions', 'system_subscriptions.id', '=', 'user_subscriptions.system_subscription_id')
                ->where('system_subscriptions.subscription_label', $accountType);
        }
        if($region != 'false'){
            $users = $users->where('users.region', $region);
            $cities = City::where('regcode', $region)->get();
            $provinces = Province::where('regcode', $region)->get();
        }
        if($city != 'false'){
            $users = $users->where('users.city', $city);
        }
        if($province != 'false'){
            $users = $users->where('users.province', $province);
            $cities = City::where('provcode', $province)->get();
        }
        $users = $users->orderBy('users.created_at', $orderBy)->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.profilePic',
                'users.status',
                'users.created_at',
                'cities.cityname',
                'regions.regname',
            ])
            ->groupBy('users.id')
            ->paginate(10);

        return View::make('admin.userlist_client_indi')
            ->with('cities', $cities)
            ->with('regions', $regions)
            ->with('provinces', $provinces)
            ->with('cmpSearch_Region', $region)
            ->with('cmpSearch_City', $city)
            ->with('cmpSearch_Province', $province)
            ->with('keyword', $keyword)
            ->with('acct_status', $status)
            ->with('adminCMP_accountType', $accountType)
            ->with('orderBy', $orderBy)
            ->with('adminCMP_SrchBy', $searchBy)
            ->with('subs', SystemSubscription::orderBy('id', 'ASC')->get())
            ->with('users', $users);
    }

    public function userListClientCompSearch($searchBy, $searchWord){
        $query = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')->where('users.status', 'ACTIVATED')->where('user_has_role.role_id', '4');

        if($searchBy != '0'){
            $query = $query->where($searchBy, 'LIKE', '%'.$searchWord.'%');
        }

        return View::make('admin.userlist_client_comp')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('users', $query->orderBy('fullName', 'ASC')->paginate(10));
    }

    /*
    public function newSkill(){
        if(strlen(trim(Input::get('newSkillInput'))) == 0){
            Session::flash('errorm', 'New skill cannot be empty');
            return Redirect::back();
        }else if(Input::get('newSkillInput') == ''){
            Session::flash('errorm', 'New skill cannot be empty');
            return Redirect::back();
        }

        if(Input::get('category') == ''){
            Session::flash('errorm', 'Please select a category');
            return Redirect::back();
        }

        if(TaskCategory::where('categorycode', Input::get('category'))->count() == 0){
            Session::flash('errorm', 'Please select a valid category');
            return Redirect::back();
        }
        $maxSkillCode = str_replace(Input::get('category'), '', TaskItem::where('item_categorycode', Input::get('category'))->max('itemcode'));
        $maxSkillCode = ++$maxSkillCode;
        $maxSkillCode = str_pad($maxSkillCode, 3, '0', STR_PAD_LEFT);

        TaskItem::insert(array(
            'item_categorycode'     =>  Input::get('category'),
            'itemname'              =>  Input::get('newSkillInput'),
            'itemcode'              =>  Input::get('category').''.$maxSkillCode
        ));

        Session::flash('succmsg', 'Skill '.Input::get('newSkillInput').' has been successfully added.');
        return Redirect::to('/skills');
    }

    public function newCategory(){
        if(Input::get('newCategoryInput') == ''){
            return Redirect::back()->with('errorm', 'Please input a valid category name');
        }

        $maxCatCode = TaskCategory::whereNotIn('categoryname', ['Others'])->max('categorycode');
        $maxCatCode = ++$maxCatCode;
        $maxCatCode = str_pad($maxCatCode, 3, '0', STR_PAD_LEFT);

        TaskCategory::insert(array(
            'categoryname'      =>  Input::get('newCategoryInput'),
            'categorycode'      =>  $maxCatCode
        ));

        return Redirect::to('/skills')->with('succmsg', 'New category is successfully added');
    }
    */

    public function deleteCategory($categorycode){
        TaskCategory::where('categorycode', $categorycode)->delete();
        TaskItem::where('item_categorycode', $categorycode)->delete();

        return Redirect::back()->with('successMsg', 'Category has been successfully deleted');
    }

    public function deleteSkill($skillcode){
        TaskItem::where('itemcode', $skillcode)->delete();
        return Redirect::back()->with('successMsg', 'Skill has been successfully deleted');
    }

    public function cms(){
        return View::make('admin.cms')
            ->with('tasks', Task::where('hiringType', 'BIDDING')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('pageName', 'Proveek Admin | Content Management System')
            ->with('formUrl', '/taskListBidding=search');
    }

    public function jobAds($adType){
        switch($adType){
            case 'INDIVIDUAL' :
                break;
            case 'FEATURED' :
                break;
            case 'HIRING' :
                break;
            case 'REFERRAL' :
                break;
        }

        return View::make('admin.jobAds')
            ->with('pageName', 'Proveek | Job Ads - '.$adType)
            ->with('pageTitle', 'Proveek | Job Ads - '.$adType)
            ->with('tasks', Task::where('hiringType', 'BIDDING')->orderBy('created_at', 'ASC')->paginate(10))
            ->with('formUrl', '/taskListBidding=search');
    }

    public function pendingUserSearch($searchBy, $searchUserType, $searchWord){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->whereIn('users.status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION']);

        if($searchUserType != 'ALL'){
            $userList->where('user_has_role.role_id', $searchUserType);
        }

        if($searchBy != 'ALL'){
            $searchByQuery = 'users.'.$searchBy;
//            $searchWordQuery = 'users.'.$searchWord;
//            $userList = $userList->where($searchByQuery, 'LIKE', '%'.$searchWordQuery.'%');
            $userList = $userList->where($searchByQuery, 'LIKE', '%'.$searchWord.'%');
        }

        $userList = $userList->orderBy('users.created_at', 'ASC')
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.taskList')
            ->with('searchBy', $searchBy)
            ->with('searchWord', $searchWord)
            ->with('searchUserType', $searchUserType)
            ->with('pendingUsers', $userList)
            ->with('pageName', 'Proveek Admin | Dashboard')
            ->with('formUrl', '/pendingUserSearch');

//            ->with('users', $userList)
//            ->with('searchBy', $searchBy)
//            ->with('searchWord', $searchWord)
//            ->with('pageTitle', 'Pending Taskminator Accounts')
//            ->with('formUrl', '/pendingTskmntr=search');
    }

    public function countPendingUsers(){
        return User::where('status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION'])->count();
    }

    public function search_PUSR($keyword, $acctType, $orderBy){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->whereIn('users.status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION']);

        if($keyword != "NONE"){
            $userList = $userList
                        ->where('users.fullName', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('users.username', 'LIKE', '%'.$keyword.'%');
        }

        if($acctType != "ALL"){
            $userList = $userList->where('users.accountType', $acctType);
        }

        $userList = $userList->orderBy('users.created_at', $orderBy)
            ->select([
                'users.id',
                'users.fullName',
                'users.status',
                'users.username',
            ])
            ->paginate(10);

        return View::make('admin.taskList')
            ->with('pendingUsers', $userList)
            ->with('pendingCount', $this->countPendingUsers())
            ->with('search_keyword', $keyword)
            ->with('search_acctType', $acctType)
            ->with('search_orderBy', $orderBy)
            ->with('pageName', 'Proveek Admin | Dashboard');
    }

    public function adminSearchChatUser(){
        return User::join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
            ->whereNotIn('users.id', BaseController::GET_ALL_ADMIN())
            ->join('roles', 'roles.id', '=','user_has_role.role_id')
            ->where('users.fullName', 'LIKE', '%'.Input::get('chatSearch').'%')
            ->orWhere('users.username', 'LIKE', '%'.Input::get('chatSearch').'%')
            ->whereNotIn('users.id', BaseController::GET_ALL_ADMIN())
            ->select([
                'users.fullName',
                'users.username',
                'users.id',
                'roles.role'
            ])->get();
    }

    public function getCHAT($with_userId){

        $QUERY = AdminMessage::whereIn('user_id', array(Auth::user()->id, $with_userId))
                    ->whereIn('sender_id', array(Auth::user()->id, $with_userId));
        if($QUERY->count() > 0){
            $QUERY->update(['status'    =>  'OLD']);
            return $QUERY->get();
        }else{
            return "NOCHATHISTORY";
        }
    }

    public function ADMINSENDMESSAGE(){
        $msg_timestamp = date("Y:m:d H:i:s");
        AdminMessage::insert(array(
            'user_id'   =>  Input::get('USERID'),
            'sender_id' =>  Input::get('SENDERID'),
            'content'   =>  Input::get('ADMIN_sendMsgContent'),
            'created_at'=>  $msg_timestamp,
        ));

//        date('D, M j, Y \a\t g:ia')
        return array(
            'msg'       =>  Input::get('ADMIN_sendMsgContent'),
            'tstamp'    =>  $msg_timestamp
        );
    }

    public function ADMINGETNEWMSG($userid, $senderid){
        $NEWMSG = AdminMessage::where('user_id', Auth::user()->id)
                    ->where('status', 'NEW')
                    ->where('sender_id', $userid);

        $ALL_NEW_MESSAGES = $NEWMSG->get();

        $NEWMSG->update(['status' => 'OLD']);

        return $ALL_NEW_MESSAGES;
    }

    public function showJobAds(){
        $jobs = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
            ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->leftJoin('provinces', 'provinces.provcode', '=', 'jobs.provcode')
            ->select([
                'users.fullName',
                'users.id as user_id',
                'jobs.title',
                'jobs.id as job_id',
                'jobs.expires_at',
                'jobs.salary',
                'jobs.created_at',
                'jobs.description',
                'jobs.hiring_type',
                'cities.cityname',
                'regions.regname',
                'provinces.provname',
            ])
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->paginate(10);

        return View::make('admin.showJobAds')
                ->with('jobs', $jobs);
    }

    public function ADMIN_jobDetails($job_id){
        $custom_skills = CustomSkill::where('company_job_id', $job_id)->get();
        $job = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->join('taskcategory', 'jobs.skill_category_code', '=', 'taskcategory.categorycode')
            ->join('taskitems', 'jobs.skill_code', '=', 'taskitems.itemcode')
            ->leftJoin('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->leftJoin('barangays', 'barangays.bgycode', '=', 'jobs.bgycode')
            ->leftJoin('cities', 'cities.citycode', '=', 'jobs.citycode')
            ->where('jobs.id', $job_id)
            ->select([
                'users.username',
                'users.id as USERID',
                'users.fullName',
                'jobs.id',
                'jobs.title',
                'jobs.created_at',
                'jobs.description',
                'jobs.requirements',
                'jobs.salary',
                'jobs.hiring_type',
                'regions.regname',
                'regions.regcode',
                'barangays.bgyname',
                'barangays.bgycode',
                'cities.cityname',
                'cities.citycode',
                'taskcategory.categoryname',
                'taskcategory.categorycode',
                'taskitems.itemname',
                'taskitems.itemcode'
            ])
            ->first();

        return View::make('admin.ADMIN_jobDetails')
                ->with('job', $job)
                ->with('custom_skills', $custom_skills);
    }

    public function ADMINJbSrch($keyword, $regcode, $provcode, $hiringType, $orderBy, $categoryID, $skillID){
        $QUERY = Job::join('users', 'users.id', '=', 'jobs.user_id')
            ->join('taskcategory', 'jobs.skill_category_code', '=', 'taskcategory.categorycode')
            ->join('taskitems', 'jobs.skill_code', '=', 'taskitems.itemcode')
            ->join('regions', 'regions.regcode', '=', 'jobs.regcode')
            ->join('cities', 'cities.citycode', '=', 'jobs.citycode');

        if($regcode != 'ALL'){
            $QUERY = $QUERY->where('jobs.regcode', $regcode);
        }

        if($provcode != 'ALL'){
            $QUERY = $QUERY->where('jobs.citycode', $provcode);
        }

        if($hiringType != 'ALL'){
            $QUERY = $QUERY->where('jobs.hiring_type', $hiringType);
        }

        if($categoryID != 'ALL'){
            $QUERY = $QUERY->where('jobs.skill_category_code', $categoryID);
        }

        if($skillID != 'ALL'){
            $QUERY = $QUERY->where('jobs.skill_code', $skillID);
        }

        if($keyword != 'NONE'){
            $QUERY = $QUERY->leftJoin('custom_skills', 'custom_skills.company_job_id', '=', 'jobs.id')
                ->orWhere('custom_skills.skill', 'LIKE', '%'.$keyword.'%')
                ->orWhere('jobs.title', 'LIKE', '%'.$keyword.'%');
        }else{
            $keyword = '';
        }

        $QUERY = $QUERY->orderBy('jobs.created_at', $orderBy)
            ->select([
                'users.fullName',
                'users.id as user_id',
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

        return View::make('admin.showJobAds')
                ->with('jobs', $QUERY)
                ->with('AS_keyword', $keyword)
                ->with('AS_regcode', $regcode)
                ->with('AS_citycode', $provcode)
                ->with('AS_hiringType', $hiringType)
                ->with('AS_orderBy', $orderBy)
                ->with('AS_categoryID', $categoryID)
                ->with('AS_skillID', $skillID);
    }

    public function ADMIN_DELETEJOB($jobId){
        Job::where('id', $jobId)->delete();
        JobInvite::where('job_id', $jobId)->delete();
        JobApplication::where('job_id', $jobId)->delete();
        CustomSkill::where('company_job_id', $jobId)->delete();

        if(AdminController::IF_ADMIN_IS(['SUPER_ADMINISTRATOR'], Auth::user()->id)){
            return Redirect::to('/showJobAds');
        }else{
            return Redirect::to('/subadmin/jobads');
        }
    }

    public function UsrAccntLstCMPNY(){
        $userList = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_has_role.role_id')
            ->leftJoin('regions', 'regions.regcode', '=', 'users.region')
            ->leftJoin('cities', 'cities.citycode', '=', 'users.city')
            ->whereIn('user_has_role.role_id', ['3', '4'])
            ->whereNotIn('users.status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION'])
            ->orderBy('users.created_at', 'DESC')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.profilePic',
                'users.status',
                'users.created_at',
                'cities.cityname',
                'regions.regname',
            ])
            ->paginate(10);
        $regions = Region::get();
        $subscriptions = SystemSubscription::orderBy('id', 'ASC')->get();

        return View::make('admin.userlist_client_indi')
            ->with('regions', $regions)
            ->with('provinces', [])
            ->with('cities', [])
            ->with('subs', $subscriptions)
            ->with('users', $userList);

    }

    public function ADMINNavSearch($keyword){
        $users = User::where('fullName', 'LIKE', '%'.$keyword.'%')->paginate(10);
        $jobs = Job::where('title', 'LIKE', '%'.$keyword.'%')->paginate(10);
        return View::make('admin.ADMINNavSearch')
                ->with('keyword', $keyword)
                ->with('users', $users)
                ->with('jobs', $jobs);
    }

    public function customSkills(){
        $customSkill = CustomSkill::join('users', 'users.id', '=', 'custom_skills.created_by')
                        ->select([
                            'users.id as userID',
                            'users.fullName',
                            'users.username',
                            'custom_skills.id as customSkillID',
                            'custom_skills.created_at',
                            'custom_skills.skill',
                        ])
                        ->get();
        return View::make('admin.customSkills')
                ->with('customSkill', $customSkill);
    }

    public function DELCSTSKLL($skillID){
        CustomSkill::where('id', $skillID)->delete();
        return Redirect::back();
    }

    public function SYSTEMSETTINGS(){
        return View::make('admin.SYSTEMSETTINGS')
                ->with('doc_types', DocumentType::orderBy('created_at', 'DESC')->get())
                ->with('SYS_SETTINGS', SystemSetting::get())
                ->with('subs', SystemSubscription::get())
                ->with('subscriptions', SystemSubscription::get());
    }

    public function doSYSTEMSETTINGS(){

        if(!is_numeric(Input::get('SYSSETTINGS_POINTSPERAD')) || !is_numeric(Input::get('SYSSETTINGS_JOBADDURATION')) || !is_numeric(Input::get('SYSSETTINGS_CHECKOUTPRICE'))){
            Session::flash('error', 'Numbers only');
        }else{
            SystemSetting::where('type', 'SYSSETTINGS_POINTSPERAD')
                ->update([
                    'value'     =>  Input::get('SYSSETTINGS_POINTSPERAD')
                ]);

            SystemSetting::where('type', 'SYSSETTINGS_REPOST_POINTSPERAD')
                ->update([
                    'value'     =>  Input::get('SYSSETTINGS_REPOST_POINTSPERAD')
                ]);


            SystemSetting::where('type', 'SYSSETTINGS_JOBADDURATION')
                ->update([
                    'value'     =>  Input::get('SYSSETTINGS_JOBADDURATION')
                ]);

            SystemSetting::where('type', 'SYSSETTINGS_CHECKOUTPRICE')
                ->update([
                    'value'     =>  Input::get('SYSSETTINGS_CHECKOUTPRICE')
                ]);

            SystemSetting::where('type', 'SYSSETTINGS_FREE_SUB_ON_REG')
                ->update([
                    'value'     =>  Input::get('SYSSETTINGS_FREE_SUB_ON_REG')
                ]);

            SystemSetting::where('type', 'SYSSETTINGS_FDBACK_INIT')
                ->update([
                    'value'     =>  Input::get('SYSSETTINGS_FDBACK_INIT')
                ]);
        }

        return Redirect::back();
    }

    public function DISABLEDOC($docID){
        DocumentType::where('id', $docID)->update([
            'sys_doc_disabled'  =>  true,
        ]);
        return Redirect::back();
    }

    public function ENABLEDOC($docID){
        DocumentType::where('id', $docID)->update([
            'sys_doc_disabled'  =>  false,
        ]);
        return Redirect::back();
    }

    public function SYS_ADD_DOC(){
        DocumentType::insert([
            'sys_doc_type'      =>  Input::get('DOCUMENT_TYPE'),
            'sys_doc_label'     =>  Input::get('DOCUMENT_LABEL'),
            'sys_doc_role'      =>  Input::get('DOC_ROLE'),
            'sys_doc_disabled'  =>  false,
            'created_at'        =>  date("Y:m:d H:i:s")
        ]);

        return Redirect::back();
    }

    public function DELETEDOC($docID){
        DocumentType::where('id', $docID)->delete();
        return Redirect::back();
    }

    public function WORKERDOCUMENTS(){
        $docs = DocumentType::orderBy('created_at', 'DESC')
                ->where('sys_doc_role', 'WORKER')
                ->paginate(10);
        return View::make('admin.WORKERDOCUMENTS')
            ->with('doc_types', $docs);
    }

    public function COMPANYDOCUMENTS(){
        $docs = DocumentType::orderBy('created_at', 'DESC')
            ->where('sys_doc_role', 'COMPANY')
            ->paginate(10);
        return View::make('admin.COMPANYDOCUMENTS')
            ->with('doc_types', $docs);

    }

    public function TOS(){
        return View::make('admin.TERMS_AND_POLICY')
                ->with('content_es', SystemSetting::where('type', 'SYSSETTINGS_TOS_ES')->pluck('value'))
                ->with('content_tg', SystemSetting::where('type', 'SYSSETTINGS_TOS_TG')->pluck('value'));
    }

    public function TOS_SAVE_ES(){
        if(SystemSetting::where('type', 'SYSSETTINGS_TOS_ES')->count() == 0){
            SystemSetting::insert([
                'type'  =>  'SYSSETTINGS_TOS_ES',
                'value' =>  Input::get('editor')
            ]);
        }else{
            SystemSetting::where('type', 'SYSSETTINGS_TOS_ES')->update([
                'value' =>  Input::get('editor')
            ]);
        }

        return Redirect::back();
    }

    public function TOS_SAVE_TG(){
        if(SystemSetting::where('type', 'SYSSETTINGS_TOS_TG')->count() == 0){
            SystemSetting::insert([
                'type'  =>  'SYSSETTINGS_TOS_TG',
                'value' =>  Input::get('editor')
            ]);
        }else{
            SystemSetting::where('type', 'SYSSETTINGS_TOS_TG')->update([
                'value' =>  Input::get('editor')
            ]);
        }

        return Redirect::back();
    }

    public function POLICY(){
        return View::make('admin.POLICY')
                ->with('pol_es', SystemSetting::where('type', 'SYSSETTINGS_POLICY_ES')->pluck('value'))
                ->with('pol_tg', SystemSetting::where('type', 'SYSSETTINGS_POLICY_TG')->pluck('value'));
    }

    public function POLICY_SAVE_ES(){
        if(SystemSetting::where('type', 'SYSSETTINGS_POLICY_ES')->count() == 0){
            SystemSetting::insert([
                'type'  =>  'SYSSETTINGS_POLICY_ES',
                'value' =>  Input::get('editor')
            ]);
        }else{
            SystemSetting::where('type', 'SYSSETTINGS_POLICY_ES')->update([
                'value' =>  Input::get('editor')
            ]);
        }

        return Redirect::back();
    }

    public function POLICY_SAVE_TG(){
        if(SystemSetting::where('type', 'SYSSETTINGS_POLICY_TG')->count() == 0){
            SystemSetting::insert([
                'type'  =>  'SYSSETTINGS_POLICY_TG',
                'value' =>  Input::get('editor')
            ]);
        }else{
            SystemSetting::where('type', 'SYSSETTINGS_POLICY_TG')->update([
                'value' =>  Input::get('editor')
            ]);
        }

        return Redirect::back();
    }

    public function subscriptions($subID){
        return View::make('admin.subscriptions')
                ->with('sub', SystemSubscription::where('id', $subID)->first());
    }

    public function UPDATESUBSCRIPTION(){
//        return Input::all();
        SystemSubscription::where('id', Input::get('subID'))
            ->update([
                'subscription_code'     => Input::get('subscription_code'),
                'subscription_label'    => Input::get('subscription_label'),
                'subscription_duration' => Input::get('subscription_duration'),
                'subscription_price'    => Input::get('subscription_price'),
                'worker_browse'         => Input::get('worker_browse'),
                'worker_bookmark_limit' => Input::get('worker_bookmark_limit'),
                'invite_limit'          => Input::get('invite_limit'),
                'job_ad_limit_week'     => Input::get('job_ad_limit_week'),
                'job_ad_limit_month'    => Input::get('job_ad_limit_month'),
                'featured_job_ads'      => Input::get('featured_job_ads'),
                'sms_notif'             => Input::get('sms_notif'),
                'free_resume'           => Input::get('free_resume'),
                'bulk_invite'           => Input::get('bulk_invite'),
                'updated_at'            => date("Y:m:d H:i:s")
            ]);

        return Redirect::back();
    }

    public function addSubscription($user_id){
        $sub = SystemSubscription::leftJoin('user_subscriptions', 'user_subscriptions.system_subscription_id', '=', 'system_subscriptions.id')
            ->where('user_subscriptions.user_id', $user_id)
            ->select([
                'user_subscriptions.id as user_sub_id',
                'user_subscriptions.expired',
                'user_subscriptions.expires_at',
                'user_subscriptions.created_at',
                'system_subscriptions.id as sys_sub_id',
                'system_subscriptions.subscription_code',
                'system_subscriptions.subscription_label',
            ])
            ->first();

        $sys_subs = SystemSubscription::get();

        return View::make('admin.addSubscription')
            ->with('sys_subs', $sys_subs)
            ->with('user', User::find($user_id))
            ->with('sub', $sub);
    }

    public function doAddSubscription(){
        $this->APPLY_SUBSCRIPTION_EMPLOYERS(Input::get('subs'), Input::get('user_id'));
        return Redirect::back();
    }

    public function RMVSBSCRPTN($sub_id){
        UserSubscription::find($sub_id)->delete();
        return Redirect::back();
    }

    public function CREATE_ADMIN(){
        $admins = User::join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
                ->where('user_has_role.role_id', 1)
                ->select([
                    'users.created_at',
                    'users.username',
                    'users.fullName',
                    'users.id',
                    'users.status'
                ])
                ->orderBy('created_at', 'DESC')
                ->paginate(10);

        return View::make('admin.CREATE_ADMIN')
                ->with('admins', $admins);
    }

    public function doCREATE_ADMIN(){
        if(Input::get('admin_fname') && Input::get('admin_lname') && Input::get('admin_username') && Input::get('admin_password') && Input::get('admin_cpassword')){
            if(strcmp(Input::get('admin_password'), Input::get('admin_cpassword')) == 0){
                if(User::where('username', Input::get('admin_username'))->count() == 0){
                    $ADMIN_ID = User::insertGetId([
                        'username'  =>  Input::get('admin_username'),
                        'password'  =>  Hash::make(Input::get('admin_password')),
                        'firstName' =>  Input::get('admin_fname'),
                        'midName'   =>  Input::get('admin_mname'),
                        'lastName'  =>  Input::get('admin_lname'),
                        'fullName'  =>  Input::get('admin_fname').' '.Input::get('admin_mname').' '.Input::get('admin_lname'),
                        'status'    =>  'ACTIVATED',
                        'created_at'=>  \Carbon\Carbon::now()
                    ]);

                    UserHasRole::insert(array(
                        'user_id'           =>  $ADMIN_ID,
                        'role_id'           =>  1,
                    ));

                    foreach(Input::get('admin_role') as $ar){
                        $ADMIN_ROLE_ID = AdminRole::where('role', $ar)->pluck('id');
                        AdminHasRole::insert([
                            'user_id'       =>  $ADMIN_ID,
                            'admin_role_id' =>  $ADMIN_ROLE_ID
                        ]);
                    }

                    Session::flash('successMsg', 'New administrator created');
                }else{
                    Session::flash('errorMsg', 'Username already exists');
                }
            }else{
                Session::flash('errorMsg', 'Password does not match');
            }
        }else{
            Session::flash('errorMsg', 'Required fields must be filled out');
        }

        return Redirect::back()
            ->withInput();
    }

    public function DELETE_ADMIN($user_id){
        User::where('id', $user_id)->delete();
        UserHasRole::where('user_id', $user_id)->delete();
        return Redirect::back();
    }

    public function EDIT_ADMIN($user_id){
        $admins = User::join('user_has_role', 'user_has_role.user_id', '=', 'users.id')
            ->where('user_has_role.role_id', 1)
            ->select([
                'users.created_at',
                'users.username',
                'users.fullName',
                'users.id',
                'users.status'
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return View::make('admin.EDIT_ADMIN')
            ->with('roles', $this->GET_USER_ADMIN_ROLES($user_id))
            ->with('admins', $admins)
            ->with('admin', User::where('id', $user_id)->first());
    }

    public function doEDIT_ADMIN(){
        if(Input::get('admin_fname') && Input::get('admin_lname') && Input::get('admin_username')){
            if(User::where('username', Input::get('admin_username'))->whereNotIn('id', [Input::get('admin_id')])->count() == 0){
                if(Input::has('admin_password')){
                    if(strcmp(Input::get('admin_password'), Input::get('admin_cpassword')) == 0){
                        User::where('id', Input::get('admin_id'))->update([
                            'username'  =>  Input::get('admin_username'),
                            'password'  =>  Hash::make(Input::get('admin_password')),
                            'firstName' =>  Input::get('admin_fname'),
                            'midName'   =>  Input::get('admin_mname'),
                            'lastName'  =>  Input::get('admin_lname'),
                            'fullName'  =>  Input::get('admin_fname').' '.Input::get('admin_mname').' '.Input::get('admin_lname'),
                        ]);
                        Session::flash('successMsg', 'Administrator account edited');
                    }else{
                        Session::flash('errorMsg', 'Password does not match');
                    }
                }else{
                    User::where('id', Input::get('admin_id'))->update([
                        'username'  =>  Input::get('admin_username'),
                        'firstName' =>  Input::get('admin_fname'),
                        'midName'   =>  Input::get('admin_mname'),
                        'lastName'  =>  Input::get('admin_lname'),
                        'fullName'  =>  Input::get('admin_fname').' '.Input::get('admin_mname').' '.Input::get('admin_lname'),
                    ]);
                }


                AdminHasRole::where('user_id', Input::get('admin_id'))->delete();

                foreach(Input::get('admin_role') as $ar){
                    $ADMIN_ROLE_ID = AdminRole::where('role', $ar)->pluck('id');
                    AdminHasRole::insert([
                        'user_id'       =>  Input::get('admin_id'),
                        'admin_role_id' =>  $ADMIN_ROLE_ID
                    ]);
                }
            }else{
                Session::flash('errorMsg', 'Username already exists');
            }
        }else{
            Session::flash('errorMsg', 'Required fields must be filled out');
        }

        if(Auth::user()->id == Input::get('admin_id')){
            Auth::logout();
            return Redirect::to('/login');
        }else{
            return Redirect::back()
                ->withInput();
        }
    }

    public function DEACTIVATE_ADMIN($user_id){
        User::where('id', $user_id)->update([
            'status'    =>  'DEACTIVATED'
        ]);
        return Redirect::back();
    }

    public function ACTIVATE_ADMIN($user_id){
        User::where('id', $user_id)->update([
            'status'    =>  'ACTIVATED'
        ]);
        return Redirect::back();
    }

    public function points($user_id){
        return View::make('admin.points')
            ->with('user', User::find($user_id));
    }

    public function doAddPoints(){
        if(is_numeric(Input::get('points'))){
            User::where('id', Input::get('user_id'))->update([
                'points'    =>  Input::get('current_points') + Input::get('points')
            ]);

            Session::flash('successMsg', Input::get('points').' point(s) added');
            return Redirect::back();
        }else{
            Session::flash('errorMsg', 'Please input numeric values only.');
            return Redirect::back();
        }
    }

    public function doSubtractPoints(){
        if(is_numeric(Input::get('points'))){

            User::where('id', Input::get('user_id'))->update([
                'points'    =>  $points = (Input::get('current_points') < Input::get('points')) ? 0 : Input::get('current_points') - Input::get('points')
            ]);

            Session::flash('successMsg', $points.' point(s) subtracted');
            return Redirect::back();
        }else{
            Session::flash('errorMsg', 'Please input numeric values only.');
            return Redirect::back();
        }

    }

    public function allJobAds_user($user_id){
        return View::make('admin.allJobAds_user')
            ->with('jobs', Job::where('user_id', $user_id)->get());
    }

    public function doEditCategory(){
        TaskCategory::where('id', Input::get('category_id'))->update([
            'categoryname'  =>  strip_tags(trim(Input::get('category_name')))
        ]);
        return Redirect::back();
    }

    public function categoryFullDetails($cat_id){
        return View::make('admin.categoryFullDetails')
            ->with('skills', TaskItem::where('item_categorycode', $cat_id)->paginate(10))
            ->with('cat', TaskCategory::where('categorycode', $cat_id)->first());
    }

    public function doEditCategorySkill(){
//        return Input::all();
        TaskItem::where('id', Input::get('skill_id'))->update([
            'itemname' => strip_tags(trim(Input::get('skill_name')))
        ]);
        return Redirect::back();
    }

    public function doAddSkillToCategory(){
        $maxSkillCode = str_replace(Input::get('category_code'), '', TaskItem::where('item_categorycode', Input::get('category_code'))->max('itemcode'));
        $maxSkillCode = ++$maxSkillCode;
        $maxSkillCode = str_pad($maxSkillCode, 3, '0', STR_PAD_LEFT);
        TaskItem::insert([
            'itemname' => Input::get('skill_name'),
            'itemcode' => Input::get('category_code').''.$maxSkillCode,
            'item_categorycode' => Input::get('category_code')

        ]);

        return Redirect::back();
    }

    public function doAddCategory(){

        $maxCatCode = TaskCategory::whereNotIn('categoryname', ['Others'])->max('categorycode');
        $maxCatCode = ++$maxCatCode;
        $maxCatCode = str_pad($maxCatCode, 3, '0', STR_PAD_LEFT);

        TaskCategory::insert(array(
            'categoryname'      =>  Input::get('category_name'),
            'categorycode'      =>  $maxCatCode
        ));

        return Redirect::back();
    }

    public function GET_USER_ADMIN_ROLES($user_id){
        $roles = AdminRole::join('admin_has_roles', 'admin_roles.id', '=', 'admin_has_roles.admin_role_id')
            ->where('admin_has_roles.user_id', $user_id)
            ->get();

        $myArr = array();
        foreach($roles as $o){ array_push($myArr, $o->role); }
        return $myArr;
    }

    public static function IF_ADMIN_IS($roles, $user_id){
        $roles = AdminRole::join('admin_has_roles', 'admin_roles.id', '=', 'admin_has_roles.admin_role_id')
            ->where('admin_has_roles.user_id', $user_id)
            ->whereIn('admin_roles.role', $roles)
            ->count();

        return ($roles > 0) ? true : false;
    }

    public static function IS_SUPERADMIN($user_id){
        $flag = AdminRole::join('admin_has_roles', 'admin_roles.id', '=', 'admin_has_roles.admin_role_id')
            ->where('admin_has_roles.user_id', $user_id)
            ->whereIn('admin_roles.role', ['SUPER_ADMINISTRATOR'])
            ->count();

        return ($flag == 1) ? true : false;
    }

    public function deleteSubscription($sub_id){
        SystemSubscription::where('id', $sub_id)->delete();
        return Redirect::back();
    }

    public function CREATE_SUBSCRIPTION(){
        return View::make('admin.CREATE_SUBSCRIPTION');
    }

    public function CREATESUBSCRIPTION(){
        $errorArray = array();
        // check code
        if(!ctype_alnum(Input::get('subscription_code'))){
            array_push($errorArray, 'SUBSCRIPTION CODE MUST BE ALPHANUMERIC ONLY');
        }elseif(SystemSubscription::where('subscription_code', Input::get('subscription_code'))->count() > 0){
            array_push($errorArray, 'SUBSCRIPTION CODE ALREADY EXISTS');
        }

        // check label
        if(strlen(strip_tags(Input::get('subscription_label'))) == 0){
            array_push($errorArray, 'SUBSCRIPTION LABEL CANNOT CONTAIN TAGS');
        }

        // check duration - DAYS
        if(!is_numeric(Input::get('subscription_duration'))){
            array_push($errorArray, 'DURATION MUST BE NUMERIC ONLY (USER UNIT OF DAYS)');
        }

        // check price
        if(!is_numeric(Input::get('subscription_price'))){
            array_push($errorArray, 'PRICE MUST BE NUMERIC ONLY');
        }

        // check worker bookmark limit
        if(!is_numeric(Input::get('worker_bookmark_limit'))){
            array_push($errorArray, 'WORKER BOOKMARK LIMIT MUST BE NUMERIC ONLY');
        }

        // check worker invite limit
        if(!is_numeric(Input::get('invite_limit'))){
            array_push($errorArray, 'INVITE LIMIT MUST BE NUMERIC ONLY');
        }

        // check JOB AD LIMIT PER WEEK
        if(!is_numeric(Input::get('job_ad_limit_week'))){
            array_push($errorArray, 'JOB AD LIMIT PER WEEK MUST BE NUMERIC ONLY');
        }

        // check JOB AD LIMIT PER WEEK
        if(!is_numeric(Input::get('job_ad_limit_month'))){
            array_push($errorArray, 'JOB AD LIMIT PER MONTH MUST BE NUMERIC ONLY');
        }

        // check FEATURED JOB AD
        if(!is_numeric(Input::get('featured_job_ads'))){
            array_push($errorArray, 'FEATURED JOB AD MUST BE NUMERIC ONLY');
        }

        // check JOB AD LIMIT PER WEEK
        if(!is_numeric(Input::get('featured_job_ads'))){
            array_push($errorArray, 'FEATURED JOB AD MUST BE NUMERIC ONLY');
        }

        // check JOB AD LIMIT PER WEEK
        if(!is_numeric(Input::get('free_resume'))){
            array_push($errorArray, 'FREE RESUME MUST BE NUMERIC ONLY');
        }

        if(count($errorArray) == 0){
            SystemSubscription::insert([
                'subscription_code'     => Input::get('subscription_code'),
                'subscription_label'    => Input::get('subscription_label'),
                'subscription_duration' => Input::get('subscription_duration'),
                'subscription_price'    => Input::get('subscription_price'),
                'worker_browse'         => Input::get('worker_browse'),
                'worker_bookmark_limit' => Input::get('worker_bookmark_limit'),
                'invite_limit'          => Input::get('invite_limit'),
                'job_ad_limit_week'     => Input::get('job_ad_limit_week'),
                'job_ad_limit_month'    => Input::get('job_ad_limit_month'),
                'featured_job_ads'      => Input::get('featured_job_ads'),
                'sms_notif'             => Input::get('sms_notif'),
                'free_resume'           => Input::get('free_resume'),
                'created_at'            => Carbon::now()
            ]);

            return Redirect::to('/SYSTEMSETTINGS');
        }else{
            Session::flash('errorArray', $errorArray);
            return Redirect::back()
                ->withInput();
        }
    }
}
