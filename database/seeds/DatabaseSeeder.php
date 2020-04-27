<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('TaskStatusSeeder');
    }
}

class TaskStatusSeeder extends Seeder {

    public function run()
    {
        DB::table('task_statuses')->insert([
            ['name' => 'New'],
            ['name' => 'Underway'],
            ['name' => 'Tested'],
            ['name' => 'Complited']
        ]);
    }
}
