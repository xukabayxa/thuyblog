<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use App\Model\Common\File;

class Banner extends BaseModel
{
    const HOMEPAGE = 1;
    const TEACHER_PAGE = 2;
    const TEACHER_DETAIL_PAGE = 3;
    const CLASS_PAGE = 4;
    const CLASS_DETAIL_PAGE = 5;
    const BLOG_PAGE = 6;
    const BLOG_DETAIL_PAGE = 7;
    const CONTACT_PAGE = 8;
    const ABOUT_PAGE = 9;

    protected $table = 'banners';

//    protected $fillable = ['post_id', 'category_special_id'];

    public function image()
    {
        return $this->morphOne(File::class, 'model')->where('custom_field', 'image');
    }

    public static function searchByFilter($request)
    {
        $result = self::with([
            'image',
        ]);

        if (!empty($request->title)) {
            $result = $result->where('title', 'like', '%' . $request->title . '%');
        }

        $result = $result->orderBy('created_at', 'desc')->get();
        return $result;
    }

    public static function getDataForEdit($id)
    {
        return self::with('image')->where('id', $id)
            ->firstOrFail();
    }

    public function canDelete()
    {
        return true;
    }
}
