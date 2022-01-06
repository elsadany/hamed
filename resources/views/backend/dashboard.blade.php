@extends('backend.layout.master')
@section('title','الصفحة الرئيسية')
@section('content')
<?php

use App\Http\Controllers\Helpers\Html\Themes;
use App\Http\Controllers\Helpers\Functions;
?>
<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <style>
            h5{
                color: black;
            }
        </style>
        <div class="content-body" style="height: 600px;">
            <div class="row">
               <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="primary">{{$users}}</h3>
                            <span>Users</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-user primary font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="warning">{{$cities}}</h3>
                            <span>Cities</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-map-marker warning font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="danger">{{$brands}}</h3>
                            <span>Brands</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-star danger font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="success">{{$products}}</h3>
                            <span>Stock</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-leaf success font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="success">{{$selled}}</h3>
                            <span>Selled Products</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-leaf success font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="danger">{{$finished_products}}</h3>
                            <span>Finished Products</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-leaf danger font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="primary">{{$new_orders}}</h3>
                            <span>new Order</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-leaf primary font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="primary">{{$in_shipping}}</h3>
                            <span>In Shipping</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-leaf primary font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="primary">{{$finished}}</h3>
                            <span>Finished Orders</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-leaf primary font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                

        </div>
        <div class="row">
         
        </div>
        <div class="row match-height">
       
        </div>
    </div>
</div>
</div>
@stop()