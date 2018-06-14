<style type="text/css">
	.pagination li{
		list-style: none;
		float: left;
		margin-left: 5px;
	}
</style>



@foreach($sanpham as $value)
{{$value->id}}<br>
{{$value->ten}}<br>
@endforeach

{!!$sanpham->links()!!}