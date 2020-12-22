<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Gilis',
        	'email' => 'admin@admin.com',
        	'password' => bcrypt('admin'),
        	'status' => true 
        	]);
    }
}
