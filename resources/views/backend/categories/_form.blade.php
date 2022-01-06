@php
function fetchTree($childs,$parent){
foreach($childs as $child){
echo "<option value='".$child['id']."'";
if($parent==$child['id'])
echo "selected";
echo ">".$child['langs'][0]['name']."</option>";
if(is_array($child['childs']) && count($child['childs'])){
echo '<optgroup label="--'.$child["langs"][0]["name"].'--">';
                fetchTree($child['childs'],$parent);
                echo '</optgroup>';
}
}

}
@endphp
<form method="post">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <label>موجود فى قسم</label>
            <select name="category[parent_id]" class="form-control">
                <option value="0">No Parent</option>
                @foreach($category_tree as $cat)
                <option value="{{$cat['id']}}">{{$cat['langs'][0]['name']}}</option>
                @if(count($cat['childs']))
                <optgroup label="--{{$cat['langs'][0]['name']}}--">
                    {!! fetchTree($cat['childs'],$category->parent_id) !!}
                </optgroup>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label for="">الصورة</label>
            {!! Media::ImageUploader(['name'=>'image','image'=>$category->image])!!}
        </div>
    </div>
    <div class="row">
        @foreach ($languages as $language)
        <div class="col-md-6 form-group">
            <label>الاسم ({{$language->name}})</label>
            <input type="text" class="form-control" name="lang[{{$language->id}}][name]" value="{{$category->lang($language->id)->name??''}}" />    
        </div>        

        @endforeach
    </div>
    <div id="option_area">

    </div>
            {{--  <button type="button" id="add_option" class="btn btn-sm btn-outline-info"><i class="fa fa-plus" aria-hidden="true"></i> خاصية جديدة</button>  --}}
    <br><br><hr>
    <div class="row">
        <div class="col-md-1">
            <input class="btn btn-primary" type="submit" name="save" value="Save" />
            </div>
            <div class="col-md-2">
                <input class="btn btn-success" type="submit" name="save_option" value="Save & edit options" />
            </div>
            </div>
            </form>

            <div id="blind">
                <div class="option">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <select name="option[type][]" class="form-control">
                                <option value="1">checkbox</option>
                                <option value="2">color</option>
                                <option value="3">text</option>
                                <option value="4">radio</option>
                                <option value="5">select</option>
                            </select>
                        </div>
                        <div class="form-check col-md-2">
                            <input type="checkbox" class="form-check-input" name="option[affect_price][]" value="1">
                            <label class="form-check-label">يؤثر ف السعر</label>
                        </div>
                        <div class="form-check col-md-2">
                            <input type="checkbox" class="form-check-input" name="option[is_stock][]" value="1">
                            <label class="form-check-label">ستوك خاص</label>
                        </div>
                        <div class="form-check col-md-2">
                            <input type="checkbox" class="form-check-input" name="option[in_filter][]" value="1">
                            <label class="form-check-label">يستخدم كفلتر</label>
                        </div>
                        <div class="form-check col-md-2">
                            <input type="checkbox" class="form-check-input" name="option[is_required][]" value="1">
                            <label class="form-check-label">مدخل اساسى</label>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($languages as $language)
                        <div class="form-group col-md-6">
                            <label>الاسم ({{$language->name}})</label>
                            <input type="text" name="option[{{$language->id}}][name][]" class="form-control">
                        </div>
                        @endforeach
                    </div>
                    <div class="value-area ">
                        <h3>القيم</h3>
                        <hr>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success add-value mr-5"><i class="fa fa-plus" aria-hidden="true"></i>قيم جديدة</button>
                    <a href="javascriot:void(0)" class="delete-option"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></a>

                </div>
                <div class="values row">
                    @foreach ($languages as $language)
                    <div class="form-group col-md-6">
                        <label>القيمة ({{$language->name}})</label>
                        <input type="text" name="option[][value][{{$language->id}}][name][]" class="form-control">
                    </div>
                    @endforeach
                    <a href="javascriot:void(0)" class="delete-values"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></a>
                </div>
            </div>

            @push('script')
            <style>
                #blind{
                    display:none;
                }
                .option{
                    border:1px dashed;
                    border-radius: 5px;
                    padding:10px;
                    margin-bottom: 10px;
                    position: relative;
                }
                .values{
                    border:1px solid;
                    border-radius: 5px;
                    padding:10px;
                    margin: 10px;
                    position: relative;
                }
                .delete-values,.delete-option{
                    position: absolute;
                    left:-12px;
                    top:-12px;
                }
            </style>
            <script>
                $(document).ready(function () {
                    $('#add_option').click(function () {
                        $('#blind').find('div.option').clone().appendTo('#option_area');
                    });

                    $(document).on('click', '.add-value', function () {
                        var values_sec = $(this).prev('div.value-area');
                        $('#blind').find('div.values').clone().appendTo(values_sec);
                    });
                    $(document).on('click', '.delete-values', function () {
                        if (confirm('هل تريد حذف هذا ؟'))
                            $(this).closest('div.values').remove();
                    });
                    $(document).on('click', '.delete-option', function () {
                        if (confirm('هل تريد حذف هذا ؟'))
                            $(this).closest('div.option').remove();
                    });
                });

            </script>
            @endpush