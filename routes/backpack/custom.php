<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('sedii', 'SediiCrudController');
    Route::crud('newsletter', 'NewsletterCrudController');
    Route::crud('categoriiproduse', 'CategoriiProduseCrudController');
    Route::crud('subcategorii', 'SubcategoriiCrudController');
    Route::crud('recenzii', 'RecenziiCrudController');
    Route::crud('swiper', 'SwiperCrudController');
    Route::crud('desprenoi', 'DespreNoiCrudController');
    Route::crud('politica', 'PoliticaCrudController');
    Route::crud('termeni', 'TermeniCrudController');
    Route::crud('products', 'ProductsCrudController');
  
    Route::post('products/{id}/upload_images', 'ProductsCrudController@ajaxUploadImages');
    Route::post('products/{id}/reorder_images', 'ProductsCrudController@ajaxReorderImages');
    Route::post('products/{id}/delete_image', 'ProductsCrudController@ajaxDeleteImage');
  
    Route::crud('order', 'OrderCrudController');
    Route::get('show-awb/{awb}', '\App\Http\Controllers\FanCourierController@printAwb');
    Route::crud('orderproduct', 'OrderproductCrudController');
    Route::get('view_invoice/{order_id}', 'OrderCrudController@view_invoice');
    Route::post('get-raport', 'RapoarteController@getRapoarteData');
    Route::post('get-order-info', 'OrderCrudController@getOrderInfo');
    Route::post('generate-awb', '\App\Http\Controllers\FanCourierController@generateAwb');
    Route::crud('polcookie', 'PolCookieCrudController');
    Route::crud('polretur', 'PolReturCrudController');
    Route::crud('color', 'ColorCrudController');
    Route::crud('size', 'SizeCrudController');
    Route::crud('influencer', 'InfluencerCrudController');
    Route::crud('collection', 'CollectionCrudController');
    Route::crud('collectionproduct', 'CollectionProductCrudController');
    Route::crud('subcategoryproduct', 'SubcategoryProductCrudController');
    Route::crud('voucher', 'VoucherCrudController');
    Route::crud('account', 'AccountCrudController');
    Route::crud('otherimage', 'OtherImageCrudController');
    Route::crud('meta', 'MetaCrudController');
    Route::get('products/export', 'ProductsCrudController@export_products');
    Route::crud('birthdayvoucher', 'BirthdayVoucherCrudController');
}); // this should be the absolute last line of this file