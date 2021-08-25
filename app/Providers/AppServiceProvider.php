<?php

namespace App\Providers;
use App\Models\CategoriiProduse;
use App\Models\Subcategorii;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('categorii', CategoriiProduse::get());
        View::share('subcategorii', Subcategorii::get());

        $this->loadHelpers();
    }
    protected function loadHelpers()
    {
        foreach (glob(app_path('Helpers/*.php')) as $filename) {
            require_once $filename;
        }
    }
}
