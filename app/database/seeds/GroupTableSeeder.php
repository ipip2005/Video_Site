<?php

class GroupTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $group = array(
            'name' => 'default',
	    'user_id' => '0',
			'created_at' => DB::raw('NOW()'),		
            'updated_at' => DB::raw('NOW()')
        );

        $group = array(
            'name' => 'friends',
	    'user_id' => '1',
			'created_at' => DB::raw('NOW()'),		
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($group);
		
		$group = array(
            'name' => 'classmates',
	    'user_id' => '1',
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($group);
		
		$group = array(
            'name' => 'friends',
	    'user_id' => '1',
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($group);
    }
}
