<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('ColorSeeder');
        $this->call('LabelSeeder');
        $this->call('TaskStatusSeeder');
    }
}
