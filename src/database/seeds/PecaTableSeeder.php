<?php

use Illuminate\Database\Seeder;

class PecaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Peca::class, 10)->create();
    }
}
