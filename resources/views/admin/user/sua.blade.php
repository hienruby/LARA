@extends('admin.layout.index')

@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                              {{ csrf_field() }}
                            <div class="form-group">
                                <label>Ho ten</label>
                                <input class="form-control" name="name" placeholder="nhap ten nguoi dung" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhap dia chi email" value="{{$user->email}}" readonly />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Doi mat khau</label>
                                <input type="password" class="form-control password" name="password" placeholder="Nhap mat khau" disabled />
                            </div>
                              <div class="form-group">
                                <label>Nhap lai mat khau</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="Nhap lai mat khau" disabled="" />
                            </div>
                           
                            <div class="form-group">
                                <label>Quyen nguoi dung</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio"
                                    @if($user->quyen ==0) {{"checked"}}
                                    @endif>Thuong
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio"
                                    @if($user->quyen ==1) {{"checked"}}
                                    @endif>Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sua</button>
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

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked"))
            {
                $(".password").removeAttr('disabled');
            }
            else
            {
                $(".password").attr('disabled', '');
            }

        })
    })
    
</script>

@endsection