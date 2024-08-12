<?php

use Illuminate\Database\Seeder;

class InitGalleryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('gallery')->insert([
            ['name' => 'Gallery']
        ]);
    }
}
