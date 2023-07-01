<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create', fn () => $this->isAdmin());
        Gate::define('update', fn (User $user) => $this->isAdmin() || Auth::check() && $user->id == Auth::user()->id);
        Gate::define('delete', fn () => dd($this->isAdmin()));
    }

    private function isAdmin()
    {
        return  in_array(Role::ADMIN, array_column(auth()->user()->roles->toArray(), 'id'));
    }
}
