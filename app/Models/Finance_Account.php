<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance_Account extends Model
{
    use SoftDeletes;


    protected $table = "Finance_Account";
    protected $primaryKey = "id";//主键

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    protected $guarded = ['_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function Rules()
    {
        return [
            'name' => 'required|max:255|min:2',
        ];
    }

    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '开户名不能为空',
        ];
    }

    public function getBalanceAttribute()
    {
        $lists = $this->payments()->where('reviewed', 0)->where('state', 0);


        return $lists->where('type', 0)->sum('money') - $lists->where('type', 1)->sum('money') + $this->beginMoney;
    }


    /**
     *支付明细
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Finance_Payments', "accountId");
    }


}
