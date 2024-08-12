<?php

Route::group(['namespace' => 'Front'], function () {
    Route::get('/','FrontController@index')->name('front.home_page');
    Route::get('/teachers/{id}','FrontController@teacherDetail')->name('front.teacher-detail');
    Route::get('/teachers','FrontController@teachersList')->name('front.teachers-list');
    Route::get('/classes','FrontController@classesList')->name('front.classes-list');
    Route::get('/classes/{id}','FrontController@classesDetail')->name('front.classes-detail');
    Route::get('/blog','FrontController@blog')->name('front.blog');
    Route::get('/blog/{slugCate}/{slug?}','FrontController@blogDetail')->name('front.blog-detail');
    Route::get('/contact','FrontController@contact')->name('front.contact');
    Route::post('/send-contact','FrontController@sendContact')->name('send.contact');
    Route::get('/about','FrontController@about')->name('front.about');


//
//    Route::get('/san-pham','FrontController@productList')->name('front.product-list');
//    Route::get('/tin-tuc','FrontController@posts')->name('front.post-list');
//    Route::get('/du-an','FrontController@projects')->name('front.project-list');
//    Route::get('/ve-chung-toi','FrontController@about')->name('front.about');
//    Route::get('/lien-he','FrontController@contact')->name('front.contact');
//    Route::get('/danh-muc/{slug}/{childSlug?}','FrontController@productCategory')->name('front.product-category');
//    Route::get('/san-pham/{slug}','FrontController@productDetail')->name('front.product-detail');
//    Route::get('/tin-tuc/{slug}','FrontController@post')->name('front.post-detail');
//    Route::get('/du-an/{slug}','FrontController@project')->name('front.project-detail');
//    Route::post('/send-contact','FrontController@sendContact')->name('send.contact');
//    Route::get('/tim-kiem','FrontController@search')->name('front.search');

//
//    Route::get('/san-pham/123','FrontController@productDetail')->name('front.product-detail');
//    Route::get('/tin-tuc/123','FrontController@news')->name('front.news');
//    Route::get('/lien-he','FrontController@contact')->name('front.contact');
//
//    Route::get('/gio-hang','CartController@index')->name('cart');
//    Route::post('/{productId}/add-product-to-cart','CartController@addItem')->name('cart.add.item');
//    Route::get('/remove-product-to-cart','CartController@removeItem')->name('cart.remove.item');
//    Route::get('/update-cart','CartController@updateItem')->name('cart.update.item');
//    Route::get('/thanh-toan','CartController@checkout')->name('cart.get.checkout');
//    Route::post('/checkout','CartController@checkoutSubmit')->name('cart.post.checkout');
//    Route::get('/dat-hang-thanh-cong/{orderCode}','CartController@checkoutSuccess')->name('cart.checkout.success');
//    Route::post('/{productId}/add-to-wishlist','CartController@addToWishList')->name('cart.add.wishlist');
//    Route::get('/yeu-thich','CartController@wishList')->name('cart.wishlist');
//
//    Route::get('/shop/{categorySlug?}','FrontController@getCategory')->name('front.category_product');
//    Route::get('/load-more-products','FrontController@loadMoreProduct')->name('front.loadmore.products');
//    Route::get('/product/{id}/getData','FrontController@getDataProduct')->name('front.product.getData');
//    Route::get('/tin-tuc/{slug?}/{postSlug?}','FrontController@getPostCategory')->name('front.news');
//    Route::get('/bai-viet/{slug}','FrontController@getPostCategory')->name('front.news.detail');
//
//
//    Route::get('/lien-he','FrontController@contact')->name('front.contact');
//    Route::post('/send-contact','FrontController@sendContact')->name('send.contact');
//    Route::get('/tim-kiem','FrontController@search')->name('front.search');
//    Route::get('/suggest-result-search','FrontController@getSuggestSearchResult')->name('front.get.suggest.search');
//    Route::get('/gioi-thieu','FrontController@introduction')->name('front.about');
});



