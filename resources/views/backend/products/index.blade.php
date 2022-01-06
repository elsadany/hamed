@extends('backend.layout.master')

@section("title") المنتجات @stop

@section('content')
@breadcrumb([
'title'=>'المنتجات',
'links'=>[
'المنتجات'=>''
]])
<?php use App\Models\Product;?>
<div class="content-body">
 <section id="search">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Find a Partner <i class="fa fa-search" aria-hidden="true"></i></h3>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                  
                                  
                                    <div class="col-md-8">
                                        <div class="form-group" >
                                            <label class="control-label">Name</label>
                                            <select class="form-control select2" name="ids[]" multiple="">
                                                @foreach(Product::all() as $one)
                                                <option value="{{$one->id}}">{{$one->lang()->name}}</option>
                                                @endforeach
                                            </select>
                                      </div>
                                    </div>
                                
                                    <div class="col-1">
                                        <div class="form-group">
                                            <br>
                                            <input type="hidden" name="search" value="1">
                                            <button type="submit" title="search" class="btn btn-outline-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </section>

    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">المنتجات</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{route('products.create')}}" class="btn btn-xs btn-outline-primary" title="new Cuisine"><i class="fa fa-plus" aria-hidden="true"></i> أنشاء</a>
                            <br><br>
                       
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الصوره</th>
                                        <th>اسم المنتج</th>
                                        <th>السعر</th>    
                                        <th>المخزون</th>
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($products as $row)

                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td><img src="{{$row->imagepath}}" class="img-fluid round" style="width: 100px"/></td>
                                        <td>{{$row->lang()->name}}</td>
                                        <td>{{$row->price}}</td>
                                        <td>{{$row->stock}}</td>

                                        <td>
                                            <a href="{{route('products.edit',['product'=>$row->id])}}" class="col-1"><i title="edit auction" class="fas fa-pen text-primary"></i></a>
                                            <a href="{{route('products.delete',['product'=>$row->id])}}" class="delete col-1"><i title="delete auction" class="text-danger fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                                 
                            </table>
      <?php  $search_query = request()->except('page');
                    $products->appends($search_query); ?>
            {!! $products->links()!!}
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop

@push('script')
@deletejs
@endpush

