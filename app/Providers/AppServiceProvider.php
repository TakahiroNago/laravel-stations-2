<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Rules\FiveMinDifference;

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
        $this->app['validator']->extend('five_min_difference', function ($attribute, $value, $parameters, $validator) {
            $otherValue = $validator->getData()[$parameters[0]];
            $rule = new FiveMinDifference($otherValue);
            return $rule->passes($attribute, $value);
        });
    }
}
