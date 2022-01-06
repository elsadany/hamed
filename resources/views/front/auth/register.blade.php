@extends('front.layout.master')
@section('content')
<div class="g-padding my-address">
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
          {{trans('auth.register')}}
        </h1>
        <div class="grey-bg p-4 rounded">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <img class="form-img" src="./web/images/home/login.png" alt="">
                </div>
                <div class="col-md-6">
                    @errors
                    <form class="white-form " method="post" action="{{url('register')}}" target="_self">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control"  placeholder="{{trans('auth.name')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control"  placeholder="{{trans('auth.email')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control"  placeholder="{{trans('auth.mobile')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"  placeholder="{{trans('auth.password')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm_password"  class="form-control"  placeholder="{{trans('auth.confirm_password')}}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-1">
                                    <input type="checkbox" class="h-auto" required="">
                                </div>
                                <div class="col-11 px-0">
                                    <p class="d-flex grey-color text-capitalize mt-0"> 
                                        <span>{{trans('auth.agree')}}</span>
                                        <a href="" class='mx-1 y-color'>{{trans('auth.terms')}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-100 btn y-btn ">{{trans('auth.signup')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection