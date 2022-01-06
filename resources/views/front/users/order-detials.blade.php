@extends('front.layout.master')

@section('content')
<div class="g-padding order-summary">
    <div class="container">
        <h1 class="text-center text-capitalize mb-4">
            order details
        </h1>
        <div class="shoping-table p-4 rounded border mb-4 grey-bg">
            <!-- table in medium and large screen -->
            <div class="d-none d-md-block">
                <div class="shoping-table pt-2 mb-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">{{trans('cart.image')}}</th>
                            <th scope="col">{{trans('cart.product')}}</th>
                            <th scope="col">{{trans('cart.price')}}</th>
                            <th scope="col">{{trans('cart.quantity')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                            <tr>
                            <th class="w-25">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{$detail->product->imagepath}}" alt="" class="product">
                                </div>
                            </th>
                            <td class="w-25">
                                <p class="description text-capitalize">
                              {{$detail->product->lang(session("lang_id"))->name}}
                                </p>
                            </td>
                            <td>
                                <p class="price text-uppercase">
                                    {{$detail->product->price_after_discount}} {{trans('home.currency')}}
                                </p>
                            </td>
                            <td>
                                <p class="p-2 fi-quntity">
                               {{$detail->number}}</p>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table in small screen -->
            <div class="d-block d-md-none">
                 @foreach($order->details as $detail)
                <div class="shoping-table pt-2 mb-4">
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                                <th scope="col">{{trans('cart.image')}}</th>
                                <th class="w-75">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <img src="{{$detail->product->imagepath}}" alt="" class="product">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col">{{trans('cart.product')}}</td>
                                <td class="w-75">
                                <p class="description text-capitalize">
                                 {{$detail->product->lang(session("lang_id"))->name}}
                                </p>
                            </td>
                            </tr>
                            <tr>
                                <td scope="col">{{trans('cart.price')}}</td>
                                <td class="w-75">
                                    <p class="price text-uppercase">
                                        {{$detail->product->price_after_discount}} {{trans('home.currency')}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col">{{trans('cart.quantity')}}</td>
                                <td class="w-75">
                                    <div class="">
                                        <p class="p-2 fi-quntity">
                                        {{$detail->number}}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 @endforeach
            </div>
            <div class="address">
                <div class="total">
                    <p class="text-uppercase">
                        {{trans('cart.subtotal')}}: 
                    </p>
                    <p class="text-uppercase y-color">
                        {{$order->total}} {{trans('home.currency')}}
                    </p>
                </div>
                <hr>
                <div class="total">
                    <p class="text-uppercase">
                        {{trans('cart.discount')}}: 
                    </p>
                    <p class="text-uppercase y-color">
                        {{$order->discount}} {{trans('home.currency')}}
                    </p>
                </div>
                <hr>
                <div class="total">
                    <p class="text-uppercase">
                        {{trans('cart.shipping')}}: 
                    </p>
                    <p class="text-uppercase y-color">
                        {{$order->shipping}} {{trans('home.currency')}}
                    </p>
                </div>
                <hr>
             
                <div class="">
                    <h4 class="y-color text-capitalize">
                        {{trans('cart.address')}}
                    </h4>
                    <p class="location">
                        {{$order->address->name}}
                        <span class="d-block">
                        {{$order->address->cityname}},{{$order->address->district}}, {{$order->address->address}}
                        </span>
                    </p>
                </div>
                <hr>
                <div class="">
                    <img src="/web/images/icons/visa.png" alt="">
                </div>
                <hr>
                <div class="delivery-coast">
                     <p class="text-uppercase">
                        {{trans('cart.shipping')}}: 
                    </p>
                    <p class="text-uppercase y-color">
                        {{$order->shipping}} {{trans('home.currency')}}
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
