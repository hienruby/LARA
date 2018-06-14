<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Theloai;
use App\Slide;
use App\Loaitin;
use App\Tintuc;
use App\User;

class PageController extends Controller
{
    //
    function __construct()
    {
    	$theloai = Theloai::all();
    	$slide = Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);
        if(Auth::check()){
            View::share('nguoidung', Auth::user());
        }
    }
    function trangchu()
    {
    	return view('pages.trangchu');
    }
    function lienhe()
    {
    	return view('pages.lienhe');
    }
    function loaitin($id)
    {
        $loaitin = Loaitin::find($id);
        $tintuc = Tintuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }
    function tintuc($id)
    {
        $tintuc = Tintuc::find($id);
        $tinnoibat = Tintuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = Tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(5)->get();
        return view('pages.tintuc', ['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan]);
    }

    function getDangnhap()
    {
        return view('pages.dangnhap');

    }
     function postDangnhap(Request $request)
     {
       $this->validate($request,
            [
                'email' =>'required',
                'password' =>'required|min:3|max:32'
            ],
            [
                'email.required' => 'Ban chua nhap Email',
                'password.required' => 'Ban chua nhap password',
                'password.min' =>'password khong duoc nho hon 3 ki tu',
                'password.max' =>'password khong duoc lon hon 32 ki ty'
            ]);
        if(Auth::attempt(['email'=>$request->email,
            'password'=>$request->password])){
            

            return redirect('trangchu')->with('thongbao','Ban da dang nhap thanh cong '.Auth::user()->name);
        }else{
            return redirect('dangnhap')->with('thongbao', 'ban dang nhap khong thanh cong');
        }

     }
     function getDangxuat()
     {
        Auth::logout();
        return redirect('trangchu');
     }
     function getNguoidung()
     {
        $user = Auth::user();
        return view('pages.nguoidung', ['nguoidung'=>$user]);
     }
      function postNguoidung(Request $request)
      {
        $this->validate($request,
            [
                'name' =>'required|min:3',
                
            ],
            [
                'name.required' => 'Ban chua nhap ten nguoi dung',
                'name.min' => 'Ten nguoi dung phai co it nhat 3 ky tu'
            ]);
        $user = Auth::user();
        $user->name = $request->name;
        if($request->changePassword == "on"){
            $this->validate($request,
            [
                
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'password.required' =>'Ban chua nhap mat khau',
                'password.min' =>'Mat khau phai co it nhat 3 ki tu',
                'password.max' =>'Mat khau chi duoc toi da 32 ki tu',
                'passwordAgain.required' => 'Ban chua nhap lai mat khau',
                'passwordAgain.same' => 'Mat khau nhap lai chua khop'
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('nguoidung')->with('thongbao', 'ban da sua thanh cong');

      }

      function getDangki()
      {
        return view('pages.dangki');
      }
      function postDangki(Request $request)
      {

        $this->validate($request,
            [
                'name' =>'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required' => 'Ban chua nhap ten nguoi dung',
                'name.min' => 'Ten nguoi dung phai co it nhat 3 ky tu',
                'email.required' => 'ban chua nhap email',
                'email.email' =>'Ban chua nhap dung dinh dang email',
                'email.unique' => 'Email da ton tai',
                'password.required' =>'Ban chua nhap mat khau',
                'password.min' =>'Mat khau phai co it nhat 3 ki tu',
                'password.max' =>'Mat khau chi duoc toi da 32 ki tu',
                'passwordAgain.required' => 'Ban chua nhap lai mat khau',
                'passwordAgain.same' => 'Mat khau nhap lai chua khop'
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;

        $user->save();

        return redirect('dangnhap')->with('thongbao', 'Chuc mung ban da dang ki thanh cong');

      }

      function timkiem(Request $request)
      {
         $tukhoa = $request->tukhoa;
         $tintuc = Tintuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('Noidung','like',"%$tukhoa%")->take(30)->paginate(5);
         return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);

      }
}
