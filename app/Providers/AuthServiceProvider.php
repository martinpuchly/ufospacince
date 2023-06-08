<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        App\Models\Group::class => App\Policies\GroupPolicy::class,
        App\Models\Permission::class => App\Policies\PermissionPolicy::class,
        App\Models\User::class => App\Policies\UserPolicy::class,
        App\Models\Player::class => App\Policies\PlayerPolicy::class,
        App\Models\Slide::class => App\Policies\SlidePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
