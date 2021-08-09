<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        view()->composer("frontend.body.checkout.checkoutReview","App\Http\ViewComposer\TestViewComposer");
        view()->composer("frontend.body.category.category","App\Http\ViewComposer\TestViewComposer");
        view()->composer("frontend.body.cart.user-side-cart","App\Http\ViewComposer\TestViewComposer");
        view()->composer("frontend.body.checkout.index","App\Http\ViewComposer\TestViewComposer");
        view()->composer("frontend.header.header","App\Http\ViewComposer\TestViewComposer");
        view()->composer("backend.maincontent.nav.nav","App\Http\ViewComposer\TestViewComposer");


    }
}
