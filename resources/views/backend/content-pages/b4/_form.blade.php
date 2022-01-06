@if($page->id==null)
<?php $page->lang = new Elsayednofal\Pages\Models\ContentPageLang; ?>
@else
<?php $page->lang = $page->lang()->first() ?>
@endif
<!--froala css-->
<?= \Elsayednofal\FroalaEditor\Froala::initCss() ?>
<?= \Elsayednofal\FroalaEditor\Froala::initJs() ?>

<form method="post" action="" novalidate="novalidate" id="bpost_form" >
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="form-group">
                <label for="title">{{trans('pages::page.title')}}</label>
                <input type="text" id="title" name="lang[title]" value="{{$page->lang->title}}" class="form-control" required=""/>
            </div>
            <br/>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="page[slug]" value="{{$page->slug}}" class="form-control" pattern='^[a-z0-9]+(?:-[a-z0-9]+)*$' required="required"/>
            </div>
            <br/>
            <div class="form-group">
                <label>{{trans('pages::page.short_desc')}}</label>
                <textarea name="lang[desc]" class="form-control">{{$page->lang->desc}}</textarea>
            </div>
            <div class="form-group">
                <label for="details">{{trans('pages::page.content')}}</label>
                <?= \Elsayednofal\FroalaEditor\Froala::initEditor("lang[content]", 'content', $page->lang->content, true) ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">

            @if(config("pages.multi_languages"))
            <div class="form-group">
                <label for="language">{{trans("pages::page.language")}}</label>
                <select id="language" name="lang[lang_id]" class="form-control" required="">
                    <option value="">{{trans("pages::page.select_language")}}</option>
                    @foreach($languages as $lang)
                    <?php
                    $selected = "";
                    if ($lang->id == $page->lang->lang_id)
                        $selected = "selected";
                    ?>
                    <option value="{{$lang->id}}" {{$selected}}>{{$lang->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="form-group">
                <label for="status">{{trans("pages::page.status")}}</label>
                <select id="status" name="post[is_active]" class="form-control" required="">
                    <option value="">{{trans("pages::page.select_status")}}</option>
                    <option value="1" @if($page->is_active==1) selected @endif >{{trans("pages::page.published")}}</option>
                    <option value="0" @if($page->is_active==0) selected @endif>{{trans("pages::page.unpublished")}}</option>
                </select>
            </div>

            @foreach(config('pages.images_types') as $type)
            <?php
            $images = \Elsayednofal\Pages\Models\ContentPageImage::where('page_id', $page->id)->where('type', $type)->get();
            if (count($images) > 0) {
                $images = [$images[0]->image_id];
            } else {
                $images = [];
            }
            ?>

            <div class="form-group">
                <label>{{$type}} {{trans("pages::page.image")}}</label>
                {!! ImageManager::selector("images[$type]",$images,true) !!}
            </div>
            <br/>
            <hr>
            @endforeach

        </div>
    </div>
    <br style="clear:both"/>
    <div class="form-group">
        <button class='btn btn-primary' >Submit</button>       
    </div>


</form>
@push('script')
<script>
    $(document).ready(function () {
        $("#bpost_form").validate({});
    });

</script>
@endpush