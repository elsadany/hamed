@extends('backend.layout.master')
@section("title")تعديل منتج  @stop

@section('content')
    @breadcrumb([
        'title'=>' تعديل',
        'links'=>[
            'المنتجات'=>'./backend/products',
            'تعديل '=>''
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
@endsection