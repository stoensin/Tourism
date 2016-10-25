<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;


    protected $table = "supplier";
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
            'enterprise' => 'required|max:255|min:2',
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
            'name.required' => '简称不能为空',
            'enterprise.required' => '单位不能为空',
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
     * 创建者
     */
    public function createUser()
    {
        return $this->belongsTo('App\Models\User', 'createId');
    }

    /**
     * 编辑者
     */
    public function editUser()
    {
        return $this->belongsTo('App\Models\User', 'editId');
    }

    /**
     * 责任人
     */
    public function liableUser()
    {
        return $this->belongsTo('App\Models\User', 'liableId');
    }

    /**
     *供应产品
     */
    public function resources()
    {
        return $this->hasMany('App\Models\Supplier_Resource', "supplierId");
    }


}
