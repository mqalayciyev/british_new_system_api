@extends('front.layouts.app')

@section('content')

    <div class="login-page">
        <div class="container p-3" id="form-container">
            <form action="#">
                <div class="form-group">
                    <h1 class="text-center">Daxil Ol</h1>
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
                    <div class="col-6">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="rememberme" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Məni xatırla</label>
                          </div>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.forgot') }}">Şifrəni unutmusan?</a>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 text-center">
                        <button class="btn btn-lg btn-block">Giriş</button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 text-center">
                        <p class="text-center m-0">Qeydiyyatdan keçməmisiniz? <strong><a
                                    href="{{ route('register') }}">Hesab yarat</a></strong></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')

@endsection
