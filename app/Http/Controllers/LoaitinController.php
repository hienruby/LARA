<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;
use App\Loaitin;

class LoaitinController extends Controller
{
    //
    //
    public function getDanhsach()
    {
      $loaitin = Loaitin::all();
      return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
     
     public function getThem()
     {
     	$theloai = Theloai::all();
    	return view('admin.loaitin.them', ['theloai'=>$theloai]);
    }
     public function postThem(Request $request)
     {
     	$this->validate($request, 
     		[
     			'Ten'=>'required|unique:Loaitin,Ten|min:1|max:100',
     			'Theloai'=>'required'
     		],
     		[
     			'Ten.required'=>'Ban chua nhap ten loai tin',
     			'Ten.unique'=>'Ten loai tin da ton tai',
     			'Ten.min'=>'Ten loai tin co do dai tu 1-100 ki tu',
     			'Ten.max'=>'Ten loai tin co do dai tu 1-100 ki tu',
     			'Theloai.required'=>'ban chua chon the loai' 		 
     		]);
        $loaitin= new Loaitin;
     	$loaitin->Ten = $request->Ten;
     	$loaitin->TenKhongDau = changeTitle($request->Ten);
     	$loaitin->idTheLoai = $request->Theloai;
     	$loaitin->save();

     	return redirect('admin/loaitin/them')->with('thongbao','ban da them thanh cong');
     	
     	echo $request->Ten;
     	
    }
    public function getSua($id)
     {
     	$theloai = Theloai::all();
     	$loaitin = Loaitin::find($id);
     	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
     {
     	$this->validate($request, 
     		[
     			'Ten'=>'required|unique:Loaitin,Ten|min:1|max:100',
     			'Theloai'=>'required'
     		],
     		[
     			'Ten.required'=>'Ban chua nhap ten loai tin',
     			'Ten.unique'=>'Ten loai tin da ton tai',
     			'Ten.min'=>'Ten loai tin co do dai tu 1-100 ki tu',
     			'Ten.max'=>'Ten loai tin co do dai tu 1-100 ki tu',
     			'Theloai.required'=>'ban chua chon the loai' 		 
     		]);
     	$loaitin = Loaitin::find($id);

     	$loaitin->Ten = $request->Ten;

     	$loaitin->TenKhongDau = changeTitle($request->Ten);
     	$loaitin->idTheLoai = $request->Theloai;
     	$loaitin->save();

     	 return redirect('admin/loaitin/sua/'.$loaitin->id)->with('thongbao', 'Sua thanh cong');
     	 
     	
    }
    public function getXoa($id)
    {
        $loaitin = Loaitin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Ban da xoa thanh cong');

    }
}
