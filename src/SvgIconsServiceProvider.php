<?php

namespace Hebinet\SvgIcons;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SvgIconsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/icons.php' => config_path('icons.php'),
            ], 'config');
        }

        View::composer('hebinet::svgIcon', SvgIconsViewComposer::class);

        Blade::directive('icon', function () {
            return "<?php echo view('hebinet::svgIcon'); ?>";
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/icons.php', 'icons');
    }
}
