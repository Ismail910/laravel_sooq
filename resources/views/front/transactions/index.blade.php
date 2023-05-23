@extends('layouts.app')
@section('styles')
    <style>
        .title {
            margin-bottom: 15px; 
        }

        .transaction-card {
            width: 31%;
            min-width: fit-content;
            padding: 10px;
            border: 1px solid #c8c8c8;
            border-radius: 10px;
            margin-bottom: 15px;
            margin-inline-end: 15px 
        }

        .transaction-id,
        .transaction-amount,
        .transaction-way,
        .transaction-type,
        .transaction-date {
            text-align: start;
            margin-bottom: 10px; 
        }
    </style>
@endsection
@section('content')
    <div class="container my-3">
        <div class="title">{{ __('lang.MyWallet') }}</div>
        <div class="row text-center transactions-container">
            @forelse($transactions as $transaction)
                <div class="transaction-card" data-id="{{ $transaction->id }}">
                    <div class="transaction-id">
                        {{ __('lang.TransactionID') . ": " . $transaction['transaction_id'] }}
                    </div>
                    <div class="transaction-amount">
                        {{ __('lang.TransactionAmount') . ": " . abs($transaction['amount']) . " " . $currency }}
                    </div>
                    <div class="transaction-way">
                        {{ __('lang.TransactionWay') . ": " . ($transaction['type'] == 'manual' ? __('lang.Manual') : "" ) }}
                    </div>
                    <div class="transaction-type">
                        {{ __('lang.TransactionType') . ": " . ($transaction['amount'] > 0 ? __('lang.Addition') : __('lang.Deduction') ) }}
                    </div>
                    <div class="transaction-date">
                        {{ __('lang.TransactionDate') . ": " . (date("l d M Y, H:i", strtotime($transaction['created_at']))) }}
                    </div>
                </div>
            @empty
                <div class="text-center">
                    {{ __('lang.No Current Data') }}
                </div>
            @endforelse
        </div>

        <div class="d-flex align-items-center justify-content-center load-more">
            <a type="button" class="btn btn-sm mainBgColor cursor-pointer" onclick="loadMoreTransactions()">{{ __("lang.LoadMore") }}</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const number_of_transactions = <?=$num_of_transactions?>;

        function loadMoreTransactions () {
            const last_id = $(".transaction-card").last().attr("data-id");

            $.ajax({
                url: "{{ route('front.transactions.load.more') }}",
                type: "POST",
                data: { _token: "{{csrf_token()}}", last_id: last_id },
                success: function(response) {
                    for(const transaction of response['transactions']) {
                        const res =  `<div class="transaction-card" data-id="${transaction['id']}">
                                <div class="transaction-id">` + 
                                    "{{ __('lang.TransactionID') }}" + ": " + transaction['transaction_id'] + `
                                </div>
                                <div class="transaction-amount">` + 
                                    "{{ __('lang.TransactionAmount') }}" + ": " + Math.abs(transaction['amount']) + " " + "{{ $currency }}"  + `
                                </div>
                                <div class="transaction-way">` + 
                                    "{{ __('lang.TransactionWay') }}" + ": " + (transaction['type'] == 'manual' ? "{{ __('lang.Manual') }}"  : "" )  + `
                                </div>
                                <div class="transaction-type">` + 
                                    "{{ __('lang.TransactionType') }}" + ": " + (transaction['amount'] > 0 ? "{{ __('lang.Addition') }}" : "{{ __('lang.Deduction') }}")  + `
                                </div>
                                <div class="transaction-date">` + 
                                    "{{ __('lang.TransactionDate') }}" + ": " + transaction['date']  + `
                                </div>
                            </div>`;
                        }

                    $(res).hide().appendTo($(".transactions-container")).show('slow');
                    toggleLoadButton();
                },
                failed: function(error) {
                    toggleLoadButton();
                }
            });
        }

        function toggleLoadButton() {
            if($(".transaction-card").length >= number_of_transactions ) {
                $(".load-more").remove();
            }
        }

        $(() => { toggleLoadButton() });
    </script>
@endsection