<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Supplier_Resource', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplierId');//所属供应商
            $table->integer('scenicId')->nullable();//景区关联
            $table->string('name');//产品名称
            $table->string('code')->unique();//产品编码(唯一)
            $table->float('parprice');//票面价
            $table->float('price');//成本价格
            $table->float('fixedPrice');//市场限价
            $table->integer('payType')->default(0);//0支持1不支持
            $table->date('beginDate')->nullable();//开始日期
            $table->date('endDate')->nullable();//结束日期
            $table->string('attention')->nullable();//注意事项
            $table->text('refundable')->nullable();//退改规则
            $table->string('description')->nullable();//产品描述
            $table->integer('stock')->default(0);//库存数量
            $table->integer('bankTime')->default(0);//退票时限0不限
            $table->integer('singleNum')->default(0);//单人限购0表示不限
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
        Schema::drop('Supplier_Resource');
    }
}
