@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>'المستخدمين',
        'links'=>[
            'المستخدمين'=>''
        ]])

    <div class="content-body">
        @include('backend.users.search')
        <section id="content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">المستخدمين</h4>
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
                      
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الألكترونى</th>
                                        <th>رقم الهاتف </th>
                                    
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                          
                                            <td>
                                                <a href="./backend/users/delete/{{$user->id}}" class="delete"><i class="ft-trash-2 text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@push('script')
    @deletejs
@endpush