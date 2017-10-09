<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan migrate --seed (to run both step)
    	$this->call(PostTableSeeder::class);
    	$this->call(TagTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
