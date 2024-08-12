<?php

use Illuminate\Database\Seeder;

class InitBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('banners')->truncate();
        $data = [
            [
                'title' => 'Banner trang chủ',
                'type' => \App\Model\Admin\Banner::HOMEPAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang danh sách giáo viên',
                'type' => \App\Model\Admin\Banner::TEACHER_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang chi tiết giáo viên',
                'type' => \App\Model\Admin\Banner::TEACHER_DETAIL_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang danh sách lớp học',
                'type' => \App\Model\Admin\Banner::CLASS_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang chi tiết lớp học',
                'type' => \App\Model\Admin\Banner::CLASS_DETAIL_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang tin tức',
                'type' => \App\Model\Admin\Banner::BLOG_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang chi tiết tin tức',
                'type' => \App\Model\Admin\Banner::BLOG_DETAIL_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang liên hệ',
                'type' => \App\Model\Admin\Banner::CONTACT_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'title' => 'Banner trang giới thiệu',
                'type' => \App\Model\Admin\Banner::ABOUT_PAGE,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ];

        \Illuminate\Support\Facades\DB::table('banners')->insert($data);
    }
}
