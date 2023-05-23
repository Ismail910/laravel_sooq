@extends('layouts.app',['page_title'=>"الدفع"])
@section('content')
    <div class="col-12 p-0">
        <div class=" p-0 container text-center">
            <div class="col-12 p-2 p-lg-3 row">
                <div class="col-12 px-2 pt-5 pb-3">
                    <div class="col-12 p-0 font-4">
                        <span class="start-head"></span> الدفع عبر بايبال
                    </div>
                </div>
                <div class="col-12">
                    <form action="{{ route('checkout.payment') }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-success" value="تابع إلى بايبال">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
