<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Theloai;
Route::get('/', function () {
    return view('welcome');
});

Route::get('th', function(){
	$theloai= Theloai::find(1);
	foreach ($theloai ->loaitin as $loaitin) {
		echo $loaitin->Ten."<br>";
	}

});

Route::get('admin/dangnhap', 'UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getDangxuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'AdminLogin'], function(){
	Route::group(['prefix'=>'theloai'], function(){
		//admin/theloai/them
         Route::get('danhsach', 'TheloaiController@getDanhsach');
         Route::get('them', 'TheloaiController@getThem');
         Route::post('them', 'TheloaiController@postThem');
         Route::get('sua/{id}', 'TheloaiController@getSua');
         Route::post('sua/{id}', 'TheloaiController@postSua');
         Route::get('xoa/{id}', 'TheloaiController@getXoa');
	});

	Route::group(['prefix'=>'loaitin'], function(){
		//admin/theloai/them
         Route::get('danhsach', 'LoaitinController@getDanhsach');
         Route::get('them', 'LoaitinController@getThem');
         Route::post('them', 'LoaitinController@postThem');
         Route::get('sua/{id}', 'LoaitinController@getSua');
         Route::post('sua/{id}', 'LoaitinController@postSua');
         Route::get('xoa/{id}', 'LoaitinController@getXoa');
	});

	Route::group(['prefix'=>'tintuc'], function(){
		//admin/theloai/them
         Route::get('danhsach', 'TintucController@getDanhsach');
         Route::get('them', 'TinTucController@getThem');
         Route::post('them', 'TintucController@postThem');
         Route::get('sua/{id}', 'TintucController@getSua');
         Route::post('sua/{id}', 'TintucController@postSua');
         Route::get('xoa/{id}', 'TintucController@getXoa');
	});
   Route::group(['prefix'=>'comment'], function(){
      //admin/theloai/them
         Route::get('xoa/{id}/{idTintuc}', 'CommentController@getXoa');
   });

   Route::group(['prefix'=>'slide'], function(){
      //admin/theloai/them
         Route::get('danhsach', 'SlideController@getDanhsach');
         Route::get('them', 'SlideController@getThem');
         Route::post('them', 'SlideController@postThem');
         Route::get('sua/{id}', 'SlideController@getSua');
         Route::post('sua/{id}', 'SlideController@postSua');
         Route::get('xoa/{id}', 'SlideController@getXoa');
   });


   Route::group(['prefix'=>'user'], function(){
      //admin/theloai/them
         Route::get('danhsach', 'UserController@getDanhsach');
         Route::get('them', 'UserController@getThem');
         Route::post('them', 'UserController@postThem');
         Route::get('sua/{id}', 'UserController@getSua');
         Route::post('sua/{id}', 'UserController@postSua');
         Route::get('xoa/{id}', 'UserController@getXoa');
   });

   Route::group(['prefix'=>'ajax'], function(){
      Route::get('loaitin/{idTheloai}','AjaxController@getLoaitin');
   });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('trangchu','PageController@trangchu');

Route::get('lienhe','PageController@lienhe');

Route::get('loaitin/{id}/{TenKhongDau}.html', 'PageController@loaitin');

Route::get('tintuc/{id}/{TieuDeKhongDau}.html', 'PageController@tintuc');

Route::get('dangnhap', 'PageController@getDangnhap');
Route::post('dangnhap', 'PageController@postDangnhap');
Route::get('dangxuat', 'PageController@getDangxuat');

Route::get('nguoidung', 'PageController@getNguoidung');
Route::post('nguoidung', 'PageController@postNguoidung');

Route::get('dangki', 'PageController@getDangki');
Route::post('dangki', 'PageController@postDangki');


Route::post('comment/{id}', 'CommentController@postComment');

Route::post('timkiem', 'PageController@timkiem');





