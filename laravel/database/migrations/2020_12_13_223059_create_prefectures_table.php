<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefecturesTable extends Migration
{
    private string $prefectures = 'prefectures';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->prefectures, function (Blueprint $table) {
            $table->id();
            $table->char('code', 2)->unique()->comment('都道府県コード');
            $table->string('prefecture_name', 10)->comment('都道府県名');
            $table->string('prefecture_kana', 50)->comment('都道府県カナ');
            $table->string('prefecture_roma', 50)->comment('都道府県ローマ字');
            $table->commonColumn();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->prefectures);
    }
}
