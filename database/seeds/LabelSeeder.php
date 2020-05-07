<?php

use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    public function run()
    {
        DB::table('labels')->insert([
            [
                'name' => 'bug',
                'description' => 'Indicates an unexpected problem or unintended behavior',
                'color_id' => 1,
            ],
            [
                'name' => 'documentation',
                'description' => 'Indicates a need for improvements or additions to documentation',
                'color_id' => 2,
            ],
            [
                'name' => 'duplicate',
                'description' => 'Indicates similar issues or pull requests',
                'color_id' => 4,
            ],
            [
                'name' => 'enhancement',
                'description' => 'Indicates new feature requests',
                'color_id' => 3,
            ],
            [
                'name' => 'help wanted',
                'description' => 'Indicates a good issue for first-time contributors',
                'color_id' => 6,
            ],
            [
                'name' => 'invalid',
                'description' => 'Indicates that an issue or pull request is no longer relevant',
                'color_id' => 5,
            ],
            [
                'name' => 'question',
                'description' => 'Indicates that an issue or pull request needs more information',
                'color_id' => 2,
            ],
            [
                'name' => 'wontfix',
                'description' => 'Indicates that work won\'t continue on an issue or pull request',
                'color_id' => 7,
            ]
        ]);
    }
}
