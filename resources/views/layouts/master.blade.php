<!DOCTYPE html>
<html>
<head>
	<title>HIEN RUBY</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
	@include('layouts.header')
	<div id="content">
     <h1>HIENRUBY</h1>

     @yield('NoiDung')
</div>
@include('layouts.footer')
</body>
</html>