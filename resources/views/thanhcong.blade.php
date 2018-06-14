
@if(Auth::check())
	<h1>Dang nhap thanh cong</h1>

	@if(isset($user))
		{{"Ten:".$user->name}}
		<br>
		{{"Email:".$user->email}}
		<br>
		<a href="{{url('logout')}}">Logout</a>
	@endif
@else
    <h1>BAN CHUA DANG NHAP</h1>
@endif