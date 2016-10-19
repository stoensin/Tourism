<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * 订单记录
 */
class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//预定者姓名
            $table->string('mobile');//预定者手机号
            $table->integer('quantity');//数量
            $table->integer('money');//金额
            $table->integer('paymentId')->nullable();//付款记录
            $table->integer('productId');//产品ID
            $table->integer('userId')->nullable();//用户ID
            $table->integer('state')->default(0);//订单状态(0正常、1待审)
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
        Schema::drop('order');
    }
}
