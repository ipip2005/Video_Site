<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $user = array(
            'username' => 'fvroot',
            'nickName' => 'Fdu Video Administrator',
            'password' => Hash::make('fvroot'),
        	'email' => 'supersingerman@126.com',
            'photoPath' => '/usr/1/photo',
            'privilege' => '0',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
    }
}
