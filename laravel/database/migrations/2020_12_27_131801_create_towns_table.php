<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownsTable extends Migration
{
    private string $towns = 'towns';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->towns, function (Blueprint $table) {
            $table->id();
            $table->parent('都道府県ID', 'prefectures');
            $table->parent('市区町村ID', 'cities');
            $table->string('town_name', 20)->comment('大字町丁目名');
            $table->string('town_kana', 50)->comment('大字町丁目カナ');
            $table->string('town_roma', 50)->comment('大字町丁目ローマ字');
            $table->commonColumn(true, "有効フラグ. falseで消滅");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->towns);
    }
}
