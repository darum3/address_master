<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    private string $cities = 'cities';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->cities, function (Blueprint $table) {
            $table->id();
            $table->parent('都道府県ID', 'prefectures');
            $table->string('city_name', 20)->comment('市区町村名');
            $table->string('city_kana', 50)->comment('市区町村カナ');
            $table->string('city_roma', 50)->comment('市区町村ローマ字');
            $table->commonColumn(true, '有効フラグ.falseで消滅(合併など)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->cities);
    }
}
