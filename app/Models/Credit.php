<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use SoftDeletes;


    protected $table = "credit";
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
//            'credit' => 'required|max:255|min:2',
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
//            'credit.required' => '额度金额不能为空',
        ];
    }

    /**
     * 分销商
     */
    public function distribution()
    {
        return $this->belongsTo('App\Models\Distribution', 'distributionId');
    }

    /**
     * 责任人
     */
    public function liableUser()
    {
        return $this->belongsTo('App\Models\User', 'liableId');
    }

}
