<?php

namespace App\Providers;

use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;
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
        if (config('env') !== 'production') {
            TestResponse::macro('assertStatusCode', function (int $statusCode = 200) {
                $actual = $this->getStatusCode();

                $dumpStatus = [500, 422];
                if (in_array($actual, $dumpStatus)) {
                    $this->dump();
                }
                Assert::assertSame(
                    $actual,
                    $statusCode,
                    "Expected status code {$statusCode} but received {$actual}."
                );

                return $this;
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
