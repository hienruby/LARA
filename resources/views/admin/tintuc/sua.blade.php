@extends('admin.layout.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tuc
                            <small>{{$tintuc->TieuDe}}</small>
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            <div class="form-group">
                                <label>The loai</label>
                                <select class="form-control" name="Theloai" id="Theloai">
                                    @foreach($theloai as $tl)
                                    <option 
                                    @if($tintuc->loaitin->theloai->id == $tl->id)
                                    {{"Selected"}}
                                    @endif
                                    value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loai tin</label>
                                <select class="form-control" name="Loaitin" id="Loaitin">
                                     @foreach($loaitin as $lt)
                                    <option 
                                    @if($tintuc->loaitin->id == $lt->id)
                                    {{"Selected"}}
                                    @endif
                                    value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tieu de</label>
                                <input class="form-control" name="Tieude" placeholder="Nhap tieu de" value="{{$tintuc->TieuDe}}" />
                            </div>
                            <div class="form-group">
                                <label>Tom tat</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="Tomtat">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Noi dung</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="Noidung" >{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                 <label>Hinh anh</label>
                                 <img  width="200px" src ="upload/tintuc/{{$tintuc->Hinh}}">
                                 <br>
                                 <input type="file" name="Hinh" >
                            </div>
                             <div class="form-group">
                                <label>noi bat</label>
                                <label class="radio-inline">
                                    <input name="Noibat" value="0" type="radio"
                                    @if($tintuc->NoiBat ==0)
                                    {{"checked"}}
                                     @endif
                                    >Khong
                                </label>
                                <label class="radio-inline">
                                    <input name="Co" value="1" type="radio"
                                     @if($tintuc->NoiBat ==1)
                                    {{"checked"}}
                                    @endif
                                    >Co

                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sua</button>
                            <button type="reset" class="btn btn-default">Lam moi</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Binh luan
                            <small>Danh sach</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Nguoi dung</th>
                                <th>Noi dung </th>
                                <th>Ngay dang</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->user->name}}</td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/comment/sua/{{$cm->id}}">Edit</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end row-->
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