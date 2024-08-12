<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Teacher;
use Illuminate\Http\Request;
use App\Model\Admin\Teacher as ThisModel;
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

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teachers.index');
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
                return $object->user_update->name ?: '';
            })
            ->editColumn('updated_at', function ($object) {
                return formatDate($object->updated_at);
            })
            ->editColumn('cate_id', function ($object) {
               return @Teacher::cates[$object->cate_id] ?? '';
            })
            ->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';
                if ($object->canEdit()) {
                    $result = $result . ' <a href="'. route('Teacher.edit', $object->id) .'" title="sửa" class="dropdown-item"><i class="fa fa-angle-right"></i>Sửa</a>';
                    $result = $result . ' <a href="' . route('Teacher.delete', $object->id) . '" title="xóa" class="dropdown-item confirm"><i class="fa fa-angle-right"></i>Xóa</a>';
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
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'fullname' => 'required|max:255',
                'phone_number' => 'required|unique:teachers,phone_number|regex:/^(0)[0-9]{9,11}$/',
                'email' => 'required|email|unique:teachers,email',
                'address' => 'required',
                'cate_id' => 'required|in:1,2,3',
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

            $object->fullname = $request->fullname;
            $object->phone_number = $request->phone_number;
            $object->email = $request->email;
            $object->address = $request->address;
            $object->experience = $request->experience;
            $object->facebook = $request->facebook;
            $object->twitter = $request->twitter;
            $object->instagram = $request->instagram;
            $object->content = $request->content;
            $object->status = $request->status;
            $object->is_main = $request->is_main;
            $object->cate_id = $request->cate_id;

            $object->save();

            $image =  FileHelper::uploadFile($request->image, 'teachers', $object->id, ThisModel::class, 'image',1);
            $banner = FileHelper::uploadFile($request->image, 'teachers', $object->id, ThisModel::class, 'banner',8);

            $object->avatar = $image['path'];
            $object->cover_image = $banner['path'];

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

    public function edit($id)
    {
        $object = ThisModel::getDataForEdit($id);

        return view('admin.teachers.edit', compact('object'));
    }

    public function update(Request $request, $id)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'fullname' => 'required|max:255',
                'phone_number' => 'required|regex:/^(0)[0-9]{9,11}$/|unique:teachers,phone_number,'.$id,
                'email' => 'required|email|unique:teachers,email,'. $id,
                'address' => 'required',
                'cate_id' => 'required|in:1,2,3',

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
            $object->fullname = $request->fullname;
            $object->phone_number = $request->phone_number;
            $object->email = $request->email;
            $object->address = $request->address;
            $object->experience = $request->experience;
            $object->facebook = $request->facebook;
            $object->twitter = $request->twitter;
            $object->instagram = $request->instagram;
            $object->content = $request->content;
            $object->status = $request->status;
            $object->is_main = $request->is_main;
            $object->cate_id = $request->cate_id;

            $object->save();

            if($request->image) {
                if($object->image) {
                    FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
                    FileHelper::forceDeleteFiles($object->banner->id, $object->id, ThisModel::class, 'banner');
                }
               $image =  FileHelper::uploadFile($request->image, 'teachers', $object->id, ThisModel::class, 'image',1);
               $banner = FileHelper::uploadFile($request->image, 'teachers', $object->id, ThisModel::class, 'banner',8);

               $object->avatar = $image['path'];
               $object->cover_image = $banner['path'];

               $object->save();
            }

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

        return redirect()->route('Teacher.index')->with($message);
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
