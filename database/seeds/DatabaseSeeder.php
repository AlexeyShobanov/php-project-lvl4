<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('TaskStatusSeeder');
        $this->call('LabelSeeder');
    }
}

class TaskStatusSeeder extends Seeder {

    public function run()
    {
        DB::table('task_statuses')->insert([
            ['name' => __('messages.new')],
            ['name' => __('messages.underway')],
            ['name' => __('messages.tested')],
            ['name' => __('messages.complited')]
        ]);
    }
}

class LabelSeeder extends Seeder {

    public function run()
    {
        DB::table('labels')->insert([
            [
                'name' => 'bug',
                'description' => 'Indicates an unexpected problem or unintended behavior',
                'color' => __('messages.red'),
            ],
            [
                'name' => 'documentation',
                'description' => 'Indicates a need for improvements or additions to documentation',
                'color' => __('messages.turquoise'),
            ],
            [
                'name' => 'duplicate',
                'description' => 'Indicates similar issues or pull requests',
                'color' => __('messages.grey'),
            ],
            [
                'name' => 'enhancement',
                'description' => 'Indicates new feature requests',
                'color' => __('messages.green'),
            ],
            [
                'name' => 'help wanted',
                'description' => 'Indicates a good issue for first-time contributors',
                'color' => __('messages.yellow'),
            ],
            [
                'name' => 'invalid',
                'description' => 'Indicates that an issue or pull request is no longer relevant',
                'color' => __('messages.black'),
            ],
            [
                'name' => 'question',
                'description' => 'Indicates that an issue or pull request needs more information',
                'color' => __('messages.blue'),
            ],
            [
                'name' => 'wontfix',
                'description' => 'Indicates that work won\'t continue on an issue or pull request',
                'color' => __('messages.white'),
            ]
        ]);
    }
}
