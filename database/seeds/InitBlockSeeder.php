<?php

use Illuminate\Database\Seeder;

class InitBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('blocks')->truncate();
        $data = [
            [
                'name' => 'Khối nội dung 1 - trang chủ',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        \Illuminate\Support\Facades\DB::table('blocks')->insert($data);
    }
}
