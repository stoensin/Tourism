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
            $table->integer('distributionId');//分销商
            $table->integer('scenicId');//所属景区
            $table->integer('produitsId');//价格项
            $table->integer('userId');//用户ID
            $table->string('name');//产品名称
            $table->date('ticketDate');//票面日期
            $table->integer('isExpress')->default(1);//是否需要快递0需要，1不需要
            $table->float('price');//单价
            $table->integer('quantity');//数量
            $table->float('total');//订单合计

            $table->string('linkMan');//联系人
            $table->string('idCard');//身份证号
            $table->string('mobile');//手机号
            $table->string('email');//邮箱
            $table->string('addres');//地址

            $table->date('orderDate');//下单时间
            $table->date('payDate');//支付时间

            $table->string('consumeCode');//消费码

            $table->integer('auditState')->default(0);//订单审核状态0审核通过1待审核2拒绝
            $table->integer('ticketState')->default(1);//出票状态0出票成功1待出票2出票失败
            $table->integer('payState')->default(1);//支付状态0支付成功，1待支付，2已支付待审核，3支付失败，4退款中，5已退款
            $table->integer('paymentId')->nullable();//付款记录
            $table->text('operationLog')->nullable();//操作日志


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
        Schema::drop('order');
    }
}
