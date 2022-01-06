@extends('front.layout.master')

@section('content')
<div class="g-padding my-account">
    @success
    @errors
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
          {{trans('auth.myaccount')}}
        </h1>
        <div class="g-padding grey-bg  pt-4 pb-0 rounded">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link @if((session('tab')!='2'&&session('tab')!='3')&&(request()->get('address')!=1&&request()->get('orders')!=1)) active @endif" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
              <i class="tab-fa far fa-user mr-3" style="color: #dc9d3c" ></i>{{trans('auth.edit-profile')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(session('tab')=='2') active @endif @if(request()->get('address')==1) active @endif" id="profile-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="profile" aria-selected="false">
            <i class="tab-fa fas fa-map-marker-alt mr-3" style="color: #dc9d3c" ></i>
              {{trans('auth.saved')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(session('tab')=='3') active @endif @if(request()->get('orders')==1) active @endif" id="contact-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="contact" aria-selected="false">
            <i class="tab-fa far fa-file-alt mr-3" style="color: #dc9d3c" ></i> 
              {{trans('auth.orders')}}</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade @if((session('tab')!='2'&&session('tab')!='3')&&(request()->get('address')!=1&&request()->get('orders')!=1)) show active @endif" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <form class="white-form text-right p-4 mb-4" method="post" action="{{url('myaccount/update')}}">
                <div class="form-group">
                    <input type="text" name="name" placeholder="{{trans('auth.name')}}" class="form-control text-dark"  value="{{auth()->user()->name}}" required="">
                </div>
               
                <div class="form-group">
                    <input type="email" name="email" placeholder="{{trans('auth.email')}}" class="form-control text-dark"  value="{{auth()->user()->email}}" required="">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" placeholder="{{trans('auth.mobile')}}" class="form-control text-dark"  value="{{auth()->user()->phone}}"required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="{{trans('auth.password')}}" class="form-control text-dark"  >
                </div>
                 <div class="form-group image_container ">
                      {!! ImageManager::ImageUploader(['name'=>'image','image'=>auth()->user()->image]) !!}
                 </div>
                 <button type="submit" name="save" class=" btn y-btn  w-25">save</button>
            </form>
           
          </div>
          <div class="tab-pane fade @if(session('tab')=='2') show active @endif @if(request()->get('address')==1) show active @endif p-4" id="addresses"  role="tabpanel" aria-labelledby="profile-tab">
                <div class="form-group">
                    <select class="form-control" id="select">
                        @foreach($addresses as $key=>$address)
                        <option value="{{$address->id}}" @if($key==0) selected @endif>{{$address->name}}</option>
                     @endforeach
                    </select>
                  </div>
            <form class="white-form text-right" method="post" action="{{url('addresses/update')}}"  target="_self">
                <div id="address_container">
                    @foreach($addresses as $key=>$address)
                    @if($key==0)
                    <input type="hidden" name="address_id"  value="{{$address->id}}"/>
                 
                      <div class="form-group">
                          <select class="form-control" name="city_id" id="exampleFormControlSelect1" required="">
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->lang(session('lang_id'))->name}}</option>
                        @endforeach
                      </select>
                    
                   
          
                  </div>
                  <div class="form-group ">
                      <input type="text" class="form-control" name="district" required=""  value="{{$address->district}}">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="address" required=""  value="{{$address->address}}">
                  </div>
                  <div class="form-group">
                    <textarea name="notes" >{{$address->notes}}</textarea>
                  </div>
                    @endif
                    @endforeach
                    
                </div>
                <button type="submit" class="w-25 btn y-btn ">save</button>
            </form>
          </div>
          <div class="tab-pane fade @if(session('tab')=='3') show active @endif @if(request()->get('orders')==1) show active @endif  p-4" id="orders" role="tabpanel" aria-labelledby="contact-tab">
            <div class="">
                <!-- table in medium and large screen -->
                <div class="d-none d-md-block">
                  <div class="shoping-table pt-2 mb-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">order</th>
                            <th scope="col">date</th>
                            <th scope="col">order total</th>
                            <th scope="col">status</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $order)
                            <tr>
                            <td class="w-25">
                                <p class="  text-capitalize">
                                    <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self"> {{$order->id}}</a>
                                </p>
                            </td>
                            <td>
                                <p class="date text-uppercase">
                                    <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self">  {{date('Y-m-d',strtotime($order->created_at))}}</a>
                                </p>
                            </td>
                            <td>
                                <p class="order-total text-uppercase">
                                        <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self">  {{$order->price_after_discount}}</a>
                                </p>
                            </td>
                            <td>
                              <!-- in case of Processing just add st-Processing class -->
                                <p class="st-complete text-uppercase">
                                        <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self">{{$order->status}}</a>
                                </p>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                  </div>
                  </div>
                </div>
                <!-- table in small screen -->
                <div class="d-block d-md-none">
                    <div class="shoping-table pt-2 mb-4">
                       @foreach($orders as $order)
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th scope="col">order</th>
                                    <th class="w-75">
                                       <p class="  text-capitalize">
                                    <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self"> {{$order->id}}</a>
                                </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td scope="col">date</td>
                                    <td class="w-75">
                                       <p class="date text-uppercase">
                                    <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self">  {{date('Y-m-d',strtotime($order->created_at))}}</a>
                                </p>
                                    </td>
                                </td>
                                </tr>
                                <tr>
                                <td scope="col">order total</td>
                                <td class="w-75">
                                  <p class="order-total text-uppercase">
                                        <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self">  {{$order->price_after_discount}}</a>
                                </p>
                                </td>
                                </tr>
                                <tr>
                                    <td scope="col">status</td>
                                    <td class="w-75">
                                        <!-- in case of Processing just add st-Processing class -->
                                      <p class="st-complete text-uppercase">
                                        <a style="color: black" href="{{url('order-details/'.$order->id)}}" target="_self">{{$order->status}}</a>
                                </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                    </div>
                </div>
            </div>
          </div>
         <div class="text-center bg-white py-4">
             <a href="{{url('logout')}}" target="_self" class="btn reverse-y-btn text-decoration-none w-25">
                {{trans('auth.logout')}}
              </a>
            </div>
        </div>
    </div>
</div>
<div id="append" style="display: none;">
    @foreach($addresses as $address)
    <div id="address_{{$address->id}}">

                    <input type="hidden" name="address_id"  value="{{$address->id}}"/>
                 
                      <div class="form-group">
                          <select class="form-control" name="city_id" id="exampleFormControlSelect1" required="">
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->lang(session('lang_id'))->name}}</option>
                        @endforeach
                      </select>
                    
                   
          
                  </div>
                  <div class="form-group ">
                      <input type="text" class="form-control" name="district" required=""  value="{{$address->district}}">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="address" required=""  value="{{$address->address}}">
                  </div>
                  <div class="form-group">
                    <textarea name="notes" >{{$address->notes}}</textarea>
                  </div>
                  
                   
    </div>
    @endforeach
</div>
@endsection
@push('script')

<script>
    $(document).ready(function(){
       $('#select').change(function(){
         var id=$(this).val();
           console.log($('#address_'+id).html());
         $('#address_container').html($('#address_'+id).html());
       });
    });
</script>
@endpush