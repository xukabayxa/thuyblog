<?php

namespace App\Http\View\Composers;

use App\Model\Admin\Category;
use App\Model\Admin\Config;
use App\Model\Admin\Gallery;
use App\Model\Admin\Partner;
use App\Model\Admin\Policy;
use App\Model\Admin\PostCategory;
use App\Model\Admin\Store;
use Illuminate\View\View;

class FooterComposer
{
    /**
     * Compose Settings Menu
     * @param View $view
     */
    public function compose(View $view)
    {
        $config = Config::query()->get()->first();
        $postCategories = PostCategory::query()->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        $galleries = Gallery::query()->with(['galleries' => function($q) {
            $q->limit('9');
        }])->where('id', 1)->first();


        $view->with(['config' => $config, 'post_categories' => $postCategories, 'galleries' => $galleries]);
    }
}
