@extends('front.layout.master')

@section('content')
<wishlist :lang_id="{{session('language')->id??1}}" ></wishlist>

    @endsection