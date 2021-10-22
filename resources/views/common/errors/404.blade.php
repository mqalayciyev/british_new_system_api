@extends('customer.layouts.master')
@section('content')
    <div class="ps-page--404">
        <div class="container">
            <div class="ps-section__content"><img src="img/404.jpg" alt="">
                <h3>ohh! səhifə tapılmadı</h3>
                <p>@lang('content.Sorry, the page you are looking for could not be found!') <a href="{{ route('homepage') }}">@lang('content.Go to Homepage')</a></p>
            </div>
        </div>
    </div>
@endsection