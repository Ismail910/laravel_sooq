@extends('layouts.app')
@section('styles')
    <style>
        .representative-card {
            width: 100%;
            height: fit-content;
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            border: 2px solid #e5e5e5;
            border-radius: 10px;
            padding: 20px;
        }

        .representative-image-container {
            max-width: 200px;
            max-height: 300px;
        }
        .representative-image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .representative-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .representative-info > div {
            height: fit-content;
            word-break: break-all;
        }
        .representative-info > div {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 5px;
        }
        .representative-info > div > div:first-of-type{
            min-width: fit-content;
            word-break: keep-all;
            text-align: start;
        }
        .representative-info > div > div:last-child{
            text-align: start;
            word-break: keep-all;
        }
    </style>
@endsection
@section('content')
    <div class="container my-3">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="title">{{ __('lang.Representatives') }}</div>

            <form method="GET" filter-form>
                <div class="custom-select2">
                    <select name="country_filter" id="country_filter" style="width: 200px; border-radius: 5px !important">
                        <option value="">{{ __('lang.Country') }}</option>
                        @foreach ($countries as $country)
                            <option @selected(isset($country_filter) && $country_filter == $country->id) value="{{ $country->id }}">
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="row text-center representatives-container">
            @forelse($representatives as $representative)
                <div class="representative-card" data-id="{{ $representative->id }}">
                    <div class="representative-image-container">
                        <img src="{{$representative->photoUrl()}}" alt="Representative Image">
                    </div>
                    <div class="representative-info">
                        <div>
                            <div>{{ __('lang.Name') . ":" }}</div> 
                            <div>{{ $representative->name }}</div>
                        </div>
                        <div>
                            <div>{{ __('lang.Phone') . ":" }}</div>
                            <div>+{{ $representative->country?->phone_code + $representative->phone }}</div>
                        </div>
                        <div>
                            <div>{{ __('lang.Country') . ":" }}</div>
                            <div>{{ $representative->country?->name }}</div>
                        </div>
                        <div>
                            <div>{{ __('lang.Bio') . ":" }}</div> 
                            <div>{{ $representative->description }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    {{ __('lang.No Current Data') }}
                </div>
            @endforelse
        </div>

        <div class="d-flex align-items-center justify-content-center load-more">
            <a type="button" class="btn btn-sm mainBgColor cursor-pointer" onclick="loadMore()">{{ __("lang.LoadMore") }}</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const number_of_representatives = <?=$num_of_representatives?>;
        function loadMore() {
            $.ajax({
                url: "{{ route('front.representatives.load.more') }}",
                type: "POST",
                data: { _token: "{{csrf_token()}}", last_id: $(".representative-card").last().attr("data-id"), country_filter: $("#country_filter").val() },
                success: function(response) {
                    console.log(response);
                    for(const representative of response['representatives']) {
                        const res = `<div class="representative-card" data-id="${representative['id']}"><div class="representative-image-container">
                                <img src="${representative['photoUrl']}" alt="Representative Image">
                            </div>
                            <div class="representative-info">
                                <div>
                                    <div>{{ __('lang.Name') . ":" }}</div> 
                                    <div>${representative['name']}</div>
                                </div>
                                <div>
                                    <div>{{ __('lang.Phone') . ":" }}</div>
                                    <div>+${representative['country_phone_code'] + representative['phone']}</div>
                                </div>
                                <div>
                                    <div>{{ __('lang.Country') . ":" }}</div>
                                    <div>${representative['country_name']}</div>
                                </div>
                                <div>
                                    <div>{{ __('lang.Bio') . ":" }}</div> 
                                    <div>${representative['description']}</div>
                                </div>
                        </div></div>`;
                        $(res).hide().appendTo($(".representatives-container")).show('slow');
                    }
                    toggleLoadButton();
                    setTitles();
                },
                failed: function(error) {
                    toggleLoadButton();
                }
            });
        }

        function setTitles() {
            // Get all divs inside .representative-info
            const divs = $('.representative-info > div > div:first-of-type');

            // Find the maximum content width of all divs
            let maxWidth = 0;
            divs.each(function() {
            const width = $(this).get(0).scrollWidth;
            if (width > maxWidth) {
                maxWidth = width;
            }
            });

            // Set the min-width of each div to the maximum content width
            divs.css('min-width', maxWidth + 'px');
        }

        function toggleLoadButton() {
            if($(".representative-card").length >= number_of_representatives ) {
                $(".load-more").remove();
            }
        }

        $(() => { 
            toggleLoadButton(); 
            setTitles();
        });

        $("#country_filter").on('change input', () => {
            $("[filter-form]").submit();
        });
    </script>
@endsection