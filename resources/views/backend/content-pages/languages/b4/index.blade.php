@extends(config("pages.backend_layout"))

@section("title"){{trans('pages::page.pages')}}@stop

@section(config("pages.layout_content_area"))
<h1>{{trans('pages::page.pages')}}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void()">{{trans('pages::page.home')}}</a></li>
        <li class="breadcrumb-item"><a href="./backend/content-pages">{{trans('pages::page.pages')}}</a></li>
        <li class="breadcrumb-item active">{{trans('pages::page.pages')}} {{trans('pages::page.languages')}}</li>
        <li class="breadcrumb-item active">
            <a class="btn btn-sm btn-outline-primary" href="./backend/content-pages/{{$page_id}}/languages/create" title="{{trans('pages::page.create')}} {{trans('pages::page.new_page')}}"><span class="glyphicon glyphicon-plus-sign" ></span></a>
        </li>
    </ol>

<br style="clear:both">

<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('pages::page.pages')}}</h3></div>
    <div class="card-body">
        
    
        <table class="table table-striped">
            <thead>
                <tr class="text-primary">
                    <th>ID</th>
                    <th>{{trans('pages::page.title')}}</th>
                    <th>{{trans('pages::page.language')}}</th>
                    <th>{{trans('pages::page.actions')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($langs as $row)

                <tr>
                    <td>#{{$row->id}}</td>
                    <td>{{$row->title}}</td>
                    <td>{{$languages[$row->lang_id]->name}}</td>


                    <td>
                        <a href='./backend/content-pages/{{$page_id}}/languages/delete/{{$row->id}}' class="delete col-md-1" title="{{trans('pages::page.delete')}}"><span class="glyphicon glyphicon-remove"></span></a>
                        <a href='./backend/content-pages/{{$page_id}}/languages/update/{{$row->id}}' class="col-md-1" title="{{trans('pages::page.update')}}"><span class="glyphicon glyphicon-edit"></span></a>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>

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

