@extends('backend.layout.master')

@section('content')
<div class="content-body">
    @include('backend.users.search')
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
                    <a href="./backend/categories/create" class="btn btn-outline-secondary" ><i class="ft-file-plus"></i> قسم جديد</a>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الصورة</th>
                                    <th>الرئيسيه</th>
                                    <th>الاعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->lang()?$row->lang()->name:''}}</td>
                                        <td>@if($row->parent_id==0) كاتيجورى رئيسي @else {{$row->main->lang()->name}} @endif</td>
                                        <td><img src="{{url('uploads/'.$row->image)}}" width="150"/></td>
                                        <td>
                                            <a href="./backend/options/{{$row->id}}" title="Category Options"><i class="ft-list"></i></a>
                                            <a href="./backend/categories/edit/{{$row->id}}"><i class="ft-edit text-info"></i></a>
                                            <a href="./backend/categories/delete/{{$row->id}}" class="delete"><i class="ft-trash-2 text-danger"></i></a>
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