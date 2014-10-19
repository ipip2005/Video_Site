<?php

class User2TableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $user = array(
            'username' => 'tom',
            'nickName' => 'Tom Cruise',
            'password' => Hash::make('tom'),
        	'email' => 'tom@126.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
		
		$user = array(
            'username' => 'jack',
            'nickName' => 'Jackie Chan',
            'password' => Hash::make('jack'),
        	'email' => 'jack@126.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
		
		$user = array(
            'username' => 'mary',
            'nickName' => 'Mary Streep',
            'password' => Hash::make('mary'),
        	'email' => 'mary@126.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
		
		$user = array(
            'username' => 'bill',
            'nickName' => 'Bill Cliton',
            'password' => Hash::make('bill'),
        	'email' => 'tom@126.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
		
		$user = array(
            'username' => 'andy',
            'nickName' => 'Andy Wood',
            'password' => Hash::make('andy'),
        	'email' => 'andy@126.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
    }
}
