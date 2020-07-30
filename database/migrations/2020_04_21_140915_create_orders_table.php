<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0)->comment('用户ID');
            $table->bigInteger('item_id')->default(0)->comment('商品ID');
            $table->integer('price')->default(0)->comment('商品价格');
            $table->string('pic_url', 128)->default('')->comment('商品主图');
            $table->string('caption', 255)->default('')->comment('商品短标题');
            $table->integer('tao_ke_fee')->default(0)->comment('淘客返佣金额');
            $table->integer('relation_id')->default(0)->comment('渠道ID');
            $table->tinyInteger('status')->default(0)->comment('订单状态');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'idx_user_id');
            $table->index('item_id', 'idx_item_id');
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
        Schema::dropIfExists('orders');
    }
}
