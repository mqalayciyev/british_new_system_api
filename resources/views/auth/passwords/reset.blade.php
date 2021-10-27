@extends('front.layouts.app')

@section('content')

    <div class="login-page">
        <div class="container p-3" id="form-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <h1 class="text-center">Şifrəni Sıfırlamaq</h1>
                </div>
                @include('common.errors.validate')
                @include('common.alert')
                <div class="row form-group">
                    <div class="col-12">
                        <input type="email" name="email" class="form-control" placeholder="E-Poçt" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 text-center">
                        <button class="btn btn-lg btn-block">Şifrə sıfırlama bağlantısını göndərin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')

@endsection
