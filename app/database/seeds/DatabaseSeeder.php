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

		 $this->call('CitiesSeeder');
		 $this->call('BarangayTableSeeder');
		 $this->call('RegionTableSeeder');
		 $this->call('ProvinceTableSeeder');
		 $this->call('RolesTableSeeder');
//		 $this->call('UsersTableSeeder');
		 $this->call('TaskCategorySeeder');
		 $this->call('TaskTypesTableSeeder');
		 $this->call('SystemSettingsSeeder');
		 $this->call('DocumentTypesSeeder');
		 $this->call('SystemSubscriptionsSeeder');
//		 $this->call('TestSeeder');
		 $this->call('AdminRoleSeeder');
		 $this->call('AdminAccountsSeeder');
	}
}
