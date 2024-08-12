<?php

namespace App\Http\Controllers\Front;

use App\Http\Traits\ResponseTrait;
use App\Model\Admin\Banner;
use App\Model\Admin\Block;
use App\Model\Admin\Config;
use App\Model\Admin\Contact;
use App\Model\Admin\Course;
use App\Model\Admin\Feedback;
use App\Model\Admin\Gallery;
use App\Model\Admin\PostCategory;
use App\Model\Admin\Project;
use App\Model\Admin\Teacher;
use Illuminate\Http\Request;
use Validator;
use \stdClass;
use Response;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Product;
use App\Model\Admin\Post;
use DB;
use Mail;
use SluggableScopeHelpers;

class FrontController extends Controller
{
    use ResponseTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       $bannerTrangchu = Banner::query()->where('type', Banner::HOMEPAGE)->get();
       $block1Trangchu = Block::query()->where('id', 1)->first();
       $teachers = Teacher::query()->where('is_main', 1)->latest()->get();
       $courses = Course::query()->where('is_main', 1)->latest()->get();
       $galleries = Gallery::query()->with(['galleries'])->where('id', 1)->first();
       $posts = Post::query()->where(['status' => 1, 'pin' => 1])->latest()->get();
       $feedback = Feedback::query()->latest()->get();

       return view('site.index', compact('bannerTrangchu','block1Trangchu', 'teachers','courses','galleries','posts','feedback'));
    }


    // trang blog
    public function blog() {
        $posts = Post::query()->with(['category'])->where('status', 1)->latest()->get();
        $banner = Banner::query()->where('type', Banner::BLOG_PAGE)->first();
        $categories = PostCategory::getAll();

        return view('site.blog', compact('posts', 'banner', 'categories'));
    }

    // trang chi tiết blog
    public function blogDetail($slugCate, $slug = null) {
        if($slug) {
            $categories = PostCategory::getAll();
            $post = Post::findBySlug($slug);
            $postsRelated = Post::query()->where('cate_id', $post->category->id)
                ->whereNotIn('id', [$post->id])->latest()->limit(5)->get();
            $banner = Banner::query()->where('type', Banner::BLOG_DETAIL_PAGE)->first();

            return view('site.blog_detail', compact('post', 'postsRelated','categories', 'banner'));
        } else {
            $category = PostCategory::findBySlug($slugCate);
            $posts = Post::query()->whereHas('category', function ($q) use ($category){
                $q->where('post_categories.id', $category->id);
            })
                ->where('status', 1)->get();
            $banner = Banner::query()->where('type', Banner::BLOG_PAGE)->first();
            $categories = PostCategory::getAll();

            return view('site.blog', compact('posts', 'banner', 'categories'));
        }

    }

    // trang liên hệ
    public function contact(Request $request) {
        $banner = Banner::query()->where('type', Banner::CONTACT_PAGE)->first();

        return view('site.contact', compact('banner'));
    }
    // submit gửi liên hệ
    public function sendContact(Request $request)
    {
        $rule = [
            'user_name' => 'required',
            'content' => 'required',
            'email' => 'required|email',
        ];

        $translate =
            [
                'user_name.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không hợp lệ',
                'phone_number.required' => 'Vui lòng nhập số điện thoại',
                'cate_id.required' => 'Vui lòng nhập sản phẩm quan tâm',
                'phone_number.regex' => 'Số điện thoại không hợp lệ',
                'content.required' => 'Vui lòng nhập nội dung liên hệ',
            ];

        $validate = Validator::make(
            $request->all(),
            $rule,
            $translate
        );

        $json = new stdClass();

        if ($validate->fails()) {
            $json->success = false;
            $json->errors = $validate->errors();
            return Response::json($json);
        }

        $contact = new Contact();
        $contact->user_name = $request->user_name;
        $contact->email = $request->email;
        $contact->phone_number = $request->phone_number;
        $contact->content = $request->content;
        $contact->address = $request->address;
        $contact->subject = $request->subject;

        $contact->save();

        return $this->responseSuccess();
    }

    // trang about
    public function about(Request $request) {
        $config = Config::query()->first();
        $banner = Banner::query()->where('type', Banner::ABOUT_PAGE)->first();

        return view('site.about', compact('config', 'banner'));
    }
}
