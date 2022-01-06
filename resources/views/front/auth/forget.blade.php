@extends('front.layout.master')
@section('content')
<div class="g-padding my-address">
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
           {{trans('auth.forget')}}
        </h1>
        <div class="grey-bg p-4 rounded">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <img class="form-img" src="web/images/home/login.png" alt="">
                </div>
                <div class="col-md-6">
                    @errors
                    @success
                    <form class="white-form text-center" method="post" target="_self">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="{{trans('auth.email')}}">
                        </div>
                       
                        <button type="submit" class="w-100 btn y-btn ">{{trans('auth.forget')}}</button>
                     <a href="{{url('login')}}" target="_self" class="forget text-decoration-none"> {{trans('auth.login')}}</a>
                        <br>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection