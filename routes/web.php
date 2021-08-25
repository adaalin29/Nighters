<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@home');
// Route::get('/produse/{slug}','ProduseController@produse');
// Route::get('/produse', function () {
//   return view('produse');
// });



Route::get('/influenceri', 'InfluenceriController@influenceri');

Route::get('/404', function () {
  return view('404');
});
//sortare produse home
Route::post('/sort_promotii_category','HomeController@sort_promotii_category');

Route::post('/produs/schimba_pret','ProduseController@schimba_pret');
Route::post('/arata/produse_noi','ProduseController@produse_noi');
Route::post('/arata/produse_recomandate','ProduseController@produse_recomandate');
Route::post('/arata/arata_cele_mai','ProduseController@arata_cele_mai');
Route::post('/arata/produse_promotie','ProduseController@produse_promotie');
Route::post('/arata/afisare_produse_slug','ProduseController@afisare_produse_slug');

// Cart product group
Route::post('/product/add-product','CartController@add_product');
Route::post('/product/delete-product','CartController@delete_product');
Route::post('/product/decrease-qt','CartController@decrease_qt_product');
Route::post('/product/increase-qt','CartController@increase_qt_product');
Route::get('/show_cart','CartController@show_cart');
Route::get('/cos_gol','CartController@cos_gol');
Route::post('/modifica_cantitate','CartController@modifica_cantitate');
Route::post('/sterge','CartController@sterge_cos');

// Order with all functions

Route::post('/trimite-comanda', 'OrderController@place_order');
Route::post('confirm-order', 'OrderController@confirm_order');
Route::get('confirm-order', 'OrderController@confirm_order');
Route::get('return-order', 'OrderController@order_preview');
Route::post('preview-order', 'OrderController@order_preview');
// Route::get('getOrderInvoice/{order_id}', 'OrderController@getOrderInvoice');
Route::get('preview_mail', 'OrderController@preview_mail');

// Preview order after sending
// Route::post('/cart-preview-order','CartController@increase_qt_product');

Route::get('/produse/{slug}','ProduseController@categorii');
Route::get('/produse/{slug}/noutati','ProduseController@noutati');
Route::get('/produse/{categorie}/{subcategorie}','ProduseController@categorii_subcategorii');

Route::get('/produs/{slug}','ProduseController@produs');

Route::get('/promotii','ProduseController@promotii');


Route::get('/checkout','CartController@checkout');
Route::get('/checkout_content','CartController@checkout_content');

Route::get('/politica','PolController@politica');

Route::get('/termeni','TermeniController@termeni'); 
Route::get('/politica_cookies','TermeniController@cookies'); 
Route::get('/politica_retur','TermeniController@retur'); 

Route::get('getOrderInvoice/{order_id}', 'OrderController@getOrderInvoice');

Route::get('search-prod', 'SearchController@listSearch');
Route::post('listare-search', 'SearchController@search');

