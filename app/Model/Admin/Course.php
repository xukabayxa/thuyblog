<?php

namespace App\Model\Admin;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\Auth;
use App\Model\BaseModel;
use App\Model\Common\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Common\File;
use DB;
use App\Model\Common\Notification;

class Course extends BaseModel
{
    public function image()
    {
        return $this->morphOne(File::class, 'model')->where('custom_field', 'image');
    }

    public function banner()
    {
        return $this->morphOne(File::class, 'model')->where('custom_field', 'banner');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function galleries()
    {
        return $this->hasMany(CourseGallery::class, 'course_id', 'id');
    }

    public static function searchByFilter($request) {
        $result = self::with([
            'user',
        ]);

        if (!empty($request->title)) {
            $result = $result->where('title', 'like', '%'.$request->title.'%');
        }

        if (!empty($request->age)) {
            $result = $result->where('age', 'like', '%'.$request->age.'%');
        }

        if (!empty($request->status)) {
            if($request->status == -1) {
                $result = $result->where('status', 0);
            } else {
                $result = $result->where('status', $request->status);
            }
        }

        $result = $result->orderBy('created_at','desc')->get();
        return $result;
    }

    public function generateCode()
    {
        $this->code = "KH-" . generateCode(6, $this->id);
        $this->save();
    }

    public static function getForSelect() {
        return self::select(['id', 'name', 'code'])
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function getDataForEdit($id)
    {
        $teacher = self::where('id', $id)
            ->with([
                'image',
                'galleries' => function ($q) {
                    $q->select(['id', 'course_id', 'sort'])
                        ->with(['image'])
                        ->orderBy('sort', 'ASC');
                },
            ])
            ->firstOrFail();

        return $teacher;
    }


    public static function getDataForShow($id) {
        return self::where('id', $id)
            ->firstOrFail();
    }

    public function canEdit()
    {
        return Auth::user()->id == $this->created_by;
    }

    public function syncGalleries($galleries)
    {
        if ($galleries) {
            $exist_ids = [];
            foreach ($galleries as $g) {
                if (isset($g['id'])) array_push($exist_ids, $g['id']);
            }

            $deleted = CourseGallery::where('course_id', $this->id)->whereNotIn('id', $exist_ids)->get();
            foreach ($deleted as $item) {
                $item->removeFromDB();
            }

            for ($i = 0; $i < count($galleries); $i++) {
                $g = $galleries[$i];

                if (isset($g['id'])) $gallery = CourseGallery::find($g['id']);
                else $gallery = new CourseGallery();

                $gallery->course_id = $this->id;
                $gallery->sort = $i;
                $gallery->save();

                if (isset($g['image'])) {
                    if ($gallery->image) $gallery->image->removeFromDB();
                    $file = $g['image'];
                    FileHelper::uploadFile($file, 'course_gallery', $gallery->id, CourseGallery::class, 'image');
                }
            }
        }
    }

}
