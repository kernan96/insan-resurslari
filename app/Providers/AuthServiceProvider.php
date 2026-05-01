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
        //
    ];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Carbon::setLocale('az');
        
        // HTTPS forced - Render.com və digər production mühitləri üçün
        if (env('APP_ENV') === 'production' || env('APP_FORCE_HTTPS') === 'true') {
            URL::forceScheme('https');
        }
        
        // Alternativ: X-Forwarded-Proto header varsa (Render.com, Heroku və s. üçün)
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            URL::forceScheme('https');
        }
    }
}
