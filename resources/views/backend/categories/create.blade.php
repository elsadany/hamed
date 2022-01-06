@extends('backend.layout.master')
@section('content')
    @breadcrumb([
        'title'=>'قسم جديد',
        'links'=>[
            'الاقسام'=>'./backend/categories',
            'اضافة قسم'=>'',
        ]
    ])
    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.categories._form')
                </div>
            </div>
        </div>
    </section>
@endsection