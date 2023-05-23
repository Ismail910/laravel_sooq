@extends('layouts.app')
@section('styles')
    <style>
        .search {
            display: none;
        }

        .full-height {
            height: 80vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }
        .payment_type {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 7px;
            margin: 10px 0;
            text-align: right;
            padding-right: 30px;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center full-height position-ref">
        <div class="my-2">
            <span class="fad fa-bullhorn mainColor" style="font-size: 120px"></span>
        </div>
        <h3 class="my-3 mainColor">
            {{ __('lang.Announcement Publiched') }}
        </h3>

        <h5 class="my-3 font-2">
            {{ __('lang.Announcement VIP') }}
        </h5>
        <h3 class="my-3">
            <a class="mainColor" href="{{ route('front.announcements.show', $announcement) }}">
                {{ __("lang.Announcement Code"). ' : #' . $announcement->number }}
            </a>
        </h3>
        <form action="{{ route('checkout.payment') }}" method="post" class="w-100 my-4">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6 text-center">
                    <div>
                        <div class="payment_type">
                            <i class="fab fa-paypal fa-lg mx-2"></i>
                            <input type="radio" id="paypal" name="payment_method" value="paypal">
                            <label for="paypal">الدفع عبر بايبال</label>
                        </div>
                        <div class="payment_type">
                            <i class="fa fa-wallet fa-lg mx-2"></i>
                            <input type="radio" id="wallet" name="payment_method" value="wallet">
                            <label for="wallet">
                                الدفع عبر الرصيد
                                - رصيدك
                                ({{ auth()->user()->balance }} JOD)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-center mt-auto">
                    <div class="px-4">
                        <input type="submit" class="btn btn-success btn-lg w-100" value="دفع">
                    </div>
                </div>
            </div>
        </form>
{{--        <a target="_blank" href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp_link }}&text={{ __('lang.Announcement VIP') . ' ' . __("lang.Announcement Code"). ' : ' . $announcement->number }}" class="btn btn-block w-25 my-2 py-2 rad14" style="background: rgb(44, 190, 44);color:cornsilk">{{ __("lang.what'sapp") }}</a>--}}
    </div>
@endsection
