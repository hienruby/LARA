@extends('admin.layout.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                        <form action="admin/user/them" method="POST">
                              {{ csrf_field() }}
                            <div class="form-group">
                                <label>Ho ten</label>
                                <input class="form-control" name="name" placeholder="nhap ten nguoi dung" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhap dia chi email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" placeholder="Nhap mat khau" />
                            </div>
                              <div class="form-group">
                                <label>Password again</label>
                                <input class="form-control" name="passwordAgain" placeholder="Nhap lai mat khau" />
                            </div>
                           
                            <div class="form-group">
                                <label>Quyen nguoi dung</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">Thuong
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Them</button>
                            <button type="reset" class="btn btn-default">lam moi</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection