<?php

namespace App\Providers;

use App\Models\RateLimit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // \App\Models\ContactReply::observe(\App\Observers\ContactReplyObserver::class);
        // \App\Models\Contact::observe(\App\Observers\ContactObserver::class);

        Paginator::useBootstrapFive();
        Schema::defaultStringLength(191);
        if(Schema::hasTable('settings')){
            $settings = \App\Models\Setting::count();
            if($settings==0)
                \App\Models\Setting::create([
                    'website_name'=>"اسم الموقع هنا",
                    'website_bio'=>"نبذة عن الموقع",
                    'main_color'=>"#821b10",
                    'hover_color'=>"#821b10",
                ]);
            $settings = \App\Models\Setting::first();
            View::share('settings', $settings);
        }
        \Spatie\Flash\Flash::levels([
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);
        
        View::share('users_count', User::count());

        $num_of_visits = RateLimit::count();
        View::share('num_of_visits', $num_of_visits);
    }
}
