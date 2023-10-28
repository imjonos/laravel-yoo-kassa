<?php

namespace Nos\YooKassa;

use Illuminate\Support\ServiceProvider;
use Nos\YooKassa\Interfaces\Repositories\PaymentRepositoryInterface;
use Nos\YooKassa\Repositories\PaymentRepository;
use Nos\YooKassa\Services\PaymentService;
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
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
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

        $this->app->bind(PaymentService::class, function () {
            return new PaymentService(
                app(Client::class),
                app(PaymentRepositoryInterface::class),
                config('yookassa.return_url')
            );
        });

        $this->app->bind(Client::class, function () {
            $client = new Client();
            $client->setAuth(config('yookassa.shop_id'), config('yookassa.api_key'));

            return $client;
        });

        $this->app->singleton('YooKassa', function () {
            return new YooKassa(app(PaymentService::class));
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
