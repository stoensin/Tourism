<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();//手机号
            $table->string('password');
            $table->string('idCard')->nullable();//身份证号
            $table->date('birthday')->nullable();//生日
            $table->integer('sex')->default(0);//性别(0未知、1男、2女)
            $table->string('tel')->nullable();//坐机电话
            $table->string('qq')->nullable();//qq
            $table->string('weibo')->nullable();//微博
            $table->string('weixin')->nullable();//微信号
            $table->string('openId')->unique()->nullable();
            $table->string('province')->nullable();//省
            $table->string('city')->nullable();//市
            $table->string('addres')->nullable();//地址
            $table->integer('distributionId')->nullable();//所属分销商
            $table->integer('memberId')->nullable();//推荐者
            $table->integer('state')->default(0);//状态
            $table->integer('sort')->default(0);//排序
            $table->text('remark')->nullable();//备注
            $table->rememberToken();
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
        Schema::drop('member');
    }
}
