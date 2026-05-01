<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    /**
     * Bootstrap any application services.
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
