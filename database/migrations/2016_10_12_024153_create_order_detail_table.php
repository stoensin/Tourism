<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * 订单
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderDetail', function (Blueprint $table) {
            $table->increments('id');
        

            $table->integer('state')->default(0);//状态0正常，1取消
            $table->integer('sort')->default(0);//排序
            $table->text('remark')->nullable();//备注
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orderDetail');
    }
}
