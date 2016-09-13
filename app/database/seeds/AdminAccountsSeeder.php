<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 9/13/2016
 * Time: 11:15 PM
 */

class AdminAccountsSeeder extends Seeder {
    public function run(){
        User::create(array(
            'id'                =>  1,
            'username'          =>  'jonisalangoy',
            'password'          =>  Hash::make('jonisalangoy'),
            'firstName'         =>  'Joni',
            'midName'           =>  'Salibad',
            'lastName'          =>  'Salang-oy',
            'fullName'          =>  'Joni Salang-oy',
            'gender'            =>  'FEMALE',
            'birthdate'         =>  '1992-12-21',
            'country'           =>  'PHILIPPINES',
            'confirmationCode'  =>  md5(uniqid(rand(), true)),
            'status'            =>  'ACTIVATED',
//            'created_at'        =>  '2015-04-30 21:03:32',
//            'updated_at'        =>  '2015-04-30 21:03:32',
        ));
        UserHasRole::create(array(
            'user_id'           =>  1,
            'role_id'           =>  1,
        ));
        AdminHasRole::create([
            'user_id'       => 1,
            'admin_role_id' => 1,
        ]);

        DB::insert("INSERT INTO `contacts` (`user_id`, `ctype`, `content`) VALUES
            (1, 'email', 'admin@proveek.com')
        ");
    }
}