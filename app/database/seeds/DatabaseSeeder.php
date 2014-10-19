<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		
		$this->command->info('User table (admin) seeded!');
		
		$this->call('User2TableSeeder');
		
		$this->command->info('User table (all) seeded!');
		
		$this->call('GroupTableSeeder');
		
		$this->command->info('Group table seeded!');
		
		$this->call('RelationTableSeeder');
		
		$this->command->info('Relation table seeded!');
	}

}
