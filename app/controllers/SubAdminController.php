<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 8/20/2016
 * Time: 5:54 PM
 */

class SubAdminController extends \BaseController {
    public function pending_users(){
        $users = User::whereIn('status', ['PRE_ACTIVATED', 'VERIFY_EMAIL_REGISTRATION'])
            ->paginate(10);

        return View::make('admin.subadmin.pending_users')
            ->with('users', $users);
    }

    public function workers(){
        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->where('user_has_role.role_id', '=', '2')
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.created_at',
                'users.status'
            ])
            ->paginate(10);

        return View::make('admin.subadmin.userlist')
            ->with('title', 'Workers - User Accounts List')
            ->with('users', $users);
    }

    public function employers(){
        $users = User::join('user_has_role', 'users.id', '=', 'user_has_role.user_id')
            ->whereIn('user_has_role.role_id', [3, 4])
            ->select([
                'users.id',
                'users.fullName',
                'users.username',
                'users.created_at',
                'users.status'
            ])
            ->paginate(10);

        return View::make('admin.subadmin.userlist')
            ->with('provinces', [])
            ->with('cities', [])
            ->with('regions', Region::get())
            ->with('title', 'Employers - User Accounts List')
            ->with('subs', SystemSubscription::orderBy('id', 'ASC')->get())
            ->with('users', $users);
    }

    public function jobads(){
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

        return View::make('admin.subadmin.jobads')
            ->with('jobs', $jobs);
    }

    public function pending_users_SEARCH($acctType, $orderBy, $keyword){
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



        return View::make('admin.subadmin.pending_users')
            ->with('users', $userList)
            ->with('keyword', $keyword)
            ->with('acctType', $acctType)
            ->with('orderBy', $orderBy);
    }

    public function workers_SEARCH($checkout, $acctStatus, $orderBy, $keyword, $title){
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

        return View::make('admin.subadmin.userlist')
            ->with('title', $title)
            ->with('checkout', $checkout)
            ->with('users', $users)
            ->with('orderBy', $orderBy)
            ->with('acctStatus', $acctStatus)
            ->with('keyword', $keyword);;
    }

    public function employers_SEARCH($keyword, $status, $accountType, $orderBy, $searchBy, $region, $city, $province, $title){
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
        }else{
            $keyword = '';
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


        return View::make('admin.subadmin.userlist')
            ->with('title', $title)
            ->with('cities', $cities)
            ->with('regions', $regions)
            ->with('provinces', $provinces)
            ->with('cmpSearch_Region', $region)
            ->with('cmpSearch_City', $city)
            ->with('cmpSearch_Province', $province)
            ->with('subs', SystemSubscription::orderBy('id', 'ASC')->get())
            ->with('keyword', $keyword)
            ->with('acct_status', $status)
            ->with('adminCMP_accountType', $accountType)
            ->with('orderBy', $orderBy)
            ->with('adminCMP_SrchBy', $searchBy)
//            ->with('users', $userList);
            ->with('users', $users);
    }
}