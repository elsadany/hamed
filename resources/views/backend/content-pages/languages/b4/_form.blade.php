
<!--froala css-->
<?= \Elsayednofal\FroalaEditor\Froala::initCss() ?>
<?= \Elsayednofal\FroalaEditor\Froala::initJs() ?>

<form method="post" action="" novalidate="novalidate" id="c_form" >
    {{ csrf_field() }}
    <div class="row">
         <div class="col-md-12">

            @if(config("pages.multi_languages"))
            <div class="form-group">
                <label for="language">{{trans("pages::page.language")}}</label>
                <select id="language" name="lang[lang_id]" class="form-control" required="">
                    <option value="">{{trans("pages::page.select_language")}}</option>
                    @foreach($languages as $language)
                    <?php
                    $selected = "";
                    if ($language->id == $lang->lang_id)
                        $selected = "selected";
                    ?>
                    <option value="{{$language->id}}" {{$selected}}>{{$language->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="form-group">
                <label for="title">{{trans('pages::page.title')}}</label>
                <input type="text" id="title" name="lang[title]" value="{{$lang->title}}" class="form-control" required=""/>
            </div>
            <div class="form-group">
                <label>{{trans('pages::page.short_desc')}}</label>
                <textarea name="lang[desc]" class="form-control">{{$lang->desc}}</textarea>
            </div>
            <div class="form-group">
                <label for="details">{{trans('pages::page.content')}}</label>
                <?= \Elsayednofal\FroalaEditor\Froala::initEditor("lang[content]", 'lang-content', $lang->content, true) ?>
            </div>


            <br style="clear:both"/>
            <div class="form-group">
                <button class='btn btn-primary' >Submit</button>       
            </div>

        </div>
    </div>


</form>
<br/>
<script>
    $(document).ready(function () {
        $("#c_form").validate();
    });

</script>
