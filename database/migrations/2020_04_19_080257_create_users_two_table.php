<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('wxid', 64)->default('')->comment('微信ID');
            $table->string('name', 128)->default('')->comment('微信名称');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->smallInteger('level')->default(0)->comment('等级');
            $table->integer('balance')->default(0)->comment('余额');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('wxid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (app()->environment() == 'production') return;
        Schema::dropIfExists('users');
    }
}
