@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>'الطلبات',
        'links'=>[
            'الطلبات'=>''
        ]])

    <div class="content-body">
        @include('backend.orders.search')
        <section id="content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">الطلبات</h4>
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
                                        <th>معلومات الشخص</th>
                                        
                                        <th>عنوان التوصيل</th>
                                        <th> الأجمالى</th>
                                        <th> الشحن</th>
                                        <th> الأجمالى بعد الخصم</th>
                                        <th> تاريخ الطلب</th>
                                        <th> طريقه الدفع</th>
                                        <th> حاله الدفع</th>
                                        <th>حاله الطلب</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td><a href="{{url('orders/show/'.$order->id)}}">{{$order->id}}</a></td>
                                            <td><a href="{{url('order?user_id='.$order->user_id)}}">@if($order->user){{$order->user->name}} <br/>{{$order->user->email}}<br/>
                                                    {{$order->user->phone}}@endif</a></td>
                                            <td>@if($order->address){{$order->address->name}}<br/> {{$order->address->cityname}}<br/>
                                                {{$order->address->district}}<br/>{{$order->address->address}}
                                                @endif</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{$order->shipping}}</td>
                                            <td>{{$order->price_after_discount}}</td>
                                            <td>@if($order->pay_method==1) Cash @else Visa @endif</td>
                                            <td>@if($order->is_paid==1&&$order->pay_method==2) تم الدفع @else لم يتم الدفع@endif</td>
                                            <td>{{date('Y-m-d ',strtotime($order->created_at))}}<br/>{{date('h:i A',strtotime($order->created_at))}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-outline btn-success" data-toggle="modal" data-target="#Modal{{$order->id}}" ><i class="fa fa-pencil-square"></i> </button>
                                        <div class="modal inmodal" id="Modal{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated " >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">اغلاق</span></button>
                                                        <i class="fa fa-laptop modal-icon"></i>
                                                        <h4 class="modal-title">تغيير الحاله</h4>
                                                    </div>
                                                    <div class="modal-body" >

                                                        <blockquote>

                                                            <form action="{{url('backend/orders/update-status/'.$order->id)}}">
                                                                <div class="row ">
                                                                    <div class="col-md-8">
                                                                        <label>الحاله</label>
                                                                        <select class="form-control" name="status_id" required="">
                                                                            @foreach(status as $key=>$one)
                                                                            <option value="{{$key}}" @if($order->status_id==$key) selected @endif>{{$one}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <label></label>
                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </blockquote>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-xs btn-outline btn-warning" data-toggle="modal" data-target="#myModal{{$order->id}}" id="stepPreview"><i class="fa fa-eye"></i></button>
                                        <div class="modal inmodal" id="myModal{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true" style='    padding-left: 550px;' >
                                            <div class="modal-dialog">
                                                <div class="modal-content animated bounceInRight" style="width: 900px" >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">اغلاق</span></button>
                                                        <i class="fa fa-laptop modal-icon"></i>
                                                        <h4 class="modal-title">تفاصيل الطلب</h4>
                                                    </div>
                                                    <div class="modal-body" >

                                                        <blockquote>

                                                            <table class="table">
                                                                <tr>
                                                                    <th>المنتج</th>
                                                                    <th>القيمه</th>
                                                                <th>العدد</th>
                                                                </tr>
                                                                @foreach($order->details as $detail)
                                                                <tr>
                                                                    <td>@if($detail->product) {{$detail->product->lang()->name}} @endif</td>
                                                                    <td>@if($detail->value){{$detail->value->lang()->value}} @endif</td>
                                                                    <td>{{$detail->number}}</td>
                                                                   
                                                                </tr>
                                                                @endforeach
                                                            </table>
                                                        </blockquote>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
  <button class="btn btn-primary" onclick="printDiv('printbill{{$order->id}}')"><i class="fa fa-print"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $orders->links() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>

@foreach($orders as $order)
<div id="printbill{{$order->id}}" style="display: none; float: right;">
    <h1>فاتورة رقم {{$order->id}}</h1>
    <table border="1" style="direction: rtl; text-align: right; width: 100%;">
        <tr><th colspan="2"> تفاصيل الطلب</th></tr>
        <tr>
            <td><p><b>مؤسسة {{config('settings.project_name')}}</b><br/>
                    عمان </p>

            </td>
            <td>تاريخ الاضافه:{{date('Y-m-d ',strtotime($order->created_at))}}<br/>{{date('h:i A',strtotime($order->created_at))}}<br/>
                <p>رقم الطلب:{{$order->id}}</p>

            </td>
        </tr>
    </table>
    <br/>
    <table border="1" style="direction: rtl; text-align: right; width: 100%;">
        <tr><th>عنوان الشحن</th></tr>
        <tr>
        <tr><td>
                <p>@if($order->user){{$order->user->name}} <br/>{{$order->user->email}}<br/>
                                                {{$order->user->phone}}@endif</p>
                @if($order->address){{$order->address->name}}<br/> {{$order->address->cityname}}<br/>
                                                {{$order->address->district}}<br/>{{$order->address->address}}
                                                @endif

            </td>
        </tr>
        </tr>
    </table>
    <br/>
    <table border="1" style="direction: rtl; text-align: right; width: 100%;">
       <tr>
                                                                    <th>المنتج</th>
                                                                    <th>القيمه</th>
                                                                <th>العدد</th>
                                                                </tr>
                                                                @foreach($order->details as $detail)
                                                                <tr>
                                                                    <td>@if($detail->product) {{$detail->product->lang()->name}} @endif</td>
                                                                    <td>@if($detail->value){{$detail->value->lang()->value}} @endif</td>
                                                                    <td>{{$detail->number}}</td>
                                                                   
                                                                </tr>
                                                                @endforeach

        <tr>
            <td colspan="2" class="text-right">طريقه الدفع </td>
            <td class="text-right">@if($order->pay_method==1) Cash @else Visa @endif</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">حاله الطلب </td>
            <td class="text-right">@if($order->is_paid==1&&$order->pay_method==2) تم الدفع @else لم يتم الدفع@endif</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">الاجمالي </td>
            <td class="text-right">{{$order->total}}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">الشحن </td>
            <td class="text-right">{{$order->shipping}}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">الاجمالي بعد الخصم </td>
            <td class="text-right">{{$order->price_after_discount}}</td>
        </tr>
    </table>

</div>
@endforeach
@endsection
@push('script')
<script>
     function printDiv(id)
    {
        console.log(id);
        var divToPrint = document.getElementById(id);
        console.log(divToPrint);
        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html direction="rtl"><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        //setTimeout(function () {
        //    newWin.close();
        // }, 10);

    }
</script>
    @deletejs
@endpush