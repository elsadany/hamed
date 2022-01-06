@extends('front.layout.master')

@section('content')
<div class="g-padding my-address">
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
           {{trans('home.contact')}}
        </h1>
        <div class="grey-bg g-padding px-4 rounded">
            @success
            <div class="social-contact">
                <a @if(array_key_exists('snapchat', $settings)) href="{{$settings['snapchat']}}" @endif class="y-color">
                    <i style="font-size: 50px;" class="fa fa-snapchat"></i>
                </a>
                <a @if(array_key_exists('istagram', $settings)) href="{{$settings['istagram']}}" @endif class="y-color">
                    <i  style="font-size: 50px;"  class="fa fa-whatsapp"></i>
                </a>
                <a @if(array_key_exists('whatsapp', $settings)) href="{{$settings['whatsapp']}}" @endif class="y-color">
                    <i style="font-size: 50px;" class="fa fa-instagram"></i>
                </a>
             
            </div>
                <form class="white-form text-center" method="POST" action="{{url('contact')}}" target="_self">
                <div class="form-group">
                    <input type="text" name="name" class="form-control"  placeholder="{{trans('auth.name')}}">
                </div>
@csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control"  placeholder="{{trans('auth.email')}}">
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="form-control"  placeholder="{{trans('home.subject')}}">
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="{{trans('home.message')}}" ></textarea>
                </div>
                <button type="submit" class="w-25 btn y-btn ">{{trans('home.send')}}</button>
            </form>
        </div>
    </div>
</div>
<style>
    .social-contact >a > i{
        font-size: 50px;
    }
</style>
@endsection