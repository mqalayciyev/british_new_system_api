@extends('front.layouts.app')

@section('content')

    <div class="login-page">
        <div class="container p-3" id="form-container">
            <form action="#">
                <div class="form-group">
                    <h1 class="text-center">Hesab yarat</h1>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Ad" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Soyad" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Şirkət" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Ofis" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <input type="email" class="form-control" placeholder="E-Poçt" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <input type="password" class="form-control" placeholder="Şifrə" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 text-center">
                        <button class="btn btn-lg btn-block">Giriş</button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 text-center">
                        <p class="text-center m-0">Hesabınız var? <strong><a
                                    href="{{ route('login') }}">Daxil ol</a></strong></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')

@endsection
