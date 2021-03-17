<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class BlueprintServiceProvider extends ServiceProvider
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
    public function boot()
    {
        Blueprint::macro('commonColumn', function(bool $isValid = false, string $validName = '有効フラグ'): void {
            if ($isValid) {
                $this->boolean('valid')->default(true)->comment($validName);
            }
            $this->timestamps();
            $this->softDeletes();
            $this->string('sysinfo', 64);
        });
        Blueprint::macro('parent', function(string $comment, string $table, string $column = 'id') {
            $myColumn = Str::singular($table) . "_{$column}";
            $this->unsignedBigInteger($myColumn)->comment($comment);
            $this->foreign($myColumn)->references($column)->on($table);
        });
    }
}