// Account
Route::post('/inregistreaza_user','AccountsController@register'); // register user
Route::post('/login','AccountsController@login'); // login user
Route::post('/facebook-login','AccountsController@facebookLogin'); // login user
Route::get('/out','AccountsController@out');//log out
Route::post('/uitat_parola','AccountsController@uitat_parola'); // uitat parola;
Route::get('/parola_noua_mail','AccountsController@parola_page'); // pagina paroal;
Route::post('/schimba_parola_mail','AccountsController@schimba_parola_email'); // schimba paroal email;
Route::group(['prefix' => 'user'], function () 
  {
    Route::get('cont', 'ContController@cont')->middleware('auth.website'); // account page
    Route::post('/detalii_cont', 'AccountsController@detalii_cont')->middleware('auth.website'); // detalii cont
    Route::post('/modifica_date_user','AccountsController@modifica_date')->middleware('auth.website'); // modifica date cont
    Route::post('/date_livrare','AccountsController@date_livrare')->middleware('auth.website'); // date livrare
    Route::post('/adauga_adresa_livrare','AccountsController@adauga_adresa_livrare')->middleware('auth.website'); // adauga date livrare
    Route::post('/detalii_adresa_livrare','AccountsController@detalii_adresa_livrare')->middleware('auth.website'); // detalii adresa livrare
    Route::post('/modifica_adresa_livrare','AccountsController@modifica_adresa_livrare')->middleware('auth.website'); // modifca adresa livrare
    Route::post('/modifica_adresa_facturare','AccountsController@modifica_adresa_facturare')->middleware('auth.website'); // modifca adresa livrare
    Route::post('/sterge_adresa_livrare','AccountsController@sterge_adresa_livrare')->middleware('auth.website'); // sterge adresa livrare
    Route::post('/sterge_adresa_facturare','AccountsController@sterge_adresa_facturare')->middleware('auth.website'); // sterge adresa livrare
    Route::post('/date_facturare','AccountsController@date_facturare')->middleware('auth.website'); // date facturare
    Route::post('/adauga_adresa_facturare','AccountsController@adauga_adresa_facturare')->middleware('auth.website'); // adauga adresa facturare
    Route::post('/show_wishlist','AccountsController@show_wishlist')->middleware('auth.website'); // see wishlist
    Route::post('/crud_wishlist','AccountsController@crud_wishlist')->middleware('auth.website'); // see wishlist
    Route::post('/detalii_adresa_facturare','AccountsController@detalii_adresa_facturare')->middleware('auth.website'); // detalii adresa livrare
    Route::get('/istoric_comenzi','AccountsController@istoric_comenzi')->middleware('auth.website'); // detalii adresa livrare
    Route::post('/order-content','AccountsController@order_content')->middleware('auth.website'); // detalii adresa livrare
    
  }
);

Route::post('/show_subcategories','Controller@show_subcategories'); 

// Contact
Route::get('/contact','ContactController@contact'); // contact page
Route::post('/mail_contact','ContactController@mail_contact'); // trimite mail contact
Route::post('/inregistreaza_newsletter','ContactController@inregistreaza_newsletter'); // inregistreaza newsletter
Route::post('/send-rating','RecenziiController@sendRating'); // trimite rating



Route::get('counties', 'FanCourierController@getCounties');
Route::post('cities', 'FanCourierController@getCities');
Route::post('citiesWithId', 'FanCourierController@getCitiesWithId');
Route::post('cityAgentie', 'FanCourierController@getCitiesAgency');
Route::get('km-exteriori/{id_localitate}', 'FanCourierController@getKmExteriori');
Route::get('getSedii/{localitate}', 'FanCourierController@getSedii');
Route::get('test', 'FanCourierController@test');


Route::get('/storage/thumb/{query}/{file?}', 'ThumbController@index')
    ->where([
        'query' => '[A-Za-z0-9\:\;\-]+',
        'file'  => '[A-Za-z0-9\/\.\-\_]+',
    ])
    ->name('thumb');

// Route::get('/produse/get/', 'ProduseController@get_produse_list');
Route::any('/produsee/{slug}/{subcategorie}','ProduseController@get_produse_list');
Route::any('/produsee/culoare/','ProduseController@get_produse_by_color');
Route::any('/produsee/filtru/','ProduseController@filtrare_produse');
Route::any('/promotiii','ProduseController@get_promotii_data');
Route::any('/noutatiii/categorie','ProduseController@get_noutati_data'); 
Route::get('/populeaza_cu_adrese','CartController@populeaza_cu_adrese')->middleware('auth.website'); // populeaza cu adrese de livrare

Route::get('/colectii/{slug}','ProduseController@colectie'); 
Route::post('/ordoneaza_colectie','ProduseController@ordoneaza_colectie'); 
Route::post('/get_colectie_by_color','ProduseController@get_colectie_by_color'); 
Route::any('/colectii','ProduseController@get_noutati_data'); 
Route::any('/aplica_voucher','CartController@aplica_voucher'); 

Route::post('/subscribe_user','Controller@subscribe_user'); 
Route::post('/cauta','Controller@cauta'); 
Route::any('/search','ProduseController@cautare'); 
Route::any('/cautare','Controller@get_cautare_data'); 


Route::any('/check_birthdays','Controller@check_birthdays'); 
Route::get('/exportCsv','ProduseController@exportCsv'); 