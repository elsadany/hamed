<form method="post">
    @csrf
    <div class="form-body">
      
        <div class="row">
               <div class="col-md-6">
                <label >Slug</label>
                <input class="form-control" name="slug" value="{{$static_page->slug}}" type="text" required=""/>
            </div>
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >ألعنوان ({{$lang->name}})</label>
                <input class="form-control" name="title_{{$lang->symbole}}" @if($static_page->lang($lang->id)) value="{{$static_page->lang($lang->id)->title}}" @endif type="text" required=""/>
            </div>
           @endforeach
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >ألوصف ({{$lang->name}})</label>
                <textarea class="form-control editor" name="description_{{$lang->symbole}}" required=""> @if($static_page->lang($lang->id)) {{$static_page->lang($lang->id)->description}} @endif </textarea>
            </div>
           @endforeach
         
           
        </div>
        

     


    </div>

    <div class="form-actions">
        
        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>

