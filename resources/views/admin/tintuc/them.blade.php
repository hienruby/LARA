@extends('admin.layout.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tuc
                            <small>Them</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)

                       <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}} <br>
                        @endforeach
                       </div>
                    @endif

                    @if(session('thongbao'))
                       <div class="alert alert-success">
                        {{session('thongbao')}}
                       </div>
                    @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label>The loai</label>
                                <select class="form-control" name="Theloai" id="Theloai">
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loai tin</label>
                                <select class="form-control" name="Loaitin" id="Loaitin">
                                     @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tieu de</label>
                                <input class="form-control" name="Tieude" placeholder="Nhap tieu de" />
                            </div>
                            <div class="form-group">
                                <label>Tom tat</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="Tomtat"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Noi dung</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="Noidung"></textarea>
                            </div>
                            <div class="form-group">
                                 <label>Hinh anh</label>
                                 <input type="file" name="Hinh" >
                            </div>
                             <div class="form-group">
                                <label>noi bat</label>
                                <label class="radio-inline">
                                    <input name="Noibat" value="0" type="radio">Khong
                                </label>
                                <label class="radio-inline">
                                    <input name="Co" value="1" type="radio">Co
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Them</button>
                            <button type="reset" class="btn btn-default">Lam moi</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
       $("#Theloai").change(function(){
        var idTheloai = $(this).val();
        $.get("admin/ajax/loaitin/"+idTheloai, function(data){
            //alert (data);
            $("#Loaitin").html(data);

        });

       });
    });
</script>

@endsection