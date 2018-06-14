<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;
use App\Loaitin;
use App\Tintuc;

class AjaxController extends Controller
{
    //
    public function getLoaitin($idTheloai)
    {
    	$loaitin = Loaitin::where('idTheLoai', $idTheloai)->get();
    	foreach($loaitin as $lt)
    	{
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	}
    }
}
