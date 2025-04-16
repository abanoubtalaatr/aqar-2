<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Ad;
use App\Models\Order;
use App\Policies\AdPolicy;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Ad::class => AdPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
