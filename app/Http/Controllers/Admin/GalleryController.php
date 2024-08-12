<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Course;
use App\Model\Admin\Gallery;
use Illuminate\Http\Request;
use App\Model\Admin\Course as ThisModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use \stdClass;

use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Helpers\FileHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\Common\Customer;

class GalleryController extends Controller
{

    public function index()
    {
        $obj = Gallery::query()->with(['galleries'])->where('id', 1)->get();

        $obj = $obj->map(function ($item) {
            $item->galleries = $item->galleries->map(function ($g) {
                $g->image = ['path' => $g->path];

                return $g;
            });
            return $item;
        })->first();


        return view('admin.gallery.index', compact(['obj']));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $json = new stdClass();
            $object = Gallery::query()->find(1);

            $object->syncGalleries($request->galleries);
            $object->save();

            DB::commit();
            $json->success = true;
            $json->message = "Thao tác thành công!";
            $json->data = $object;
            return Response::json($json);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

}
