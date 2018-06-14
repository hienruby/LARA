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

Route::get('/', function () {
    return view('welcome');
});

Route::get('KhoaHoc', function(){
	return "Xin chao cac ban";
});
Route::get('Hienruby/Laravel',function(){

	echo "<h1>HIEN RUBY</h1>";
});

Route::get('HoTen/{ten}',function($ten){
	return "CHAO BAN ".$ten;
});

Route::get('Laravel/{ngay}', function($ngay){
	return "ngay".$ngay;

})->where(['ngay'=>'[0-9]+']);

//Dinh danh
Route::get('myroute', ['as'=>'newname', function(){
	echo " xin chao cac ban";
}]	
);
 Route::get('Route2', function(){
 	echo " day la route2";
 })->name('myroute2');
Route::get('goiten', function(){
	return redirect()->route('myroute2');
});

//Group

Route::group(['prefix'=>'MyGroup'], function(){
	Route::get('User1', function(){
		echo "User";
	});
	Route::get('User2', function(){
		echo "User2";
	});
	Route::get('User3', function(){
		echo "User3";
	});
});

//Goi Controller
Route::get('GoiController','MyController@Xinchao');

Route::get('Thamso/{ten}','MyController@KhoaHoc');

//URL
Route::get('MyRequest', 'MyController@GetUrl');


// GUi nhan du lieu voi request

Route::get('getForm', function(){
	return view('postform');
});

Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);

//Cookie

Route::get('setCookie', 'MyController@setCookie');

Route::get('getCookie', 'MyController@getCookie');

Route::get('uploadfile', function(){
	return view('postFile');
});
Route::post('postFile',['as'=>'postFile', 'uses' => 'MyController@postFile']);


//Json
Route::get('getJson', 'MyController@getJson');


//View
Route::get('myView', 'MyController@myView');

Route::get('Time/{t}', 'MyController@Time');

View::share('KhoaHoc','Laravel');

//Blade template

Route::get('blade',function(){
	return view('pages.php');
});

Route::get('BladeTemplate/{str}', 'MyController@blade');

//Database

Route::get('database', function(){
	Schema::create('nguoidung', function($table){
		$table->increments('id');
		$table->string('ten',200)->nullable();
		$table->string('nsx')->default("Nha san xuat");
	});
	echo "Da thuc hien tao bang";
});

Route::get('lienketbang', function(){
	Schema::create('sanpham', function($table){
		$table->increments('id');
		$table->string('ten');
		$table->float('gia');
		$table->integer('soluong')->default(0);
		$table->integer('id_loaisanpham')->unsigned();
		$table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
	});
	echo "da tao bang san pham";
});


Route::get('themcot',function(){
	Schema::table('theloai', function($table){
		$table->string('Email');
	});
	echo " Da them cot Email";
});

Route::get('doiten', function(){
	Schema::rename('theloai','nguoidung');
	echo " Da sua ten bang";
});

Route::get('xoabang', function(){
	Schema::dropIfExists('nguoidung');
	echo "Da xoa bang NGUOI DUNG";
});

//QueryBuilder

Route::get('qb/get', function(){
	$data = DB::table('users')->get();
	//var_dump($data);
	foreach ($data as $row ) {
		foreach ($row as $key => $value) {
			echo $key.":".$value;

		}
		echo "<hr>";
	}

});

//select * from users where id=2
Route::get('qb/where', function(){
	$data = DB::table('users')->where('id','=',2)->get();
	//var_dump($data);
	foreach ($data as $row ) {
		foreach ($row as $key => $value) {
			echo $key.":".$value;

		}
		echo "<hr>";
	}

});
//select id, name, email from where...

Route::get('qb/select', function(){
	$data = DB::table('users')->select(['id', 'name', 'email'])->where('id',2)->get();
	foreach ($data as $row ) {
		foreach ($row as $key => $value) {
			echo $key." : ".$value;
		}
		echo "<hr>";
	}
});

