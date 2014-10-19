<?php

class RelationTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $relation = array(
            'host' => 2,
			'friend' => 3,
			'group' => 1,
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('urelation')->insert($relation);
		
		$relation = array(
            'host' => 2,
			'friend' => 4,
			'group' => 2,
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('urelation')->insert($relation);
		
		$relation = array(
            'host' => 2,
			'friend' => 5,
			'group' => 1,
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('urelation')->insert($relation);
		
		$relation = array(
            'host' => 3,
			'friend' => 2,
			'group' => 3,
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('urelation')->insert($relation);
		
		$relation = array(
            'host' => 3,
			'friend' => 4,
			'group' => 3,
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('urelation')->insert($relation);
		
		$relation = array(
            'host' => 3,
			'friend' => 6,
			'group' => 3,
			'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );

        // Uncomment the below to run the seeder
        DB::table('urelation')->insert($relation);
    }
}
