<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 用户授信
 * @package App\Models
 */
class Finance_Credit extends Model
{
    use SoftDeletes;


    protected $table = "Finance_Credit";
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
     * 被授信者
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId');
    }

    /**
     * 责任人
     */
    public function liableUser()
    {
        return $this->belongsTo('App\Models\User', 'liableId');
    }

}
