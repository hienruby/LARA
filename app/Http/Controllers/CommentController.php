<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Theloai;
use App\Loaitin;
use App\Tintuc;
use App\Comment;

class CommentController extends Controller
{
    //
    public function getXoa($id, $idTintuc)
    {
        $comment =Comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idTintuc)->with('thongbao', 'Ban da xoa comment thanh cong');

    }
    public function postComment($id,Request $request)
    {
    	$idTinTuc = $id;
         echo $idTinTuc;
    	$tintuc = Tintuc::find($id);
    	$comment = new Comment;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();

    	return redirect('tintuc/'.$id.'/'.$tintuc->TieuDeKhongDau.".html")->with('thongbao', 'Viet binh luan thanh cong');

    }
}
