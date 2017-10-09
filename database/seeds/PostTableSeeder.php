<?php

use Illuminate\Database\Seeder;

// sets the database with initial data
// useful for setting intial user accounts like admin
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// we have to specify the namespace for this
    	$post = new \App\Post([
    		'title' => 'Learning Laravel',
    		'content' => 'This blog will get you right on track with Laravel!'
    	]);
    	$post->save();

    	$post = new \App\Post([
    		'title' => 'Laravel 5.5',
    		'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur accumsan mauris varius erat vestibulum, sed tincidunt odio lacinia. Integer quis nisl quis sapien porta lobortis.'
    	]);
    	$post->save();
    }
}
