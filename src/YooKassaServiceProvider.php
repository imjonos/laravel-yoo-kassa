<?php

namespace Nos\YooKassa;

use Illuminate\Support\ServiceProvider;
use Nos\YooKassa\Interfaces\Repositories\PaymentRepositoryInterface;
use Nos\YooKassa\Repositories\PaymentRepository;
use YooKassa\Client;

final class YooKassaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(resource_path('lang/vendor/nos/yookassa'), 'nos.yookassa');
        $this->loadViewsFrom(resource_path('views/vendor/nos/yookassa'), 'nos.yookassa');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/yookassa.php' => config_path('yookassa.php'),
        ], 'yookassa.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/nos/yookassa')
        ], 'yookassa.views');

        // Publishing the js.
        $this->publishes([
            __DIR__ . '/../resources/js' => base_path('resources/js/vendor/nos/yookassa'),
        ], 'yookassa.js');

        // Publishing the translation files.
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/nos/yookassa'),
        ], 'yookassa.lang');

        // Publishing migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => base_path('database/migrations'),
        ], 'yookassa.migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/yookassa.php', 'yookassa');

        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

        $this->app->bind(Client::class, function () {
            $client = new Client();
            $client->setAuth(config('yookassa.shop_id'), config('yookassa.api_key'));

            return new $client();
        });

        $this->app->singleton('yookassa', function () {
            return new YooKassa();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['yookassa'];
    }
}
