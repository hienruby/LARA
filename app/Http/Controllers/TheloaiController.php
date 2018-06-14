<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;
class TheloaiController extends Controller
{
    //
    public function getDanhsach()
    {
      $theloai = Theloai::all();
      return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
     
     public function getThem()
     {
    	return view('admin.theloai.them');
    }
     public function postThem(Request $request)
     {
     	$this->validate($request,
        [
        	'Ten' => 'required|min:3|max:100|unique:Theloai'
     	],
     	[
     		'Ten.required' => 'Ban chua nhap ten the loai',
            'Ten.unique' => 'Ten the loai da ton tai',
     		'Ten.min' => 'Ten the loai phai co do dai tu 3 cho den 100 ki tu',
     		'Ten.max' => 'Ten the loai phai co do dai tu 3 cho den 100 ki tu',
     	]);
     	//echo $request->Ten;
    	//return view('admin.theloai.them');
    	$theloai = new Theloai;
    	$theloai->Ten = $request ->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao','Them thanh cong');
    }
    public function getSua($id)
     {
     	$theloai = Theloai::find($id);
    	return view('admin.theloai.sua', ['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
     {
        
    	$theloai = Theloai::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:theloai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Ban chua nhap ten the loai',
                'Ten.unique' => 'Ten the loai da ton tai',
                'Ten.min' => 'Ten the loai phai co do dai tu 3 cho den 100 ki tu',
                'Ten.max' => 'Ten the loai phai co do dai tu 3 cho den 100 ki tu',
            ]);
          //$theloai->update($request->all());
          $theloai->Ten = $request->Ten;
          $theloai->TenKhongDau = changeTitle($request->Ten);
          $theloai->save();
          //echo $request->Ten;
         return redirect('admin/theloai/sua/'.$theloai->id)->with('thongbao', 'Sua thanh cong');
    }
    public function getXoa($id)
    {
        $theloai = Theloai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Ban da xoa thanh cong');

    }
}
