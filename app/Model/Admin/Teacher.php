<?php

namespace App\Model\Admin;
use Illuminate\Support\Facades\Auth;
use App\Model\BaseModel;
use App\Model\Common\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Common\File;
use DB;
use App\Model\Common\Notification;

class Teacher extends BaseModel
{
    public const cates = [
        1 => 'Ban giám hiệu',
        2 => 'Điều phối chương trình Tiếng Anh',
        3 => 'Giáo viên',
    ];

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

    public static function searchByFilter($request) {
        $result = self::with([
            'user',
        ]);

        if (!empty($request->fullname)) {
            $result = $result->where('fullname', 'like', '%'.$request->fullname.'%');
        }

        if (!empty($request->phone_number)) {
            $result = $result->where('phone_number', $request->fullname);
        }

        if (!empty($request->email)) {
            $result = $result->where('email', $request->email);
        }

        if (!empty($request->cate_id)) {
            $result = $result->where('cate_id', $request->cate_id);
        }

        if (!empty($request->address)) {
            $result = $result->where('address', 'like', '%'.$request->address.'%');
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

}
