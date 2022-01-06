@extends('front.layout.master')
@section('content')
<div class="g-padding my-address">
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
           {{trans('auth.login')}}
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
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"  placeholder="{{trans('auth.password')}}">
                        </div>
                        <button type="submit" class="w-100 btn y-btn ">{{trans('auth.login')}}</button>
                        <a href="{{url('forget')}}" class="forget text-decoration-none"> {{trans('auth.forget')}}?</a>
                        <br>
                        <a class="reverse-y-btn d-inline"  href="{{url('/register')}}">
                            {{trans('auth.register')}}
                            <i class="fas fa-chevron-right y-color mx-2"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection