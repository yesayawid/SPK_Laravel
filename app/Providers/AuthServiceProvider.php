<?php

namespace App\Providers;

use App\Models\User;
use App\Models\TourismObject;
use Illuminate\Support\Facades\Gate;
use App\Policies\TourismObjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    TourismObject::class => TourismObjectPolicy::class
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    Gate::define('admin', function (User $user) {
      return ($user->level === 'SUPERADMIN' || $user->level === 'ADMIN');
    });
  }
}
