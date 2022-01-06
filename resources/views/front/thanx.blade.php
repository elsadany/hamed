@extends('front.layout.master')

@section('content')
<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
<style>
    @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
</style>
<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
<div class="g-padding my-address">
    <div class="container">

       <h2>شكرا لك </h2>

        <div class="main-content">
            <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
            <p class="main-content__body" data-lead-id="main-content-body">شكرا لك على الطلب من حامد استور</p>
            <p><strong>Your Refrance Id</strong>  {{$order->id}}</p>
            <p><strong>Your Transaction Id</strong> <span>{{$order->code}}</span></p>
            <h3>You can Press <a href="{{url('/')}}">Back Now</a></h3>
        </div>
    </div>
</div>

@stop()