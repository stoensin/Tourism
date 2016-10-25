<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancePaymentsTable extends Migration
{
    /**
     * 收支记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Finance_Payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//科目
            $table->integer('userId');//来源用户ID
            $table->integer('accountId');//资金帐户
            $table->float('money');//金额
            $table->integer('type')->default(0);//类型0收入1支出
            $table->integer('liableId')->nullable();//责任人
            $table->integer('reviewed')->default(1);//审核状态0通过1待审核2审核未通过
            $table->integer('state')->default(0);//状态0有效1无效
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
        Schema::drop('Finance_Payments');
    }
}
