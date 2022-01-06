<footer>
    <div class="main-footer ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="">
                        <img class="ft-logo" src="web/images/ft-logo.png" alt="">
                    </a>
                    <div class="social-contact">
                        <a @if(array_key_exists('snapchat', $settings)) href="{{$settings['snapchat']}}" @endif class="y-color">
                            <i  class="fa fa-snapchat"></i>
                        </a>
                        <a @if(array_key_exists('istagram', $settings)) href="{{$settings['istagram']}}" @endif class="y-color">
                            <i    class="fa fa-whatsapp"></i>
                        </a>
                        <a @if(array_key_exists('whatsapp', $settings)) href="{{$settings['whatsapp']}}" @endif class="y-color">
                            <i  class="fa fa-instagram"></i>
                        </a>
                    </div>



                    <div class="social-contact">
                        <a @if(array_key_exists('ios_link', $settings)) href="{{$settings['ios_link']}}" @endif class="y-color">
                            <i  class="fa fa-apple"></i>
                        </a>
                        <a @if(array_key_exists('and_link', $settings)) href="{{$settings['and_link']}}" @endif class="y-color">
                            <i  class="fa fa-android"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-capitalize text-white">
                        {{trans('home.hot-links')}}
                    </h4>
                    <ul class="footer-link">
                        <li><a href="{{url('about_us')}}" class="text-capitalize">{{trans('home.about')}}</a></li>
                        <li><a href="{{url('privacy')}}" class="text-capitalize">{{trans('home.privacy')}}</a></li>

                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-capitalize text-white">
                        {{trans('home.myaccount')}}
                    </h4>
                    <ul class="footer-link">
                        <li><a href="{{url('myaccount')}}" class="text-capitalize">{{trans('home.myaccount')}}</a></li>
                        <li><a href="{{url('cart')}}" class="text-capitalize">{{trans('home.mycart')}}</a></li>
                        <li><a href="{{url('myaccount?orders=1')}}" class="text-capitalize">{{trans('home.order')}}</a></li>
                        <li><a href="{{url('myaccount?address==1')}}" class="text-capitalize">{{trans('auth.saved')}}</a></li>

                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-capitalize text-white">
                        {{trans('home.customer_service')}}
                    </h4>
                    <ul class="footer-link">
                        <li><a href="{{url('contact-us')}}" class="text-capitalize">{{trans('home.contact')}}</a></li>

                    </ul>
                      <h4 class="text-uppercase text-white">{{trans('home.stay-in-touch')}}</h4>
                          <form target="_self" method="post" action="{{url('subscribe')}}">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="email" name="email" class="form-control" placeholder="{{trans('home.enter_email')}}..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text y-btn " id="basic-addon2">
                                 <i class="fa @if(session('lang_id')!=1) fa-angle-right @else fa-angle-left @endif "></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

              
            </div>
        </div>
    </div>
    <div class="copyright py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center text-md-left">
                        Copyright © 2020 Hamed Store. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="text-center text-md-right">
                        Developed by . <a target="_blank" href="mailto:tamamsmart@gmail.com">Tamam Smart Solutions</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
 @push('script')
 @if(session('subscribe_success'))
 <script>
     Swal.fire(
  'Good job!',
  'You Subscribe Successfully',
  'success'
)

 </script>
 <?php session()->forget('subscribe_success'); ?>
 @endif
 @endpush