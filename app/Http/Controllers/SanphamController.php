<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sanpham;

class SanphamController extends Controller
{
    //
    public function index(){
    	$sanpham = Sanpham::where('id','>=',3)->paginate(3)->setPatch('sp quoc noi');
    	return view('sanpham',['sanpham'=>$sanpham]);
    }
}
