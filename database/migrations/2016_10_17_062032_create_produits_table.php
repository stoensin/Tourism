<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 商品清单
 * Class CreateProduitsTable
 */
class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//商品名称
            $table->integer('supplierId');//所属供应商
            $table->integer('productId')->nullable();//原始产品关联
            $table->integer('scenicId')->nullable();//景区关联
            $table->string('attention');//注意事项
            $table->text('refundable');//退改规则
            $table->string('parprice');//票面价
            $table->float('price');//成本价格
            $table->integer('payType')->default(0);//0支持1不支持
            $table->date('beginDate');//开始日期
            $table->date('endDate');//结束日期
            $table->integer('stock')->default(0);//库存数量
            $table->integer('bankTime')->default(0);//退票时限0不限
            $table->integer('singleNum')->default(10);//单人限购
            $table->integer('state')->default(0);//状态0在售1暂停
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
        Schema::drop('produits');
    }
}
