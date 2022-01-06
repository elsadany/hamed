@php
function fetchTree($childs,$product){

foreach($childs as $child){

if(count($child['childs'])){
echo "<optgroup label='".$child['langs'][0]['name']."'>";
}
else{
echo "<option value='".$child['id']."'"; 
              if($child['id']==$product->category_id)
              echo "selected";
              echo ">".$child['langs'][0]['name']."</option>";
}
if(count($child['childs'])){
fetchTree($child['childs'],$product);
echo "</optgroup>";
}

}

}
@endphp
<form method="post">
    @csrf
    <div class="form-body">

        <div class="row">
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >الأسم ({{$lang->name}})</label>
                <input class="form-control" name="name_{{$lang->symbole}}" @if($product->lang($lang->id)) value="{{$product->lang($lang->id)->title}}" @endif type="text" required=""/>
            </div>
            @endforeach
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >الوصف ({{$lang->name}})</label>
                <textarea class="form-control" name="description_{{$lang->symbole}}"   required="">@if($product->lang($lang->id)) {{$product->lang($lang->id)->name}} @endif</textarea>
            </div>
            @endforeach

            <div class="col-md-4">
                <label>الصوره</label>
                {!! ImageManager::ImageUploader(['name'=>'image','image'=>$product->image])!!}
            </div>
            <div class="col-md-4">
                <label>الفئات</label>
                <select class="form-control category" name="category_id" required="" >
                    <option value="">----</option>
                    @foreach($category_tree as $cat)
                   
                    @if(count($cat['childs']))
                    <optgroup label="{{$cat['langs'][0]['name']}}">
                        {!! fetchTree($cat['childs'],$product) !!}
                    </optgroup>
                    @endif
                    @endforeach
                </select> 
            </div>
            <div class="col-md-4">
                <label>الماركه</label>
                <select class="form-control" name="brand_id" id="brand" required="">
                    <option value="">أختار ماركة</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->lang()->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <label>السعر</label>
                <input type="number" step="any" class="form-control" name="price" value="{{$product->price}}"/>
            </div>
            <div class="col-md-4">
                <label>الخصم</label>
                <input type="number" step="any" min="0" class="form-control" name="discount" value="{{$product->discount}}"/>
            </div>
           
        </div>
        <div class="row" id="options_container">
            
        </div>





    </div>

    <div class="form-actions">

        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>
<div id="append" style="display: none;">
    <?php $options_ids= App\Models\CategoryOption::pluck('category_id')->toArray();
    $optionscategories= App\Models\Category::all();
    ?>
    @foreach($optionscategories as $one)
    <div class="row category{{$one->id}}">
        @foreach($one->options as $option)
    <div class="col-md-4">
        <label>{{$option->lang()->name}}</label>
        <select name="options[{{$option->id}}]" class="form-control" @if($option->is_required) required @endif>
             @foreach($option->values as $value)
             <option value="{{$value->id}}">{{$value->lang()->value}}</option>
             @endforeach
    </select>   
    </div>
      @endforeach  
    </div>
    @endforeach
</div>
@push('script')
<script>
    $(document).ready(function(){
     $('.category').change(function(){
       var id=$(this).val();
        $.get("{{url('brands/get/')}}"+'/'+id, function(data, status){
    $('#brand').html(data);
  });
  $('#options_container').html($('.category'+id).html());
     }); 
    });
</script>
@endpush

