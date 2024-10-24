<?php

// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define a gate for admin access
        Gate::define('admin-access', function (User $user) {
            return $user->is_admin; // Assuming your User model has an is_admin boolean attribute
        });
    }
}
