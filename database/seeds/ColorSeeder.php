<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run()
    {
        DB::table('colors')->insert([
            [
                'name' => 'red',
                'btn_style' => 'danger',
            ],
            [
                'name' => 'blue',
                'btn_style' =>  'primary',
            ],
            [
                'name' => 'green',
                'btn_style' => 'success',
            ],
            [
                'name' => 'grey',
                'btn_style' => 'secondary',
            ],
            [
                'name' => 'black',
                'btn_style' => 'dark',
            ],
            [
                'name' => 'yellow',
                'btn_style' => 'warning',
            ],
            [
                'name' => 'white',
                'btn_style' => 'light',
            ],
        ]);
    }
}
