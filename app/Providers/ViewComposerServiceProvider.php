<?php

namespace Hydrofon\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer([
            'partials.resource-tree',
        ], \Hydrofon\Http\ViewComposers\ResourceListComposer::class);
        view()->composer([
            'partials.resource-tree',
        ], \Hydrofon\Http\ViewComposers\ResourceListSelectedComposer::class);
    }
}
