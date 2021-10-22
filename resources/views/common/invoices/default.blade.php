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

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <div class="container">

        <div class="row pad-top-botm " style="display: flex; padding-bottom: 40px;
        padding-top: 60px; flex-wrap: wrap;">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <img src="{{ asset('img/logo-1615450298.png') }}" style="padding-bottom:20px;">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">

                <strong style="text-transform: uppercase;">{{ config('app.name') }}</strong>
                <br>
                <i>Ünvan : </i>{{ old('address', $website_info->address) }}

            </div>
        </div>
        <div class="row text-center contact-info">
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
        <div class="row pad-top-botm client-info">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4><strong  style="text-transform: uppercase;">Müsteri  Melumatlari</strong></h4>
                <br>
                <b>Ad:</b>{{ (isset($client_firstname)) ? $client_firstname : '' }}
                <br>
                <b>Soyad:</b>{{ (isset($client_lastname)) ? $client_lastname : '' }}
                <br>
                <b>Ünvan:</b>{{ (isset($client_address)) ? $client_address : '' }}
                <br>
                <b>Tel :</b>{{ (isset($client_tel)) ? $client_tel : '' }}
                <br>
                <b>E-mail:</b>{{ (isset($client_email)) ? $client_email : '' }}
            </div>
            <br>
            <div class="col-lg-6 col-md-6 col-sm-6">

                <h4><strong  style="text-transform: uppercase;">Ödenis Melumatlari </strong></h4>
                <b>Ödenis meblegi : {{ (isset($total_amount)) ? $total_amount : '' }} </b>
                <br>
                <b>Ödenis növü : {{ (isset($payment_type)) ? $payment_type : '' }} </b>
                <br>
                <b>Ödenis statusu : {{ (isset($order_status)) ? $order_status : '' }} </b>
                <br>
                <b>Card : {{ (isset($card_number)) ? $card_number : '' }} </b>
                <br>
                <b>Brand : {{ (isset($brand)) ? $brand : '' }} </b>
                <br>
                Sifaris tarixi : {{ (isset($order_date)) ? $order_date : '' }}
                <br>
                Ödenis tarixi : {{ (isset($payment_date)) ? $payment_date : '' }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mehsul adi</th>
                                <th>Miqdari</th>
                                <th>Məlumat</th>
                                <th>Vahid qiymet</th>
                                <th>Cemi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($order_items))
                                @foreach ($order_items as $item)
                                    <tr >
                                        <td style="text-transform: lowercase">{{ $item->product->product_name }}</td>
                                        <td>{{ $item->piece }}</td>
                                        <td>
                                            @php
                                             $color_arr = ['#ff0000' => 'Qırmızı', '#000000' => 'Qara', '#ffffff' => 'Ağ', '#008000' => 'Yaşıl',
                                                                '#ffa500' => 'Narıncı', '#0000ff' => 'Göy', '#ff009d' => 'Çəhrayı', '#e5ff00' => 'Sarı', '#00e1ff' => 'Mavi',
                                                                '#808080' => 'Boz', '#8b4513' => 'Qəhvəyi',];
                                                $size = '';
                                                    if($item->size > 0){
                                                        $sizes = App\Models\ProductSize::where('id', $item->size)->firstOrFail();
                                                        $size = $sizes->size;
                                                    }
                                                    else{
                                                        $size = '';
                                                    }
                                                    $color = '';
                                                    if($item->color > 0){
                                                        $colors = App\Models\ProductColor::where('id', $item->color)->firstOrFail();
                                                        $color = $color_arr[$colors->value];
                                                    }
                                                    else{
                                                        $color = '';
                                                    }
                                                    
                                                @endphp
                                            {!!($item->size > 0)  ? '<p>Ölçü: <span>'.$size.'</span>‎</p>' : ''!!}
                                            {!!($item->color > 0)  ? '<p>Rəng: <span>'.$color.'</span>‎</p>' : ''!!}
                                        </td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->amount * $item->piece }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="ttl-amts">
                    <h5>Endirim : {{ (isset($discount)) ? $discount : '' }}</h5>
                </div>
                <hr>
                <div class="ttl-amts">
                    <h4 style="text-transform: uppercase"><strong>Ümumi Mebleg : {{ (isset($total_amount)) ? $total_amount : '' }}</strong></h4>
                </div>
                
            </div>
        </div>
    </div>
