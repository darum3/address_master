<?php

namespace App\Providers;

use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\ServiceProvider;

use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertArrayHasKey;

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
            TestResponse::macro('assertJsonStrict', function (string $key, array $expect, array $anyValue = []) {
                // $this はTestResponse
                $dataArray = $this->baseResponse->getData(true);
                $actual = $dataArray[$key];
                $this->arrayAssertion($expect, $actual, '', $anyValue);
            });
            TestResponse::macro('arrayAssertion', function (array $expect, array $actual, $parent = '', array $anyValue = []) {
                assertTrue(count($expect) > 0 && count($actual) > 0);
                foreach ($expect as $k => $v) {
                    assertArrayHasKey($k, $actual, "Expected key not found, key is [{$k}] (Parent=[{$parent}])");
                    if (is_array($expect[$k])) {
                        $this->arrayAssertion($expect[$k], $actual[$k], $k);
                    } else {
                        assertSame($v, $actual[$k], "Expected [$k] is [{$v}], but actual is [{$actual[$k]}]");
                    }
                }
                foreach ($actual as $k => $v) {
                    if (!in_array($k, $anyValue)) {
                        assertArrayHasKey($k, $expect, "extra element exists in actual. key is [{$k}] (parent={$parent})");
                    }
                }
                foreach ($anyValue as $key) {
                    assertArrayHasKey($key, $actual, "Expected key not found [{$k}]");
                }
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
