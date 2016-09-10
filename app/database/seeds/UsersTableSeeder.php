<?php

class UsersTableSeeder extends Seeder {

    public function run(){
        date_default_timezone_set("Asia/Manila");

        $total_duration = time() + (30 * 24 * 60 * 60);
        $total_duration = date("Y:m:d H:i:s", $total_duration);

        /*
        // CLIENT - INDIVIDIUAL
        User::create(array(
            'id'                =>  1,
            'username'          =>  'clientindi',
            'password'          =>  Hash::make('clientindi'),
            'firstName'         =>  'ClientFname',
            'midName'           =>  'ClientMidname',
            'lastName'          =>  'ClientLastname',
            'fullName'          =>  'ClientFname ClientMidname ClientLastname',
            'gender'            =>  'MALE',
            'birthdate'         =>  '1990-10-11',
            'address'           =>  'Client sample address',
            'city'              =>  '042106',
            'barangay'          =>  '042106066',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'status'            =>  'ACTIVATED',
            'accountType'       =>  '1',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
            'points'            =>  '150',
        ));
        UserHasRole::create(array(
            'user_id'           =>  1,
            'role_id'           =>  3,
        ));

        UserSubscription::insert([
            'user_id'                   =>  1,
            'system_subscription_id'    =>  1,
            'expires_at'                =>  $total_duration,
            'created_at'                =>  date("Y:m:d H:i:s")
        ]);
        */

        // CLIENT - COMPANY
        User::create(array(
            'id'                =>  2,
            'username'          =>  'clientcomp',
            'password'          =>  Hash::make('clientcomp'),
            'companyName'       =>  'Client Company',
            'fullName'          =>  'Client Company',
            'address'           =>  'Client Company Address',
            'city'              =>  '042106',
            'barangay'          =>  '042106066',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'status'            =>  'ACTIVATED',
            'accountType'       =>  1,
            'businessPermit'    =>  'Client Company DTI/SEC',
            'businessDescription'    =>  'Client Company Description',
            'businessNature'    =>  'Client Company Nature',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
            'points'            =>  '150',
        ));
        UserHasRole::create(array(
            'user_id'           =>  2,
            'role_id'           =>  4,
        ));
        UserSubscription::insert([
            'user_id'                   =>  2,
            'system_subscription_id'    =>  1,
            'expires_at'                =>  $total_duration,
            'created_at'                =>  date("Y:m:d H:i:s")
        ]);
        // TASKMINATOR 1
        User::create(array(
            'id'                =>  3,
            'username'          =>  'taskminator0',
            'password'          =>  Hash::make('taskminator0'),
            'firstName'         =>  'Juan',
            'midName'           =>  'Gregorio',
            'lastName'          =>  'Dela Cruz',
            'fullName'          =>  'Juan Gregorio Dela Cruz',
            'birthdate'         =>  '1990-10-11',
            'address'           =>  'Sample Address',
            'gender'            =>  'MALE',
//            'profilePic'        =>  '',
            'educationalBackground' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'servicesOffered'   =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'city'              =>  '042106',
            'barangay'          =>  '042106066',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'accountType'        =>  'BASIC',
            'workTime'            =>  'PTIME',
            'status'            =>  'ACTIVATED',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
            'points'            =>  '100',
        ));
        UserHasRole::create(array(
            'user_id'           =>  3,
            'role_id'           =>  2,
        ));
        /*
        ContactPerson::create(array(
            'user_id'           =>  3,
            'firstName'         =>  'PPerson Fistname',
            'midName'           =>  'PPerson Midname',
            'lastName'          =>  'PPerson Lastname',
            'contactNum'        =>  '09276274641',
            'email'             =>  'sarmiento11102@gmail.com.ph',
            'position'          =>  'PPerson Position',
            'country'           =>  'PHILIPPINES',
        ));
        */
        // TASKMINATOR 2
        User::create(array(
            'id'                =>  4,
            'username'          =>  'taskminator1',
            'password'          =>  Hash::make('taskminator1'),
            'firstName'         =>  'Lambert',
            'midName'           =>  'Deuce',
            'lastName'          =>  'Lacroix',
            'fullName'          =>  'Lambert Deuce Lacroix',
//            'profilePic'        =>  '',
            'birthdate'         =>  '1990-10-11',
            'address'           =>  'Sample Address',
            'gender'            =>  'FEMALE',
            'educationalBackground' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'servicesOffered'   =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'city'              =>  '042106',
            'barangay'          =>  '042106066',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'accountType'        =>  'BASIC',
            'workTime'            =>  'PTIME',
            'status'            =>  'ACTIVATED',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
            'points'            =>  '100',
        ));
        UserHasRole::create(array(
            'user_id'           =>  4,
            'role_id'           =>  2,
        ));
        /*
        ContactPerson::create(array(
            'user_id'           =>  4,
            'firstName'         =>  'PPerson Fistname',
            'midName'           =>  'PPerson Midname',
            'lastName'          =>  'PPerson Lastname',
            'contactNum'        =>  '09276274641',
            'email'             =>  'sarmiento11102@gmail.com.ph',
            'position'          =>  'PPerson Position',
            'country'           =>  'PHILIPPINES',
        ));
        */
        // TASKMINATOR 3
        User::create(array(
            'id'                =>  5,
            'username'          =>  'taskminator2',
            'password'          =>  Hash::make('taskminator2'),
            'firstName'         =>  'Evans',
            'midName'           =>  'William',
            'lastName'          =>  'Almighty',
            'fullName'          =>  'Evans William Almighty',
//            'profilePic'        =>  '',
            'birthdate'         =>  '1990-10-11',
            'address'           =>  'Sample Address',
            'gender'            =>  'FEMALE',
            'educationalBackground' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'servicesOffered'   =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'city'              =>  '042106',
            'barangay'          =>  '042106066',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'accountType'        =>  'BASIC',
            'workTime'            =>  'FTIME',
            'status'            =>  'ACTIVATED',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
            'points'            =>  '100',
        ));
        UserHasRole::create(array(
            'user_id'           =>  5,
            'role_id'           =>  2,
        ));
        /*
        ContactPerson::create(array(
            'user_id'           =>  5,
            'firstName'         =>  'PPerson Fistname',
            'midName'           =>  'PPerson Midname',
            'lastName'          =>  'PPerson Lastname',
            'contactNum'        =>  '09276274641',
            'email'             =>  'sarmiento11102@gmail.com.ph',
            'position'          =>  'PPerson Position',
            'country'           =>  'PHILIPPINES',
        ));
        */
        // ADMINISTRATORS
        User::create(array(
            'id'                =>  6,
            'username'          =>  'jonisalangoy',
            'password'          =>  Hash::make('jonisalangoy'),
            'firstName'         =>  'Joni',
            'midName'           =>  '',
            'lastName'          =>  'Salang-oy',
            'fullName'          =>  'Joni Salang-oy',
            'gender'            =>  'FEMALE',
            'birthdate'         =>  '0000-00-00',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'status'            =>  'ACTIVATED',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
        ));
        UserHasRole::create(array(
            'user_id'           =>  6,
            'role_id'           =>  1,
        ));

        AdminHasRole::create([
            'user_id'       => 6,
            'admin_role_id' => 1,
        ]);

        DB::insert("INSERT INTO `contacts` (`user_id`, `ctype`, `content`) VALUES
            (1, 'email', 'clientindi@client.com'),
            (1, 'facebook', 'facebook.com/januarystays'),
            (1, 'linkedin', 'linkedin.com/sample'),
            (1, 'mobileNum', '639276274641'),
            (2, 'email', 'clientcomp@client.com'),
            (2, 'businessNum', '00000000011'),
            (2, 'mobileNum', '639276274641'),
            (3, 'email', 'taskminator0@taskminator.com'),
            (3, 'facebook', 'facebook.com/januarystays'),
            (3, 'linkedin', 'linkedin.com/sample'),
            (3, 'mobileNum', '639276274641'),
            (4, 'email', 'taskminator1@taskminator.com'),
            (4, 'facebook', 'facebook.com/januarystays'),
            (4, 'linkedin', 'linkedin.com/sample'),
            (4, 'mobileNum', '639276274641'),
            (5, 'email', 'taskminator2@taskminator.com'),
            (5, 'facebook', 'facebook.com/januarystays'),
            (5, 'linkedin', 'linkedin.com/sample'),
            (5, 'mobileNum', '639276274641'),
            (6, 'email', 'admin@proveek.com'),
            (7, 'email', 'admin@proveek.com')
        ");

        DB::insert("INSERT INTO `taskminator_has_skills` (`user_id`, `taskitem_code`, `taskcategory_code`) VALUES
            (3, '001001', '001'),
            (3, '001002', '001'),
            (3, '001003', '001'),
            (3, '001004', '001'),
            (3, '001005', '001'),
            (3, '002001', '002'),
            (4, '002001', '002'),
            (4, '002002', '002'),
            (4, '002003', '002'),
            (4, '002004', '002'),
            (4, '002005', '002'),
            (4, '003001', '003'),
            (5, '003001', '003'),
            (5, '003002', '003'),
            (5, '003003', '003'),
            (5, '003004', '003'),
            (5, '003005', '003'),
            (5, '002001', '002')
        ");
    }
}