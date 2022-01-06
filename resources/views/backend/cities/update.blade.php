@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>' تعديل',
        'links'=>[
            'المدن'=>'./backend/cities',
            'تعديل '=>''
            ]
    ])

    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.cities._form')
                </div>
            </div>
        </div>
    </section>
@endsection