//select name as hoten from...
Route::get('qb/raw', function(){
	$data = DB::table('users')->select(DB::raw('id, name as hoten, email'))->where('id',2)->get();
	foreach ($data as $row ) {
		foreach ($row as $key => $value) {
			echo $key." : ".$value;
		}
		echo "<hr>";
	}
});

Route::get('qb/orderby', function(){
	$data = DB::table('users')->select(DB::raw('id, name as hoten, email'))->orderby('id','desc')->get();
	foreach ($data as $row ) {
		foreach ($row as $key => $value) {
			echo $key." : ".$value;
		}
		echo "<hr>";
	}
});

//limit 2,5
Route::get('qb/skip', function(){
	$data = DB::table('users')->select(DB::raw('id, name as hoten, email'))->orderby('id','desc')->skip(1)->take(2)->get();
	//echo $data->count();
	foreach ($data as $row ) {
		foreach ($row as $key => $value) {
			echo $key." : ".$value;
		}
		echo "<hr>";
	}
});

Route::get('qb/update', function(){
	DB::table('users')->where('id',1)->update(['name'=>'website'],'');
	echo  "da update";
});

Route::get('qb/delete', function(){
	DB::table('users')->where('id',1)->delete();
	echo  "da delete";
});

//Model

Route::get('model/save', function(){
	$user = new App\User();
	$user->name = 'Mai';
	$user->email = 'mai@gmail.com';
	$user->password ='matkhau';
	$user->save();
	echo "da thuc hien save()";
});

Route::get('model/query', function(){
    $user = App\User::find(5);
    echo $user->name;
});

Route::get('model/sanpham/save/{ten}', function($ten){
	$sanpham = new App\Sanpham();
	$sanpham->ten = $ten;
	$sanpham->soluong=100;
	$sanpham->id_loaisanpham=1;
	$sanpham->save();
	echo "DA LUU".$ten;
});

Route::get('model/sanpham/all', function(){
	$sanpham = App\Sanpham::all()->toArray();
	var_dump($sanpham);
});

Route::get('model/sanpham/ten', function(){
	$sanpham = App\Sanpham::where('ten', 'MAC')->get()->toArray();
	//var_dump($sanpham);
	echo $sanpham[0]['ten'];
});

Route::get('model/sanpham/delete', function(){
	App\Sanpham::destroy(3);
	echo "da xoa 3 ";
});


Route::get('taocot', function(){
      Schema::table('sanpham', function($table){
        $table->integer('id_loaisanpham')->unsigned();
      });
});

Route::get('lienket', function(){
    $data = App\Sanpham::find(2)->loaisanpham->toArray();
    var_dump($data);
});

Route::get('lienketloaisanpham', function(){
    $data = App\Loaisanpham::find(1)->sanpham->toArray();
    var_dump($data);
});


Route::get('diem', function(){
    echo "BAN DA du DIEM";
})->middleware('MyMiddle')->name('diem');
Route::get('loi', function(){
    echo "BAN CHUA du DIEM";
})->name('loi');

Route::get('nhapdiem', function(){
	return view('nhapdiem');

})->name('nhapdiem');

//Auth
Route::get('dangnhap', function(){
     return view('dangnhap');
});

Route::get('thu', function(){
 return view('thanhcong');
});
Route::post('login','AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout');

//Session

Route::group(['middleware'=>['web']], function(){
	Route::get('Session', function(){
		Session::put('KhoaHoc','Laravel');
		Session::put('Hienruby','Hienruby');
		echo " Da bat session";
		echo "<br>";
		//Session::forget('KhoaHoc');
        //Session::flush();
		//echo Session::get('KhoaHoc');
		Session::flash('mess', 'Hello');
		echo Session::get('mess');
		if(Session::has('KhoaHoc')){
			echo "  da co session";
		}else{
			echo "Session KhoaHoc khong ton tai";
		}
	});
	Route::get('Session/flash', function(){
        //echo Session::get('mess');
        echo session('mess');
	});
});
///
Route::get('sp', 'SanphamController@index');

