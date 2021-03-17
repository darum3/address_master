<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexCitiesTable extends Migration
{
    private const CITIES  = 'cities';

    private const UNIQUE_INDEX_KEY = 'UQ_CITIES_01';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::CITIES, function(Blueprint $table) {
            $table->unique('city_code', self::UNIQUE_INDEX_KEY);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            self::CITIES,
            function (Blueprint $table) {
                $table->dropUnique(self::UNIQUE_INDEX_KEY);
            }
        );
    }
}
