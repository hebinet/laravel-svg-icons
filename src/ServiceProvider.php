<?php namespace Hebinet\SvgIcons;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/icons.php' => config_path('icons.php'),
            ], 'config');
        }

        Blade::directive('icon', function ($iconString) {
            return "<?php echo (new " . Icon::class . "({$iconString}))->render(); ?>";
        });
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/icons.php', 'icons');
    }
}
