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

class Gallery extends Model
{
    protected $table = 'gallery';
    public function syncGalleries($galleries)
    {
        if ($galleries) {
            $exist_ids = [];
            foreach ($galleries as $g) {
                if (isset($g['id'])) array_push($exist_ids, $g['id']);
            }

            File::where('model_id', $this->id)->where('model_type', Gallery::class)->whereNotIn('id', $exist_ids)->delete();

            for ($i = 0; $i < count($galleries); $i++) {
                $g = $galleries[$i];

                if (isset($g['image'])) {
                    $file = $g['image'];
                    FileHelper::uploadFile($file, 'gallery', $this->id, Gallery::class, 'image');
                }
            }
        } else {
            File::query()->where('model_type', Gallery::class)->delete();
        }
    }

    public function galleries()
    {
        return $this->morphMany(File::class, 'model');
    }
}
