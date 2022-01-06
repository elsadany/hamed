@extends('backend.layout.master')

@section('content')
<div class="content-body">
    <section id="content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">الاقسام</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <a href="./backend/options/create/{{$category->id}}" class="btn btn-outline-secondary" ><i class="ft-file-plus"></i> خاصية جديد</a>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>القسم</th>
                                    <th>الخاصية</th>
                                    <th>القيم</th>
                                    <th>الاعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($options as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->category->lang()->name}}</td>
                                        <td>{{$row->lang()->name}}</td>
                                        <td>
                                            @foreach ($row->values as $value)
                                                {{$value->lang()->value}}                                                <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="./backend/options/edit/{{$category->id}}/{{$row->id}}"><i class="ft-edit text-info"></i></a>
                                            <a href="./backend/options/delete/{{$row->id}}" class="delete"><i class="ft-trash-2 text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('script')
    @deletejs
@endpush