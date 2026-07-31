<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Laravel automatically discovers components from resources/views/components
        // Namespace format: x-folder.component-name maps to resources/views/components/folder/component-name.blade.php

        \Illuminate\Database\Eloquent\Model::shouldBeStrict(!$this->app->isProduction());
    }
}
