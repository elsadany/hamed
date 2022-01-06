@extends(config("pages.backend_layout"))

@section("title"){{trans('pages::page.pages')}}@stop

@section(config("pages.layout_content_area"))

<?php $page_obj = new \Elsayednofal\Pages\Models\ContentPage() ?>
@if(\Request::has("search"))
@foreach(\Request::input("pages") as $key=>$value)
<?php $page_obj->$key = $value ?>
@endforeach
@foreach(\Request::input("pages_langs") as $key=>$value)
<?php $page_obj->$key = $value ?>
@endforeach
@endif

<h1>{{trans('pages::page.pages')}}</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void()">{{trans('pages::page.home')}}</a></li>
        <li class="breadcrumb-item"><a href="./backend/content-pages" class="active">{{trans('pages::page.pages')}}</a></li>
        <li class="breadcrumb-item">
            <a class="btn btn-sm btn-outline-primary" href="./backend/content-pages/create" title="{{trans('pages::page.create')}} {{trans('pages::page.new_page')}}"><span class="glyphicon glyphicon-plus-sign" ></span></a>
        </li>
    </ol>
</nav>


<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('pages::page.pages')}}</h3></div>
    <div class="card-body">
        <div class="container" style="border-bottom: 1px dashed;margin-bottom: 3px;">
            <form>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">ID</label>
                            <input type="number" name="pages[id]" class="form-control" value="{{$page_obj->id}}" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">{{trans('pages::page.slug')}}</label>
                            <input type="text" name="pages[slug]" class="form-control" value="{{$page_obj->slug}}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label class="control-label">{{trans('pages::page.title')}}</label>
                            <input type="text" name="pages_langs[title]" class="form-control" value="{{$page_obj->title}}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label class="control-label">{{trans('pages::page.content')}}</label>
                            <input type="text" name="pages_langs[content]" class="form-control" value="{{$page_obj->details}}"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">{{trans('pages::page.created_at')}}</label>
                            <input type="datetime" name="pages[created_at]" step="1" class="form-control" value="{{$page_obj->created_at}}" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">{{trans('pages::page.published')}}</label>
                            <input type="radio" name="pages[is_active]" step="1"  value="1" @if($page_obj->is_active==='1') checked @endif/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">{{trans('pages::page.unpublished')}}</label>
                            <input type="radio" name="pages[is_active]" step="1"  value="0" @if($page_obj->is_active==='0') checked @endif/>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <input type="hidden" name="search" value="search" />
                        <button type="submit" name="submit" class="btn btn-primary">{{trans('pages::page.find')}}</button>
                        <button type="reset" name="submit" class="btn btn-info">{{trans('pages::page.clear')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br style="clear:both;padding-bottom: 15px">


    <div>
        <table class="table table-striped">
            <thead>
                <tr class="text-light bg-dark">
                    <th>ID</th>
                    <th>{{trans('pages::page.title')}}</th>
                    <th>{{trans('pages::page.slug')}}</th>
                    <th>{{trans('pages::page.published')}}</th>
                    <th>{{trans('pages::page.created_at')}}</th>
                    @if(config("backend-posts.multi_languages"))
                    <th>{{trans('pages::page.language')}}</th>
                    @endif
                    <th>{{trans('pages::page.actions')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($pages as $row)

                <tr>
                    <td>#{{$row->id}}</td>

                    <td>{{$row->title}}</td>

                    <td>{{$row->slug}}</td>

                    <td>{{$row->is_active}}</td>

                    <td>{{$row->created_at}}</td>

                    @if(config("backend-posts.multi_languages"))
                    <td>{{$langs[$row->lang_id]->name}}</td>
                    @endif


                    <td>
                        <a href='./backend/content-pages/delete/{{$row->id}}' class="delete col-md-1" title="{{trans('pages::page.delete')}}"><span class="glyphicon glyphicon-remove"></span></a>
                        <a href='./backend/content-pages/update/{{$row->id}}' class="col-md-1" title="{{trans('pages::page.update')}}"><span class="glyphicon glyphicon-edit"></span></a>
                        @if(config("backend-posts.multi_languages"))
                        <a href='./backend/content-pages/{{$row->id}}/languages' class="col-md-1" data-toggle="tooltip" data-html="true" data-placement="top" title="{{$row->added_langs}}"><span class="glyphicon glyphicon-list"></span></a>
                        @endif
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    <div class="row">

        <?= $pages->links() ?>

    </div>

</div>
</div>
<script type='text/javascript'>
    $(document).ready(function () {

        // Tooltip ##############################
        $('a[data-toggle=tooltip]').tooltip();

        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm("{{trans('pages::page.delete_question')}}")) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                method:"POST",
                beforeSend: function () {
                    button.hide();
                },
                success: function (response) {
                    //response = jQuery.parseJSON(response);
                    if (response.status === 'ok') {
                        button.closest('tr').remove();
                    }
                    alert(response.message);
                }, complete: function () {
                }
            });



        });



    });
</script>
<style>
    .tb-head{
        color: #337ab7;
        font-weight: bolder;
        font-family: cursive;
        font-size: medium;
    }
</style>
@stop

