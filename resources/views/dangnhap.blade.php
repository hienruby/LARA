{{$error or ''}}


<form action="{{route('login')}}" method="post">
	{{ csrf_field() }}
	<input type="text" name="username" placeholder="Username">
   <input type="password" name="password" placeholder="Password">
   <input type="submit" >
</form>