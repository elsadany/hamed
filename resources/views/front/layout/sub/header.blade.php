<div class="header w-100">
    <div class="container">
        <nav class="navbar navbar-expand-lg px-0">
            <a class="navbar-brand d-block d-lg-none"  target="_self" href="{{url('/')}}">
                <img src="web/images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="d-block"></div>
                <div class="d-block"></div>
                <div class="d-block"></div> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="w-100">
                    <div class="st-menu ">
                        <div class="w-100">
                            <a  class="navbar-brand d-none d-lg-block re-header"  target="_self" href="{{url('/')}}">
                                <img src="web/images/logo.png" alt="">
                            </a>
                            <form class="form-inline mx-lg-auto" action="{{url('search')}}" target="_self">
                                <label> <input class="form-control mr-sm-2" name="search" type="search" placeholder="{{trans('home.search')}}" aria-label="Search">
                                    <button type="submit" class=""><i class="fa fa-search y-color"></i></button></label>
                            </form>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link  re-header "  target="_self" href="./cart" target="_self">
                                        <i class="y-color fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  re-header "  target="_self" href="./wishlist" target="_self">
                                         <i class="y-color fa fa-heart" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @if(auth()->check())
                                    
                                <li class="nav-item ">
                                    <a class="nav-link  b-color" href="{{url('myaccount')}}"  target="_self" id="navbarDropdown-user" >
                                        <img class="user-img" src="{{auth()->user()->imagePath}}" style='width:30px; border-radius:50px' alt="">
                                        <span class="user-name">{{auth()->user()->name}}</span>
                                    </a>
                                    <div class="dropdown-menu border-0 " style="background:#dc9d3c61" aria-labelledby="navbarDropdown-user">
                                        <a class="dropdown-item text-capitalize" style="font-size: 13px;" href="#">Logout</a>
                                    </div>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link y-color  re-header" href="{{url('login')}}"  target="_self">{{trans('auth.login')}}</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link y-color re-header " href="{{url('change_lang')}}"  target="_self">{{trans('home.language')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="nd-menu">
                        <div class="w-100">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link active  re-header" href="{{url('/')}}"  target="_self" style="padding: 9px 10px;">
                                        <i class="fas fa-home text-dark"></i>
                                    </a>
                                </li>
                               
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle b-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       {{trans('home.categories')}} <i class="fas fa-angle-down ml-3 mx-2"></i>
                                    </a>
                                  <ul class="dropdown-menu first_down ">
                                @foreach($categories as $one)
                                <li class="dropdown-submenu " ><a class="nav-link dropdown-toggle sub-bg y-color" href="javascript:;" target="_self"> {{$one->lang(session('lang_id'))->name}} </a>
                                    <ul class="dropdown-menu ">
                                           @foreach($one->children as $children)
                                           <li >
                                           <a class="dropdown-item" href="{{url('category/'.$children->id)}}" target="_self">
                                               
                                                       {{$children->lang(session('lang_id'))->name}}
                                             
<!--                                                    @foreach($children->children as $child)
                                                    <a class="dropdown-item" href="./category/{{$child->id}}">{{$child->lang(session('lang_id'))->name}}</a>
                                                    @endforeach-->
                                           </a></li>
                                          @endforeach
                                        </ul>
                                </li>
                              @endforeach
                                        </ul>
                                 
                                </li>
                               <li class="nav-item">
                                   <a class="nav-link   re-header" style="color: black" href="{{url('/contact-us')}}"  target="_self" >
                                        {{trans('home.contact')}}
                                    </a>
                                </li>
                               <li class="nav-item">
                                    <a class="nav-link   re-header" style="color: black" href="{{url('/about_us')}}"  target="_self" >
                                        {{trans('home.about')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>