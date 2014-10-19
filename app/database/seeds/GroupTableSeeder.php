<?php

class GroupTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $group = array(
            'name' => 'friends',
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($group);
		
		$group = array(
            'name' => 'classmates',
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($group);
		
		$group = array(
            'name' => 'friends',
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('groups')->insert($group);
    }
}
