<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
    //
    public function getDanhsach()
    {
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem()
    {
    	return view('admin.user.them');
    }
    public function postThem(Request $request)
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
    	$user->quyen = $request->quyen;

    	$user->save();

    	return redirect('admin/user/them')->with('thongbao', 'ban da them thanh cong');
    }

    public function getSua($id)
    {
    	$user = User::find($id);
    	return view('admin.user.sua', ['user'=>$user]);
    }

    public function postSua(Request $request, $id)
    {

    	$this->validate($request,
    		[
    			'name' =>'required|min:3',
    			
    		],
    		[
    			'name.required' => 'Ban chua nhap ten nguoi dung',
    			'name.min' => 'Ten nguoi dung phai co it nhat 3 ky tu'
    		]);
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->quyen = $request->quyen;
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

    	return redirect('admin/user/sua/'.$id)->with('thongbao', 'ban da sua thanh cong');

    }
    public function getXoa($id)
    {
        $user =Tintuc::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao', 'Ban da xoa thanh cong');

    }

    public function getDangnhapAdmin()
    {
      return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request)
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
            

    		return redirect('admin/theloai/danhsach')->with('thongbao','Ban da dang nhap thanh cong '.Auth::user()->name);
    	}else{
    		return redirect('admin/dangnhap')->with('thongbao', 'ban dang nhap khong thanh cong');
    	}
    }
    public function getDangxuatAdmin()
    {
    	Auth::logout();
    	return redirect('admin/dangnhap');
    }

}
