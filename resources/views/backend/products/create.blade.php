@extends('backend.layout.master')

@section("title")أنشاء  @stop

@section('content')

   @breadcrumb([
        'title'=>' جديد',
        'links'=>[
            'المنتجات'=>'./backend/products',
            'انشاء '=>''
            ]
    ])
  <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.products._form')
                </div>
            </div>
        </div>
    </section>




<style>
    .form-control.error {
        border-color: #ef2b2b;
    }
    .error {
        color: #ef2b2b !important;
    }
</style>

@stop
