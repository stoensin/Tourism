<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *资源供应商
     * @return void
     */
    public function up()
    {
        Schema::create('Supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->nullable();//关联用户
            $table->string('name');//供应商简称
            $table->string('enterprise');//供应商全称
            $table->string('linkMan');//联系人
            $table->string('mobile');//手机号
            $table->string('tel');//电话
            $table->string('fax');//传真
            $table->string('qq');//QQ号
            $table->string('email');//电子邮件
            $table->string('addres');//联系地址
            $table->string('platform');//平台系统
            $table->integer('liableId')->nullable();//责任人
            $table->integer('createId')->nullable();//增加者
            $table->integer('editId')->nullable();//编辑者
            $table->integer('state')->default(0);//状态
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
        Schema::drop('Supplier');
    }
}
