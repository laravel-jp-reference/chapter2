<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends Migration
{
    /**
     * マイグレーション実行
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
    }

    /**
     * マイグレーションを戻す
     */
    public function down()
    {
        Schema::drop('password_resets');
    }
}
