<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // if (! $this->app->routesAreCached()) {
            // Passport::routes();
        // }

        // $this->registerPolicies(); 
        
        // Passport::useTokenModel(Token::class); 
        // Passport::useClientModel(Client::class); 
        // Passport::useAuthCodeModel(AuthCode::class); 
        // Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        Passport::tokensExpireIn(now()->addDays(15));
        // Passport::refreshTokensExpire(now()>addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
