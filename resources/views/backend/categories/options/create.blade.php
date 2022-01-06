@extends('backend.layout.master')
@section('content')
    @breadcrumb([
        'title'=>'خاصية جديدة',
        'links'=>[
            'الاقسام'=>'./backend/categories',
            'الخصائص'=>'./backend/options/'.$category->id,
            'اضافة خاصية'=>'',
        ]
    ])
    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.categories.options._form')
                </div>
            </div>
        </div>
    </section>
@endsection