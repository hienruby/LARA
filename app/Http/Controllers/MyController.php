<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class MyController extends Controller
{
    public function Xinchao(){
 echo " Xin chao cac ban";
    }
    public function KhoaHoc($ten){
    	echo "Khoa hoc :".$ten;
    	return redirect()->route('myroute2');

    }
    public function GetUrl(Request $request){
    	//return $request->url();
    	//if($request->isMethod('get')){
    	//	echo "phuong thuc get";
    	//}
    	//else{
    	//	echo 'ko phai phuong thuc get';
    	//}
    	if($request->is('My*')){
    		echo "co my";
    	}
    	else{
    		echo "khong co my";
    	}

    }
    public function postForm(Request $request)
    {
	echo $request->HoTen;
    }

    public function setCookie()
    {
       $response = new Response();
       $response->withCookie('KhoaHoc','Laravel-Hienruby',0.1);
       echo "da set cookie";
       return $response;
    }
   
   public function getCookie(Request $request){
    return $request->cookie('KhoaHoc');

   }

   public function postFile(Request $request){
    if($request->hasFile('myFile')){

        $file = $request ->file('myFile');
        if($file->getClientOriginalExtension('myfile')=="PNG"){
        $filename = $file->getClientOriginalName('myFile');
        //echo $filename;
        $file->move('img',$filename);
        echo "da luu file:".$filename;
    } else{
        echo "Khong duoc phep upload file";
    }
    }else{
        echo "chua co file";
    }
   }

   public function getJson(){
    //$array = ['Laravel', 'Php', 'Asp.net', 'Html'];
    $array = ['KhoaHoc'=>'Laravel'];
    return response()->json($array);
   }

   public function myView(){
    return view('view.hienruby');
   }

   public function Time($t)
{
    return view('myView', ['t'=>$t]);
}

public function blade($str){
    $khoahoc = "Laravel-Hienruby";
    if($str =="laravel"){
        return view('pages.laravel',['khoahoc'=>$khoahoc]);

    }elseif($str=="php"){
       return view('pages.php', ['khoahoc'=>$khoahoc]);
    }
}

    

}
