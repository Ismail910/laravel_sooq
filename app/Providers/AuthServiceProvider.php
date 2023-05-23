<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Article::class => \App\Policies\ArticlePolicy::class,
        \App\Models\Redirection::class => \App\Policies\RedirectionPolicy::class,
        \App\Models\Contact::class => \App\Policies\ContactPolicy::class,
        \App\Models\ContactReply::class => \App\Policies\ContactReplyPolicy::class,
        \App\Models\Page::class => \App\Policies\PagePolicy::class,
        \App\Models\Menu::class => \App\Policies\MenuPolicy::class,
        \App\Models\MenuLink::class => \App\Policies\MenuLinkPolicy::class,
        \App\Models\Faq::class => \App\Policies\FaqPolicy::class,
        \App\Models\Setting::class => \App\Policies\SettingPolicy::class,
        \App\Models\HubFile::class => \App\Policies\HubFilePolicy::class,
        \App\Models\RateLimit::class => \App\Policies\RateLimitPolicy::class,
        \App\Models\ReportError::class => \App\Policies\ReportErrorPolicy::class,
        \App\Models\Announcement::class => \App\Policies\AnnouncementPolicy::class,
        \App\Models\Transaction::class => \App\Policies\TransactionPolicy::class,
        \App\Models\Representative::class => \App\Policies\RepresentativePolicy::class,
        \App\Models\Role::class => \App\Policies\RolePolicy::class,
        \App\Models\HelpCenter::class => \App\Policies\HelpCenterPolicy::class,
        \App\Models\Directory::class => \App\Policies\DirectoryPolicy::class,
        \App\Models\Slider::class => \App\Policies\SliderPolicy::class,
        \App\Models\Voucher::class => \App\Policies\VoucherPolicy::class,
        \App\Models\Country::class => \App\Policies\CountryPolicy::class,
        \App\Models\Currency::class => \App\Policies\CurrencyPolicy::class,
        \App\Models\City::class => \App\Policies\CitiyPolicy::class,
        \App\Models\State::class => \App\Policies\StatePolicy::class,
        \App\Models\Store::class => \App\Policies\StorePolicy::class,
        \App\Models\Package::class => \App\Policies\PackagePolicy::class,
        \App\Models\Subscription::class => \App\Policies\SubscriptionPolicy::class,
        \App\Models\Table::class => \App\Policies\TablePolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('show-statistics',[\App\Policies\StatisticPolicy::class,'viewAny']);
    }
}
