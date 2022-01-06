@extends('front.layout.master')

@section('content')
<category :lang_id="{{session('lang_id')??1}}" :category_id="{{$id??''}}" ></category>

    @endsection