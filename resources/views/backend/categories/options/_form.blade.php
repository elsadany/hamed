<form method="post">
    <div class="row">
        <input type="hidden" value="{{$option->id}}">
        <div class="col-md-3 form-group">
            <select name="option[type]" id="type" class="form-control">
                <option value="1" @if($option->type==1) selected @endif>select</option>
                <!--<option value="2" @if($option->type==2) selected @endif>checkbox</option>-->
                <option value="3" @if($option->type==3) selected @endif>color</option>
                <option value="4" @if($option->type==4) selected @endif>text</option>
                <!--<option value="5" @if($option->type==5) selected @endif>radio</option>-->
            </select>
        </div>
<!--        <div class="form-check col-md-2">
            <input type="checkbox" class="form-check-input" name="option[affect_price]" value="1" @if($option->affect_price) checked @endif>
                   <label class="form-check-label">يؤثر ف السعر</label>
        </div>-->
        <div class="form-check col-md-2">
            <input type="checkbox" class="form-check-input" name="option[is_stock]" value="1" @if($option->is_stock) checked @endif>
                   <label class="form-check-label">ستوك خاص</label>
        </div>
<!--        <div class="form-check col-md-2">
            <input type="checkbox" class="form-check-input" name="option[in_filter]" value="1" @if($option->in_filter) checked @endif>
                   <label class="form-check-label">يستخدم كفلتر</label>
        </div>-->
        <div class="form-check col-md-2">
            <input type="checkbox" class="form-check-input" name="option[is_required]" value="1" @if($option->is_required) checked @endif>
                   <label class="form-check-label">مدخل اساسى</label>
        </div>
    </div>
    <div class="row">
        @foreach ($languages as $language)
        <div class="form-group col-md-6">
            <label>الاسم ({{$language->name}})</label>
            <input type="text" name="lang[{{$language->id}}][name]" value="{{$option->lang($language->id)->name??''}}" class="form-control">
        </div>
        @endforeach
    </div>
    <div class="value-area">
        <h3>القيم</h3>
        <hr>
        @foreach ($option->values as $value)
        <div class="values row">
            <input type="hidden" name="value[id][]" value="{{$value->id}}">
            @if($option->type==3)
            <div class="form-group col-md-6">
                <label>color Code</label>
                <input type="color" name="value[code][]" value="{{$value->code}}">
            </div>
            @endif
            @foreach ($languages as $language)
            <div class="form-group col-md-6">
                <label>القيمة ({{$language->name}})</label>
                <input type="text" name="value[{{$language->id}}][name][]" value="{{$value->lang($language->id)->value}}" class="form-control">
            </div>
            @endforeach
            <a href="javascriot:void(0)" class="delete-values"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></a>
        </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-success add-value mr-5" @if(in_array($option->type,[4])) style="display:none;" @endif><i class="fa fa-plus" aria-hidden="true"></i>قيم جديدة</button>


    <br><br><hr>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
<div id="blind">
    <div class="values row">
        <input type="hidden" name="value[id][]" value="">
        @foreach ($languages as $language)
        <div class="form-group col-md-6">
            <label>القيمة ({{$language->name}})</label>
            <input type="text" name="value[{{$language->id}}][name][]" class="form-control">
        </div>
        @endforeach
        <a href="javascriot:void(0)" class="delete-values"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></a>
    </div>
</div>
<div id="blind2">
    <div class="values row">
        <input type="hidden" name="value[id][]" value="">
        <div class="form-group col-md-6">
            <label>color Code</label>
            <input type="color" name="value[code][]" >
        </div>
        @foreach ($languages as $language)
        <div class="form-group col-md-6">
            <label>القيمة ({{$language->name}})</label>
            <input type="text" name="value[{{$language->id}}][name][]" class="form-control">
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
    #blind2{
        display:none;
    }
    .values{
        border:1px solid;
        border-radius: 5px;
        padding:10px;
        margin: 10px;
        position: relative;
    }
    .delete-values{
        position: absolute;
        left:-12px;
        top:-12px;
    }
</style>
<script>
    $(document).ready(function () {
        $(document).on('click', '.add-value', function () {
            var val = $('#type').val();
             if (jQuery.inArray(val, ['1', '2','3', '5']) >= 0) {
                $('.add-value').show();
                $(".value-area").show();
            } else {
                $('.add-value').hide();
                $(".value-area").hide();
            }
            console.log(val);
            var values_sec = $(this).prev('div.value-area');
            if (val == 3)
            {
                $('#blind2').find('div.values').clone().appendTo(values_sec);

            } else {
                $('#blind').find('div.values').clone().appendTo(values_sec);
            }
        });
        $(document).on('click', '.delete-values', function () {
            if (confirm('هل تريد حذف هذا ؟'))
                $(this).closest('div.values').remove();
        });
        $('#type').change(function () {
            var val = $(this).val();
            if (jQuery.inArray(val, ['1', '2','3', '5']) >= 0) {
                $('.add-value').show();
                $(".value-area").show();
            } else {
                $('.add-value').hide();
                $(".value-area").hide();
            }
        });

    });

</script>
@endpush