@php 
    $lang = app()->getLocale();
@endphp
<style>
    .md-header {
        display: none;
        /* @if($lang == 'ar') align-items: center; @endif */
        justify-content: end;
        height: 50px;
        gap: 0 !important;
    }

    .links-menu {
        display: flex;
        align-items: center;
        list-style: none;
        gap: 20px;
        @if($lang == 'ar') gap: 0 !important; @endif
    }

    .links-menu li {
        font-weight: bold !important;
        height: 40px;
    }

    .logo img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .links-menu .isolated {
        margin-inline-start: auto;
    }

    
    @if($lang == 'ar')
        .notifications {
            margin-bottom: -15px !important;
        }
    @endif


    .navBottom {
        gap: 70px;
    }
    .navBottom > span.d-flex{
        gap: 70px;
    }

    .notifications {
        margin-top: 7px !important;
    }

    @media (max-width: 992px) {
        .links-menu {
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .links-menu .isolated {
            margin: 0;
            flex-direction: column;
            align-items: flex-start !important;
        }

        .lg-header {
            display: none !important;
        }

        .md-header {
            display: flex;
            @if($lang == 'ar') {{ "gap: 20px;" }} @endif
            @if($lang != 'ar') 
                {{ "gap: 25px !important;" }}
            @endif
        }

        .navBottom{
            gap: 10px;
        }
        .navBottom > span.d-flex{
            gap: 10px;
        }

        #dropdown-notifications {
            margin-bottom: -15px;
        }

        .profile-img {
            margin-top: 5px;
        }

        .lang {
            margin-top: 10px;
        }
    }

    @media (min-width: 992px) and (max-width: 1118px) {
        .navBottom {
            gap: 40px;
        }
        .navBottom > span.d-flex{
            gap: 40px;
        }

        .navBottom a{
            transform: scale(0.8);
        }
    }
