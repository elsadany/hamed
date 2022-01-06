@extends('front.layout.master')

@section('content')
<products :lang_id="{{session('lang_id')??1}}"  :tag_id="{{$tag_id??''}}"></products>

    @endsection