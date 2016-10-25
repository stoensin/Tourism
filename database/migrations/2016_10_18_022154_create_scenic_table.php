<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 景点信息
 */
class CreateScenicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//景点名称

            $table->string('recommend');//推荐理由
            $table->string("titlePic");//标题图片
            $table->string('describe');//产品描述
            $table->string('attention');//注意事项
            $table->text('contenu');//景区详情
            $table->integer('grade')->default(0);//评级
            $table->string('tel');//客服电话
            $table->string('province');//省
            $table->string('city');//市
            $table->string('addres');//地址
            $table->string('traffic');//交通
            $table->string('openingTime');//开放时间
            $table->string('longitude');//经度
            $table->string('latitude');//纬度
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
        Schema::drop('scenic');
    }
}
