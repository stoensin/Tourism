<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplierId');//所属供应商
            $table->integer('scenicId')->nullable();//景区关联
            $table->string('name');//产品名称
            $table->string('code')->unique();//产品编码(唯一)
            $table->string('parprice');//票面价
            $table->float('price');//成本价格
            $table->integer('payType')->default(0);//0支持1不支持
            $table->date('beginDate');//开始日期
            $table->date('endDate');//结束日期
            $table->string('attention');//注意事项
            $table->string('description');//产品描述
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
        Schema::drop('product');
    }
}
