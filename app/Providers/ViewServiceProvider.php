<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $wasteCount = Product::where('product_status', '!=', 'Good')
                            ->where('product_waste', 0)
                            ->count();

            $view->with('wasteCount', $wasteCount);
        });
    }
}
