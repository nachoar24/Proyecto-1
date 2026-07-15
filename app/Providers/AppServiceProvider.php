<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('es');

        Model::unguard();

        Model::shouldBeStrict(! app()->isProduction());

        if (method_exists(Model::class, 'automaticallyEagerLoadRelationships')) {

            Model::automaticallyEagerLoadRelationships();
        }

        Gate::define('view-admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
