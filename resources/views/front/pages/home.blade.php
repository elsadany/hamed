@extends('front.layout.master')

@section('content')
    <index :lang_id="{{session('lang_id')??1}}"></index>
@endsection