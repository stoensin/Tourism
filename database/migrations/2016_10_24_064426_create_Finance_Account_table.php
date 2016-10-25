<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceAccountTable extends Migration
{
    /**
     * 财务帐户
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Finance_Account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);//帐户类型0银行帐户，1微信2，支付宝，3线下，4其它
            $table->string('name');//开户名
            $table->string('bankAccount');//开户行
            $table->string('accounts');//帐号
            $table->string('bankAddres');//开户行地址
            $table->float('beginMoney');//期初金额
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
        Schema::drop('Finance_Account');
    }
}
