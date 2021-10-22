<style>

    .contact-info span {
        font-size: 14px;
        padding: 0px 50px 0px 50px;
    }

    .contact-info hr {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .client-info {
        font-size: 15px;
    }

    .ttl-amts {
        text-align: right;
        padding-right: 50px;
    }
    table td, th{
        border: solid 1px black;
        text-align: center;
    }
    table{
        border-collapse: collapse;
    }

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <div class="container">

        <div class="row pad-top-botm " style="display: flex; padding-bottom: 40px;
        padding-top: 60px; flex-wrap: wrap;">
            <div class="col-lg-6 col-md-6 col-sm-6" style="width: 50%">
                <img src="{{ asset('img/' . old('logo', $website_info->logo)) }}" style="padding-bottom:20px; width: 80%;">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6" style="width: 50%">

                <strong style="text-transform: uppercase;">{{ config('app.name') }}</strong>
                <br>
                <i>Ünvan : </i>{{ old('address', $website_info->address) }}

            </div>
        </div>
        <div class="row text-center contact-info" style="text-align: center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <hr>
                <span>
                    <strong>Email : </strong> {{ old('email', $website_info->email) }}
                </span>
                <span>
                    <strong>Tel : </strong> {{ old('mobile', $website_info->mobile) }}
                </span>
                <hr>
            </div>
        </div>
        <div class="row client-info" style="display: flex; flex-wrap: wrap; padding-bottom: 30px;">
            <div class="col-lg-6 col-md-6 col-sm-6" style="width: 50%;">
                <h4><strong  style="text-transform: uppercase;">Müsteri  Melumatlari</strong></h4>
                <b>Ad:</b> {{$data['client_firstname']}}
                <br>
                <b>Soyad:</b> {{$data['client_lastname']}}
                <br>
                <b>Ünvan:</b> {{$data['client_address']}}
                <br>
                <b>Tel :</b> {{$data['client_tel']}}
                <br>
                <b>E-mail:</b> {{$data['client_email']}}
            </div>
            <br>
            <div class="col-lg-6 col-md-6 col-sm-6" style="width: 50%">

                <h4><strong  style="text-transform: uppercase;">Ödenis Melumatlari </strong></h4>
                <b>Ödenis meblegi : {{$data['total_amount']}}</b>
                <br>
                <b>Ödenis növü : {{$data['payment_type']}}</b>
                <br>
                <b>Ödenis statusu : {{$data['order_status']}} </b>
                <br>
                <b>Card : {{$data['card_number']}} </b>
                <br>
                <b>Brand : {{$data['brand']}} </b>
                <br>
                Sifaris tarixi : {{$data['order_date']}}
                <br>
                Ödenis tarixi : {{$data['payment_date']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive" style="width: 100%">
                    <table class="table table-striped table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Mehsul adi</th>
                                <th>Miqdari</th>
                                <th>Vahid qiymet</th>
                                <th>Cemi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data['order_items']))
                                @foreach ($data['order_items'] as $item)
                                    <tr>
                                        <td style="text-transform: lowercase">{{ $item->product->product_name }}</td>
                                        <td>{{ $item->piece }}</td>
                                        <td>{{ $item->amount }} AZN</td>
                                        <td>{{ $item->amount * $item->piece }} AZN</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="ttl-amts">
                    <h5>Endirim : {{$data['discount']}}</h5>
                </div>
                <hr>
                <div class="ttl-amts">
                    <h4 style="text-transform: uppercase"><strong>Ümumi Mebleg :  {{$data['total_amount']}} AZN</strong></h4>
                </div>
                
            </div>
        </div>
    </div>
