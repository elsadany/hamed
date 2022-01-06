@extends('front.layout.master')

@section('content')

<search :lang_id="{{session('language')->id??1}}"  :search_key="'{{$search}}'"></search>

    @endsection