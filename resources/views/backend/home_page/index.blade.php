@extends('backend.layout.master')

@section("title") الصفحه الرئيسية @stop

@section('content')
@breadcrumb([
'title'=>'الصفحه الرئيسية',
'links'=>[
'الصفحه الرئيسية'=>''
]])

@php
use App\Http\Controllers\Helpers\Components;
function fetchTree($childs,$banner){

foreach($childs as $child){

if(count($child['childs'])){
echo "<optgroup label='".$child['langs'][0]['name']."'>";
                }
                else{
                echo "<option value='".$child['id']."'"; 
              if($child['id']==$banner)
              echo "selected";
              echo ">".$child['langs'][0]['name']."</option>";
    }
    if(count($child['childs'])){
    fetchTree($child['childs'],$banner);
    echo "</optgroup>";
}

}

}
@endphp

<div class="content-body">
    <section id="content-body">
        <div class="card">
            @success
            @errors
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="{{url('backend/home-page/store')}}">
                        <hr/>
                        <div id="banner_area">
                            <h3>Banners</h3>
                            <button type="button" id="banner-add" class="btn btn-sm btn-outline-info"><i class="fa fa-plus"></i> Add</button>
                            @foreach($banners as $key=>$banner)
                            <div class="row banner_parent">
                                <div class="col-6">
                                    <label>الصوره</label>
                                    <input type="hidden" name="image{{$key}}" value="{{$banner->image}}"/>
                                    {!! Components::upload($banner->image,'',$name='image'.$key)!!}
                                </div>
                                <div class="col-6">
                                    <label>Link</label>
                                    <select name="category[{{$key}}]" class="form-control" required="">
                                        @foreach($category_tree as $cat)

                                        @if(count($cat['childs']))
                                        <optgroup label="{{$cat['langs'][0]['name']}}">
                                            {!! fetchTree($cat['childs'],$banner->id) !!}
                                        </optgroup>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm  bannerdel" ><i class="fas fa-times-circle"></i></button>
                            </div>
                            @endforeach
                        </div>
                        <hr/>
                        <div id="sections-area">
                            <button type="button" id="section-add" class="btn btn-sm btn-outline-info"><i class="fa fa-plus"></i> Add</button>

                            @foreach($tags as $key=>$row)
                            <div class="row  parent_class">
                              
                            
                              
                                <div class="col-12">
                                                                                <div class="col-2">{{$row->lang()->name}}<input type="hidden" name="tag[{{$row->id}}"/></div>
                                    <div class="col-10">
                                    <label>المنتجات</label>
                                    <select class="form-control " name="products[{{$row->id}}][]" multiple="">
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}" @if(in_array($product->id,$row->products()->pluck('product_id')->toArray())) selected @endif>{{$product->lang()->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                        <hr/>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<div id="container" style="display: none;">
    <div class="row  parent_class">
        <input type="hidden" name="sections[__k__]" />
        @foreach($languages as $lang)
        <div class="col-6">
            <label >الأسم ({{$lang->name}})</label>
            <input class="form-control" name="name_{{$lang->symbole}}[__k__]" type="text" required=""/>

        </div>
        @endforeach
        <div class="col-12">
            <label>المنتجات</label>
            <select class="form-control " name="products[__k__][]" multiple="">
                @foreach($products as $product)
                <option value="{{$product->id}}">{{$product->lang()->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="button" class="btn btn-danger btn-sm  del" ><i class="fas fa-times-circle"></i></button>

    </div>
</div>
<div id="banner_container" style="display: none;">
    <div class="row banner_parent">
        <div class="col-6">
            <label>الصوره</label>
            {!! Components::upload('','',$name='image__x__')!!}
        </div>
        <div class="col-6">
            <label>Link</label>
            <select name="category[__x__]" class="form-control" required="">
                @foreach($category_tree as $cat)

                @if(count($cat['childs']))
                <optgroup label="{{$cat['langs'][0]['name']}}">
                    {!! fetchTree($cat['childs'],'') !!}
                </optgroup>
                @endif
                @endforeach
            </select>
        </div>
        <button type="button" class="btn btn-danger btn-sm  bannerdel" ><i class="fas fa-times-circle"></i></button>
    </div>

</div>

<style>
    select.form-control[multiple]{
        height: 100px;
        overflow-y: scroll;
    }
    .parent_class{
        margin:7px;
        padding:7px;
        border:1px solid;
        border-radius: 5px;
        position: relative;
    }
    .banner_parent{
        margin:7px;
        padding:7px;
        border:1px solid;
        border-radius: 5px;
        position: relative;
    }
</style>
@stop

@push('script')
<script>
    $(document).ready(function () {
        $('#banner-add').click(function () {
            var length = $('.banner_parent').length;
            length = length - 1;
            var html = $('#banner_container').html();
            var html = html.replaceAll('__x__', length);
            $('#banner_area').append(html);
        });
        $('#section-add').click(function () {
            var length = $('.parent_class').length;
            length = length - 1;
            var html = $('#container').html();
            var html = html.replaceAll('__k__', length);
            $('#sections-area').append(html);
        });
        $('#sections-area').on('change', '.type', function () {
            var html = '';
            if ($(this).val() == 0) {
                html = $('#category_div').html();
            } else if ($(this).val() == 1)
            {
                html = $('#filter_div').html();

            }
            var id = $(this).attr('data_id');
            var html = html.replaceAll('__id__', id);
            console.log($(this).closest('.parent_class'));
            $(this).closest('.parent_class').children('.append_class').html(html);

        });
        $(document).on('click', '.del', function () {
            if (!confirm("are you sure you want to remove section ?"))
                return false;
            $(this).closest('div.parent_class').remove();
        });
        $(document).on('click', '.bannerdel', function () {
            if (!confirm("are you sure you want to remove section ?"))
                return false;
            $(this).closest('div.banner_parent').remove();
        });

    });
</script>

@endpush

