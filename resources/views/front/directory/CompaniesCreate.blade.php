@extends('layouts.app')
@section('content')
    <style>
        #app {
            margin-right: 2rem;
        }
    </style>
    <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
        action="{{ route('admin.directory.store') }}">
        @csrf
        <div class="mt-5 mb-3 d-flex flex-wrap flex-row justify-content-between"
            style="direction: @if (app()->getlocale() == 'ar') rtl @else ltr @endif" style="">
            <div class="mb-5">
                <h2 style="color: {{ $settings->main_color() }}"> {{ __('lang.AddYourStore') }}</h2>
                {{ __('lang.addStorePlaceholder') }}
            </div>

            <div style="cursor:pointer; position:relative; margin-top:0 !important;">
                <div style="position: absolute;display:none;left: 0" id="remove-input"><i class="fas fa-times"></i></div>
                <label for="imgInp"
                    style="cursor:pointer; border-radius: 50%;border: {{ $settings->main_color() }} 7px solid;overflow: hidden;">
                    <img id="imgOut" src="{{ asset('images/default/image.jpg') }}" alt="Default Image" width="150"
                        height="150">
                </label>
                <input type="file" name="img" id="imgInp" class="form-control d-none" value="{{ old('img') }}"
                    accept="image/png, image/jpg, image/jpeg, image/webp">
                <script>
                    const imagePreview = (imgInp, imgOut, rmIcon) => {
                        const fileIn = document.getElementById(imgInp),
                            fileOut = document.getElementById(imgOut),
                            removeIcon = document.getElementById(rmIcon);

                        fileOutOldVal = fileOut.src;

                        removeIcon.onclick = () => {
                            fileOut.src = fileOutOldVal;
                            fileIn.value = '';
                        };
                        const readUrl = event => {
                            if (event.files && event.files[0]) {
                                let reader = new FileReader();
                                reader.onload = event => fileOut.src = event.target.result;
                                reader.readAsDataURL(event.files[0]);
                                removeIcon.style.display = "unset";
                            }
                        }
                        fileIn.onchange = function() {
                            readUrl(this);
                        };
                    }
                    imagePreview("imgInp", "imgOut", "remove-input");
                </script>
            </div>
        </div>

        <div class="d-flex flex-wrap data"
            style="gap: 20px; direction: @if (app()->getlocale() == 'ar') rtl @else ltr @endif">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach (config('laravellocalization.supportedLocales') as $key => $lang)
                        <li class="nav-item mx-auto" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $key }}-tab"
                                data-bs-toggle="pill" href="#pills-{{ $key }}" role="tab"
                                aria-controls="pills-{{ $key }}" aria-selected="true">{{ $lang['native'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent"
                    style="border: 3px solid #e5e5e5; border-radius: 10px; padding: 5px">
                    @foreach (config('laravellocalization.supportedLocales') as $key => $lang)
                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="pills-{{ $key }}"
                            role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">
                            <div class="col-12 col-lg-12 p-2">
                                <div class="col-12">
                                    {{ __('lang.name') }}
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="{{ $key }}[name]" required data-name
                                        class="form-control" value="{{ old($key . '.name') }}">
                                </div>

                                <div class="col-12">
                                    {{ __('lang.Page Desc') }}
                                </div>
                                <div class="col-12 pt-3">
                                    <textarea name="{{ $key }}[description]" required data-description class="form-control" style="resize: none;"
                                        placeholder="{{ __('lang.Page Desc Placeholder') }}" rows="5">{{ old($key . '.description') }}</textarea>
                                </div>

                                <div class="col-12">
                                    {{ __('lang.Company Address') }}
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="{{ $key }}[address]" required data-address
                                        value="{{ old($key . '.address') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-7">
                <livewire:category :subcategory_id="old('Category')" :category_id="old('category_id')" />

                <span class="text-bold">{{ __('lang.Commercial Licence') }}</span>
                <input type="file" name="license" id="license" class="form-control"
                    accept="image/png, image/jpg, image/jpeg, image/webp">

                <livewire:city :country_id="old('Country')" :city_id="old('City')" />

                <label for="phone">{{ __('lang.phone') }}</label>
                <input type="number" class="form-control" value="{{ old('number') }}" required name="phone"
                    id="phone">
            </div>

        </div>

        <div class="col-12 col-sm-4 mt-3 mb-2 d-flex flex-column justify-content-center w-100" style="text-align: center;">
            <div class="form-check">
                <input name="policy" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"
                    style="float: unset;margin: 5px;" required>
                <label class="form-check-label" for="flexCheckDefault">
                    {{ __('lang.IAgreeTo') }} <a href="#"
                        style="color:{{ $settings->main_color() }} !important;">{{ __('lang.Terms of Service') }}</a>
                </label>
            </div>
            <input type="hidden" name="type" value="2">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="lang" value="{{ app()->getlocale() }}">
            <div>
                <button class="btn btn-success" id="submitEvaluation"
                    style="padding: 0.5rem 3rem;background-color: {{ $settings->main_color() }};">{{ __('lang.Confirmandcreatestore') }}</button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('input[data-name], textarea[data-description], input[data-address]').on('input', function() {
            const currentLangCode = $(this).closest('.tab-pane').attr('id').replace('pills-', '');

            // Loop through each language
            $('.tab-pane').each(function() {
                const langCode = $(this).attr('id').replace('pills-', '');

                const name = $('[name="' + langCode + '[name]"]').val();
                const description = $('[name="' + langCode + '[description]"]').val();
                const address = $('[name="' + langCode + '[address]"]').val();

                if (name && description && address) {
                    console.log("optional");
                    setTimeout(() => {
                        $('input[data-name], textarea[data-description], input[data-address]').removeAttr('required');
                    }, 0);
                    return false;
                } else {
                    setTimeout(() => {
                        $('input[data-name], textarea[data-description], input[data-address]').attr('required', true);
                    }, 0);
                }
            });
        });
    </script>
@endsection
