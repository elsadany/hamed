@php
function fetchTree($childs,$brand){

foreach($childs as $child){

if(count($child['childs'])){
echo "<optgroup label='".$child['langs'][0]['name']."'>";
}
else{
echo "<option value='".$child['id']."'"; 
              if(in_array($child['id'],$brand->categories()->pluck('category_id')->toArray()))
              echo "selected";
              echo ">".$child['langs'][0]['name']."</option>";
}
if(count($child['childs'])){
fetchTree($child['childs'],$brand);
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
                <input class="form-control" name="name_{{$lang->symbole}}" @if($brand->lang($lang->id)) value="{{$brand->lang($lang->id)->name}}" @endif type="text" required=""/>
            </div>
            @endforeach

            <div class="col-md-6">
                <label>الصوره</label>
                {!! ImageManager::ImageUploader(['name'=>'image','image'=>$brand->image])!!}
            </div>
            <div class="col-md-6">
                <label>الفئات</label>
                <select class="form-control select2" name="categories[]" required="" multiple="">
                    @foreach($category_tree as $cat)
                   
                    @if(count($cat['childs']))
                    <optgroup label="{{$cat['langs'][0]['name']}}">
                        {!! fetchTree($cat['childs'],$brand) !!}
                    </optgroup>
                    @endif
                    @endforeach
                </select> 
            </div>
        </div>





    </div>

    <div class="form-actions">

        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>

