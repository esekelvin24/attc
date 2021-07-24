<?php

namespace App\Providers;
use Validator;
use Illuminate\Support\ServiceProvider;

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
        //
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
        Validator::extend('accountDisabled', 'App\\Validators\\CustomLogin@accountDisabled');
        Validator::extend('accountLocked', 'App\\Validators\\CustomLogin@accountLocked');
        Validator::extend('accountConfirmationEmail', 'App\\Validators\\CustomLogin@accountConfirmationEmail');
        Validator::extend('loginCheck', 'App\\Validators\\CustomLogin@loginCheck');
        
    }
}          
