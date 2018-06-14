<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    //
    protected $table ="Theloai";

    public function loaitin()
    {
      return $this->hasMany('App\Loaitin', 'idTheLoai', 'id');
    }
    public function tintuc()
    {
    	return $this->hasManyThrough('App\Tintuc', 'App\Loaitin','idTheLoai', 'idLoaiTin','id');
    }
}
