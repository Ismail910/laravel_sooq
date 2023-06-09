@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12 mx-auto text-start px-3 mt-3" style="">
            <div class="col-12 p-4 align-items-center justify-content-center" style="height:100vh">
                <div class="card">
                    <div class="card-header">{{ __('lang.Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('lang.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('lang.Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- <div class="form-group row mb-0 p-4"> --}}
                                <div class="mt-5 mx-auto text-center">
                                    <button type="submit" class="btn p-3 btn-primary">
                                        {{ __('lang.Reset Password') }}
                                    </button>
                                </div>
                            {{-- </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
