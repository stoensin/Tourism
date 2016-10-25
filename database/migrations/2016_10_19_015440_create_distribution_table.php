<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Distribution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->nullable();//用户关联
            $table->string('name');//企业名称
            $table->string('legalPerson')->nullable();//法人
            $table->string('idCard')->nullable();//身份证号
            $table->date('birthday')->nullable();//生日
            $table->string('province')->nullable();//省
            $table->string('city')->nullable();//市
            $table->string('addres')->nullable();//地址
            $table->string('linkMan')->nullable();//联系人
            $table->integer('sex')->default(0);//性别(0未知、1男、2女)
            $table->string('mobile')->nullable();//手机号
            $table->string('tel')->nullable();//办公电话
            $table->string('fax')->nullable();//传真
            $table->string('qq')->nullable();//qq
            $table->string('email')->nullable();//电子邮件
            $table->string('weibo')->nullable();//微博
            $table->string('weixin')->nullable();//微信号
            $table->string('warningTel')->nullable();//预警联系电话
            $table->float('warningCredit')->default(0.0);//预警额度
            $table->string('openId')->nullable();//微信号
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
        Schema::drop('Distribution');
    }
}
