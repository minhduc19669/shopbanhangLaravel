<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CategoryProduct;
use App\BrandProduct;
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
        view()->composer('layout.leftlayout',function ($view)
        {
            $categories=CategoryProduct::where('category_status',0)->orderBy('category_id','desc')->get();
            $brands=BrandProduct::where('brand_status',1)->orderBy('brand_id','desc')->get();
            $view->with(['categories'=>$categories,'brands'=>$brands]);
        });
    }
}
