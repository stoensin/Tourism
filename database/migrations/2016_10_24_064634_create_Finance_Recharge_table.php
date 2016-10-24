<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceRechargeTable extends Migration
{
    /**
     * 供应商充值记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Finance_Recharge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('distributionId');//分销商ID
            $table->float('money');//充值金额
            $table->integer('liableId')->nullable();//责任人
            $table->integer('type')->default(0);//充值方式0线下充值，1在线支付
            $table->string('income');//充值方式0线下充值，1在线支付
            $table->integer('state')->default(0);//状态0启用1禁用
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
        Schema::drop('Finance_Recharge');
    }
}
