@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>' تعديل',
        'links'=>[
            'Static Pages'=>'./backend/static_pages',
            'تعديل '=>''
            ]
    ])

    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.static_pages._form')
                </div>
            </div>
        </div>
    </section>
@endsection