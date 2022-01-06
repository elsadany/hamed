@extends('front.layout.master')

@section('content')
    <product :lang_id="{{session('language')->id??1}}" :product_id="{{$product_id}}"></product>
@endsection