</style>
<div class="container-fluid px-3 py-2 font-2 fw-bold">
    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none"> @csrf </form>
    <nav class="navbar navbar-expand-lg">
        <div class="d-flex align-items-center justify-content-between w-100">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="far fa-bars font-4"></span>
            </button>

            <div class="isolated md-header">
                <div class="nav-item dropdown" @if($lang == 'ar') style="top: -5px" @endif>
                    <a class="nav-link dropdown-toggle font-2 lang" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                        <span class="fas fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu text-center">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if(auth()->check())
                    <div class="notifications btn-group notificationDropdown">
                        <div class="col-12 px-0 d-flex justify-content-center align-items-center btn" style="width: 35px; height: 35px; background: #f6f6f6; border: 1px solid #e5e5e5; border-radius: 50%; margin-bottom: -5px" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-notifications">
                            <span class="fas fa-bell font-3 d-inline-block"style="color: #333;transform: rotate(15deg)"></span>
                            <span style="position: absolute;min-width: 25px;min-height: 25px; right: 0px;top: 0px;border-radius: 20px;background: #c00;color:#fff;font-size: 14px; @if ($unreadNotifications != 0) display: inline-block; @else display: none; @endif" d="dropdown-notifications-icon">{{ $unreadNotifications }}</span>
                        </div>
                        <div class="dropdown-menu py-0 rounded-0 border-0 shadow "
                            style="{{(App::isLocale('ar') ? "right: unset; left: 0; " : "left:unset; right: 0; ") . "cursor: auto!important;z-index: 20000;min-width: 200px;height: 450px;" }}; margin-top: -20px">
                            <div class="col-12 notifications-container" style="height:406px;overflow: auto;">
                                <x-notifications :notifications="$notifications" />
                            </div>
                            <div class="col-12 d-flex border-top">
                                <a href="{{ route('front.notifications.index') }}" class="d-block py-2 px-3 ">
                                    <div class="col-12 align-items-center">
                                        <span class="fal fa-bells"></span> عرض كل الإشعارات
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="user d-flex align-items-center" @if($lang != 'ar') style="top: -5px" @endif>
                    @if (auth()->check())
                        <a class="nav-link dropdown-toggle profile-img d-flex flex-column justify-content-center align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar ? asset('storage/uploads/users/' . auth()->user()->avatar ) : asset('images/default/avatar.png') }}" alt="" style="border-radius: 50%" width="40" height="40">
                            <small>{{ __("lang.Profile") }}</small>
                        </a>
                        <ul class="user_dropdown dropdown-menu text-center" style="{{App::isLocale('ar') ? "right: unset; left: 0;" : "left:unset; right: 0"}}; margin-top: -80px">
                            <li class="nav-item pt-2"><a class="nav-link font-2"
                                    href="{{ route('front.profile') }}">{{ auth()->user()->name }}</a></li>
                            <li class="nav-item pt-2"><a class="nav-link font-2"
                                    href="{{ route('front.transactions.index') }}">{{ __('lang.MyWallet') }}
                                </a>
                            </li>
                            <li class="nav-item pt-2"><a class="nav-link font-2"
                                    href="{{ route('front.chat') }}">{{ __('lang.messages') }}
                                </a>
                            </li>
                            @if (auth()->user()->store)
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.store.my_store') }}">{{ auth()->user()->store->name }}</a>
                                </li>
                            @else
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.store.create') }}">{{ __('lang.OpenStore') }}</a></li>
                            @endif
                            <li class="nav-item pt-2"><a class="nav-link font-2" href="#"
                                    onclick="document.getElementById('logout-form').submit();">{{ __('lang.Logout') }}</a>
                            </li>
                        </ul>
                    @else
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ auth()->check()? auth()->user()->getUserAvatar() : asset('images/default/avatar.png') }}" alt="" style="border-radius: 50%" width="40" height="40">
                        </a>
                    @endif    
                </div>
            </div>
        </div> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="col-12 links-menu">
                <li class="nav-item logo">
                    <a class="navbar-brand mainColor mx-3" href="/">
                        <img src="{{ $settings->website_logo() }}" alt="Logo">
                    </a>  
                </li>

                <li class="nav-item pt-2">
                    <a class="nav-link font-2 active" href="{{ route('home') }}">{{ __('lang.Go Home') }}</a>
                </li>

                <li class="nav-item pt-2">
                    <a class="nav-link font-2"
                        href="{{ route('front.categories.index') }}">{{ __('lang.Categories') }}</a>
                </li>

                <li class="nav-item pt-2">
                    <a class="nav-link font-2" href="{{ route('front.stores.index') }}">{{ __('lang.Stores') }}</a>
                </li>

                <li class="nav-item pt-2 position-relative">
                    <a class="nav-link dropdown-toggle font-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __('lang.FreeDirectory') }}</a>
                    <ul class="dropdown-menu text-center">
                        <li class="my-3"><a href="{{route("front.directory.companies")}}">{{__("lang.companies")}}</a></li>
                        <li class="my-3"><a href="{{route("front.directory.individuals")}}">{{__("lang.individuals")}}</a></li>
                    </ul>
                </li>

                <li class="nav-item pt-2">
                    <a class="nav-link font-2" href="{{route('help')}}">{{ __('lang.HelpCenter') }}</a>
                </li>

                @if (!auth()->check())
                    <li class="nav-item pt-2"><a class="nav-link font-2" href="/login">{{ __('lang.Login') }}</a></li>
                @endif

                <div class="d-flex align-items-center justify-content-end isolated lg-header" style="margin-bottom: -15px; @if($lang != 'ar') gap: 25px; @endif">
                    <li class="nav-item dropdown" style="margin-bottom: 5px">
                        <a class="nav-link dropdown-toggle font-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ LaravelLocalization::getCurrentLocaleNative() }}
                            <span class="fas fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu text-center">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    @if(auth()->check())
                        <li class="nav-item dropdown btn-group notificationDropdown" @if($lang != 'ar') style="margin-top: -15px" @endif>
                            <a class="col-12 px-0 d-flex dropdown-toggle justify-content-center align-items-center btn" style="width: 35px; height: 35px; background: #f6f6f6; border: 1px solid #e5e5e5; border-radius: 50%; @if($lang != 'ar') margin-bottom: -5px @endif" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-notifications">
                                <span class="fas fa-bell font-3 d-inline-block"style="color: #333;transform: rotate(15deg)"></span>
                                <span style="position: absolute;min-width: 25px;min-height: 25px; right: -15px;top: -15px;border-radius: 20px;background: #c00;color:#fff;font-size: 14px; @if ($unreadNotifications != 0) display: inline-block; @else display: none; @endif" d="dropdown-notifications-icon">{{ $unreadNotifications }}</span>
                            </a>
                            <ul class="dropdown-menu py-0 rounded-0 border-0 shadow" style="{{(App::isLocale('ar') ? "right: unset; left: 0; " : "left:unset; right: 0; ") . "cursor: auto!important;z-index: 20000;width: 350px;height: 450px;" }};">
                                <div class="col-12 notifications-container" style="height:406px;overflow: auto;">
                                    <x-notifications :notifications="$notifications" />
                                </div>
                                <div class="col-12 d-flex border-top">
                                    <a href="{{ route('front.notifications.index') }}" class="d-block py-2 px-3 ">
                                        <div class="col-12 align-items-center">
                                            <span class="fal fa-bells"></span> عرض كل الإشعارات
                                        </div>
                                    </a>
                                </div>
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item dropdown d-flex align-items-center">
                        @if (auth()->check())
                            <a class="nav-link dropdown-toggle profile-img d-flex flex-column justify-content-center align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user()->avatar ? asset('storage/uploads/users/' . auth()->user()->avatar ) : asset('images/default/avatar.png') }}" alt="" style="border-radius: 50%" width="40" height="40">
                                <small>{{ __("lang.Profile") }}</small>
                            </a>
                            <ul class="user_dropdown dropdown-menu text-center" style="{{App::isLocale('ar') ? "right: unset; left: 0;" : "left:unset; right: 0"}};">
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.profile') }}">{{ auth()->user()->name }}</a></li>
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.transactions.index') }}">{{ __('lang.MyWallet') }}
                                    </a>
                                </li>
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.chat') }}">{{ __('lang.messages') }}
                                    </a>
                                </li>
                                @if (auth()->user()->store)
                                    <li class="nav-item pt-2"><a class="nav-link font-2"
                                            href="{{ route('front.store.my_store') }}">{{ auth()->user()->store->name }}</a>
                                    </li>
                                @else
                                    <li class="nav-item pt-2"><a class="nav-link font-2"
                                            href="{{ route('front.store.create') }}">{{ __('lang.OpenStore') }}</a></li>
                                @endif
                                <li class="nav-item pt-2"><a class="nav-link font-2" href="#"
                                        onclick="document.getElementById('logout-form').submit();">{{ __('lang.Logout') }}</a>
                                </li>
                            </ul>
                        @else
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" @if($lang != 'ar') style="margin-top: -10px" @endif>
                                <img src="{{ auth()->check()? auth()->user()->getUserAvatar() : asset('images/default/avatar.png') }}" alt="" style="border-radius: 50%" width="40" height="40">
                            </a>
                        @endif    
                    </li>
                </div>
            </ul>
        </div>

        <div class="w-100 d-flex justify-content-center mb-lg-0 col-12 col-md-3 text-end navBottom mt-4">
            <span><a href="./" class="btn btn-sm mainBgColor">{{ __('lang.visitors') . ' ' . $num_of_visits}} </a></span>
            <span class="d-flex justify-content-center">
                <a href="{{ route('front.store.my_store') }}" class="btn btn-sm mainBgColor">{{ __('lang.OpenStore') }} </a>
                <a href="{{ route('front.announcements.create') }}" class="btn btn-sm mainBgColor">{{ __('lang.AddAnnouncement') }}</a>
                <a href="{{ route('front.representatives.index') }}" class="btn btn-sm mainBgColor">{{ __('lang.Representatives') }}</a>
                @if(!auth()->check())
                    <a href="{{ route('register') }}" class="btn btn-sm mainBgColor">{{ __('lang.NewAccount') }}</a>
                @else 
                    <a href="{{ route('front.transactions.index') }}" class="btn btn-sm mainBgColor">{{ __('lang.MyWallet') }}</a>
                @endif
            </span>
        </div>
    </nav>
</div>
