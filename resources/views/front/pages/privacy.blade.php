@extends('front.layout.master')

@section('content')
<?php $privacy= \App\Models\StaticPage::where('slug','privacy')->first(); ?>
<div class="g-padding my-address">
    <div class="container">

        <h2> {{$privacy->lang(session('lang_id'))->title}}
        </h2>



       {!!$privacy->lang(session('lang_id'))->description!!}
    </div>
</div>
@endsection