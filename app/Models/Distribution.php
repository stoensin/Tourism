<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribution extends Model
{
    use SoftDeletes;


    protected $table = "distribution";
    protected $primaryKey = "id";//主键

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'mobile', 'email', 'password', 'idCard', 'birthday', 'sex', 'province', 'city', 'addres', 'tel', 'qq', 'weibo', 'weixin', 'distributionId', 'memberId', 'state', 'remark', 'updated_at', 'created_at'];
    protected $guarded = ['_token','updated_at', 'created_at'];

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
            'name.required' => '企业不能为空',
        ];
    }

    /**
     * 关联用户
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId');
    }

    /**
     *分销产品
     */
    public function sales()
    {
        return $this->hasMany('App\Models\Sales', "distributionId");
    }




    /**
     *应用记录
     */
    public function apply()
    {
        return $this->hasMany('App\Models\Apply', "distributionId");
    }
}
