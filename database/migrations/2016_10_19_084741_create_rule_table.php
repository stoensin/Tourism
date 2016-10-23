<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuleTable extends Migration
{
    /**
     * 预定规则
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produitsId');//产品ID
            $table->integer('type');//规则类型（0每天，1按周，2工作日，3节假日）
            $table->string('value')->nullable();//规则内容
            $table->date('beginDate')->nullable();//开始日期
            $table->date('endDate')->nullable();//结束日期
            $table->integer('state')->default(0);//状态0启用1禁用
            $table->integer('priority')->default(0);//优先级
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
        Schema::drop('rule');
    }
}
