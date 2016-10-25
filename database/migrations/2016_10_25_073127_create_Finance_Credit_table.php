<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceCreditTable extends Migration
{
    /**
     * 授信管理
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Finance_Credit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');//被授信者
            $table->float('credit');//信用额度金额
            $table->date('beginDate')->nullable();//开始日期
            $table->date('endDate')->nullable();//结束日期
            $table->integer('liableId')->nullable();//责任人
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
        Schema::drop('Finance_Credit');
    }
}
