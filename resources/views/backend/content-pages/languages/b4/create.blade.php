@extends(config("pages.backend_layout"))

@section("title"){{trans("pages::page.create")}} {{trans("pages::page.page")}} {{trans("pages::page.language")}} @stop

@section(config("pages.layout_content_area"))

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>

<h1>{{trans("pages::page.pages")}} {{trans("pages::page.languages")}}</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{trans("pages::page.home")}}</a></li>
    <li class="breadcrumb-item"><a href="./backend/content-pages/">{{trans("pages::page.pages")}}</a></li>
    <li class="breadcrumb-item"><a href="./backend/content-pages/{{$page->id}}/languages">{{trans("pages::page.pages")}} {{trans("pages::page.languages")}}</a></li>
    <li class="breadcrumb-item active">{{trans("pages::page.create")}}</li>
</ol>

<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans("pages::page.create")}} {{trans("pages::page.pages")}}</h3></div>
    <div class="card-body">
        <?php if (Session::has("success")): ?> 
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{trans("pages::page.congratulations")}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
        <?php elseif (Session::has("validate_errors")): ?> 
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{trans("pages::page.errors")}} </strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        @if(count($languages)>0)    
        <?php $form_path = "backend.content-pages.languages.b4._form" ?>
        @include($form_path)
        @else
        <h2 style="color:green;font-weight: bold;">{{trans('pages::page.all_languages_already_added')}}</h2>
        @endif

    </div>
</div>

<style>
    .form-control.error {
        border-color: #ef2b2b;
    }
    .error {
        color: #ef2b2b !important;
    }
</style>

@stop
