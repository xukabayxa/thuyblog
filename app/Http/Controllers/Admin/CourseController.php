<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Course;
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

class CourseController extends Controller
{
    public function index()
    {
        return view('admin.courses.index');
    }

    // Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {
        $objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
            ->editColumn('updated_by', function ($object) {
                return $object->user_update->name ?: '';
            })
            ->editColumn('created_by', function ($object) {
                return $object->user_create->name ?: '';
            })
            ->editColumn('updated_by', function ($object) {
                return $object->user_update->name ?: '';
            })
            ->addColumn('schedule', function ($object) {
                return Carbon::parse($object->time_start)->format('H:i') . ' - ' . Carbon::parse($object->time_end)->format('H:i');
            })
            ->editColumn('updated_at', function ($object) {
                return formatDate($object->updated_at);
            })

            ->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';
                if ($object->canEdit()) {
                    $result = $result . ' <a href="'. route('Courses.edit', $object->id) .'" title="sửa" class="dropdown-item"><i class="fa fa-angle-right"></i>Sửa</a>';
                    $result = $result . ' <a href="' . route('Courses.delete', $object->id) . '" title="xóa" class="dropdown-item confirm"><i class="fa fa-angle-right"></i>Xóa</a>';
                }
                $result = $result . '</div></div>';
                return $result;
            })
            ->addIndexColumn()
            ->rawColumns(['name','action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'image' => 'required|file|mimes:jpg,jpeg,png|max:3000',
                'short_des' => 'required',
                'description' => 'required',
                'learn_day' => 'required',
                'age' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
                'galleries' => 'nullable|array|min:1|max:20',
                'galleries.*.image' => 'nullable|file|mimes:png,jpg,jpeg|max:30000',
            ]
        );
        $json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
        }

        DB::beginTransaction();
        try {
            $object = new ThisModel();

            $object->code = randomString(6);
            $object->title = $request->title;
            $object->short_des = $request->short_des;
            $object->description = $request->description;
            $object->learn_day = $request->learn_day;
            $object->age = $request->age;
            $object->time_start = $request->time_start;
            $object->time_end = $request->time_end;
            $object->price = $request->price;
            $object->status = $request->status;
            $object->is_main = $request->is_main;

            $object->save();

            $image =  FileHelper::uploadFile($request->image, 'courses', $object->id, ThisModel::class, 'image',1);
            $banner = FileHelper::uploadFile($request->image, 'courses', $object->id, ThisModel::class, 'banner',8);

            $object->avatar = $image['path'];
            $object->cover_image = $banner['path'];

            $object->save();

            $object->generateCode();
            $object->syncGalleries($request->galleries);

            DB::commit();
            $json->success = true;
            $json->message = "Thao tác thành công!";
            $json->data = $object;
            return Response::json($json);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            throw new \Exception($e->getMessage());
        }
    }

    public function edit($id)
    {
        $object = ThisModel::getDataForEdit($id);
        $object->from_time = Carbon::parse($object->from_time)->format('d/m/Y');
        $object->end_time = Carbon::parse($object->end_time)->format('d/m/Y');

        return view('admin.courses.edit', compact('object'));
    }

    public function update(Request $request, $id)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'short_des' => 'required',
                'description' => 'required',
                'learn_day' => 'required',
                'age' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
                'galleries' => 'nullable|array|min:1|max:20',
                'galleries.*.image' => 'nullable|file|mimes:png,jpg,jpeg|max:30000',
            ]
        );
        $json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
        }

        DB::beginTransaction();
        try {
            $object = ThisModel::findOrFail($id);
            $object->title = $request->title;
            $object->short_des = $request->short_des;
            $object->description = $request->description;
            $object->learn_day = $request->learn_day;
            $object->age = $request->age;
            $object->time_start = $request->time_start;
            $object->time_end = $request->time_end;
            $object->price = $request->price;
            $object->status = $request->status;
            $object->is_main = $request->is_main;

            $object->save();

            if($request->image) {
                if($object->image) {
                    FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
                    FileHelper::forceDeleteFiles($object->banner->id, $object->id, ThisModel::class, 'banner');
                }
                $image =  FileHelper::uploadFile($request->image, 'courses', $object->id, ThisModel::class, 'image',1);
                $banner = FileHelper::uploadFile($request->image, 'courses', $object->id, ThisModel::class, 'banner',8);

                $object->avatar = $image['path'];
                $object->cover_image = $banner['path'];

                $object->save();
            }

            $object->syncGalleries($request->galleries);

            DB::commit();
            $json->success = true;
            $json->message = "Thao tác thành công!";
            $json->data = $object;
            return Response::json($json);
        } catch (Exception $e) {
            Log::info($e);
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function show(Request $request,$id)
    {
        $object = ThisModel::findOrFail($id);
        if (!$object->canview()) return view('not_found');
        $object = ThisModel::getDataForShow($id);
        return view($this->view.'.show', compact('object'));
    }


    public function delete($id)
    {
        $object = ThisModel::findOrFail($id);
        if (!$object->canEdit()) {
            $message = array(
                "message" => "Không thể xóa!",
                "alert-type" => "warning"
            );
        } else {
            $object->delete();
            $message = array(
                "message" => "Thao tác thành công!",
                "alert-type" => "success"
            );
        }

        return redirect()->route('Courses.index')->with($message);
    }

    public function getDataForEdit($id) {
        $json = new stdclass();
        $json->success = true;
        $json->data = ThisModel::getDataForEdit($id);
        return Response::json($json);
    }

    // Xuất Excel
    public function exportExcel(Request $request)
    {
        return (new FastExcel(ThisModel::searchByFilter($request)))->download('danh_sach_lich_hen.xlsx', function ($object) {
            return [
                'Khách hàng' => $object->customer->name,
                'SĐT khách' => $object->customer->mobile,
                'Giờ hẹn' => \Carbon\Carbon::parse($object->booking_time)->format('H:m d/m/Y'),
                'Ghi chú' => $object->note,
                'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
            ];
        });
    }

    // Xuất PDF
    public function exportPDF(Request $request) {
        $data = ThisModel::searchByFilter($request);
        $pdf = \Barryvdh\DomPDF\PDF::loadView($this->view.'.pdf', compact('data'));
        return $pdf->download('danh_sach_lich_hen.pdf');
    }
}
