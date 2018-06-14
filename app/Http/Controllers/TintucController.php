<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;
use App\Loaitin;
use App\Tintuc;
use App\Comment;

class TintucController extends Controller
{
    //
    public function getDanhsach()
    {
    	$tintuc = Tintuc::orderby('id','DESC')->take(10)->get();
    	return view ('admin.tintuc.danhsach', ['tintuc'=>$tintuc]);
    }
    public function getThem()
    {
    	$theloai = Theloai::all();
    	$loaitin = Loaitin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request)
    {
    	$this->validate($request,
        [
        	'Loaitin'=>'required',
        	'Tieude' => 'required|min:3|unique:Tintuc, TieuDe',
        	'Tomtat' => 'required',
        	'Noidung' =>'required'
     	],
     	[
     		'Loaitin.required' => 'Ban chua nhap ten loai tin',
     		'Tieude.required' => 'Ban chua nhap ten tieu de',
            'Tieude.unique' => 'Tieu de da ton tai',
     		'Tieude.min' => 'Tieu de phai co do dai tu 3 ki tu tro len',
     		'Tomdat.required' => 'Ban chua nhap tom tat',
     		'Noidung.required' => 'Ban chua nhap noi dung',
     	]);
        

     	$tintuc = new Tintuc;
     	$tintuc->TieuDe = $request->Tieude;
     	$tintuc->TieuDeKhongDau = changeTitle($request->Tieude);
     	$tintuc->idLoaiTin = $request->Loaitin;
     	$tintuc->TomTat = $request->Tomtat;
     	$tintuc->NoiDung = $request->Noidung;
     	$tintuc->SoLuotXem = 0;

     	if($request->hasFile('Hinh'))
     	{
     		$file = $request ->file('Hinh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg'){
     			return redirect('admin/tintuc/them')->with('thongbao', 'Ban chi duoc chon file co duoi jpg, png, jpeg');
     		}

     		$name = $file->getClientOriginalName();
     		$Hinh = str_random(4)."_".$name;
     		while (file_exists("upload/tintuc".$Hinh)) {
     			$Hinh = str_random(4)."_".$name;
     		}
     		
     		$file ->move("upload/tintuc", $Hinh);
     		$tintuc->Hinh = $Hinh;

     	}else
     	{

     		$tintuc->Hinh ="";
     		
     	}

     	$tintuc->save();

     	return redirect('admin/tintuc/them')->with('thongbao', 'Them tin thanh cong');

    }

    public function getSua($id)
  	{
  		$theloai = Theloai::all();
    	$loaitin = Loaitin::all();
  		$tintuc = Tintuc::find($id);
  		return view ('admin.tintuc.sua',['tintuc'=>$tintuc, 'theloai'=>$theloai, 'loaitin'=>$loaitin]);

  	}
  	public function postSua(Request $request, $id)
  	{
  		$tintuc = Tintuc::find($id);
    	$this->validate($request,
        [
        	'Loaitin'=>'required',
        	'Tieude' => 'required|min:3|unique:Tintuc, TieuDe',
        	'Tomtat' => 'required',
        	'Noidung' =>'required'
     	],
     	[
     		'Loaitin.required' => 'Ban chua nhap ten loai tin',
     		'Tieude.required' => 'Ban chua nhap ten tieu de',
            'Tieude.unique' => 'Tieu de da ton tai',
     		'Tieude.min' => 'Tieu de phai co do dai tu 3 ki tu tro len',
     		'Tomdat.required' => 'Ban chua nhap tom tat',
     		'Noidung.required' => 'Ban chua nhap noi dung',
     	]);
     	

     	
     	$tintuc->TieuDe = $request->Tieude;
     	$tintuc->TieuDeKhongDau = changeTitle($request->Tieude);
     	$tintuc->idLoaiTin = $request->Loaitin;
     	$tintuc->TomTat = $request->Tomtat;
     	$tintuc->NoiDung = $request->Noidung;
     	

     	if($request->hasFile('Hinh'))
     	{
     		$file = $request ->file('Hinh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg'){
     			return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Ban chi duoc chon file co duoi jpg, png, jpeg');
     		}

     		$name = $file->getClientOriginalName();
     		$Hinh = str_random(4)."_".$name;
     		while (file_exists("upload/tintuc".$Hinh)) {
     			$Hinh = str_random(4)."_".$name;
     		}
     	
     		$file ->move("upload/tintuc", $Hinh);
     		unlink("upload/tintuc/".$tintuc->Hinh);
     		$tintuc->Hinh = $Hinh;
        }
     	$tintuc->save();

     	return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sua thanh cong');
  	}
    public function getXoa($id)
    {
        $tintuc =Tintuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Ban da xoa thanh cong');

    }
}
