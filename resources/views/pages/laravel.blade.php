@extends('layouts.master')


@section('NoiDung')
<h2>Laravel</h2>
{{$khoahoc}}
{!!$khoahoc!!}
{{-- hienn ruby --}}
@if($khoahoc != "")
  {{$khoahoc}}
@else
{{"khong co khoa hoc"}}
@endif
<br>
{{$khoahoc or "KHong co khoa hoc"}}
<br>
@for($i = 1; $i<=10 ; $i++)
{{$i." "}}
@endfor
<br>
<?php $khoahoc = array('PHP', 'IOS', 'ASP', 'Android');?>
@if(!empty($khoahoc))
@foreach($khoahoc as $value)
{{$value}}
@endforeach
@else
{{"mang rong"}}
@endif
<br>

@forelse($khoahoc as $value)
  @break($value =="ASP")
{{$value}}
@empty
{{"Mang rong"}}
@endforelse
<br>



@endsection