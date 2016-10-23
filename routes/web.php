<?php

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::any('/install', 'InstallController@index');



/**
 * 管理后台
 */
Route::group(['prefix' => 'manage', 'middleware' => 'auth', 'namespace' => 'Manage'], function () {
    Route::get('/', 'HomeController@index');


    /**
     * 短信
     */
    Route::group(['prefix' => 'sms', 'middleware' => 'auth'], function () {
        Route::get('/', 'SmsController@index');
        Route::any('/create', 'SmsController@create');
        Route::any('/edit/{id}', 'SmsController@edit');
        Route::get('/delete', 'SmsController@delete');
    });

    /**
     * 渠道供应
     */
    Route::group(['prefix' => 'supplier', 'middleware' => 'auth'], function () {
        Route::get('/', 'SupplierController@index');
        Route::any('/create', 'SupplierController@create');
        Route::any('/edit/{id}', 'SupplierController@edit');
        Route::get('/delete', 'SupplierController@delete');

        /**
         * 原始产品管理
         */
        Route::group(['prefix' => 'product', 'middleware' => 'auth'], function () {
            Route::get('/', 'ProductController@index');
            Route::any('/create', 'ProductController@create');
            Route::any('/edit/{id}', 'ProductController@edit');
            Route::get('/delete', 'ProductController@delete');
            Route::get('/sync/{id}', 'ProductController@sync');
        });
    });


    /**
     * 景区资料
     */
    Route::group(['prefix' => 'scenic'], function () {
        Route::get('/', 'ScenicController@index');
        Route::any('/create', 'ScenicController@create');
        Route::any('/edit/{id}', 'ScenicController@edit');
        Route::get('/delete', 'ScenicController@delete');
    });

    /**
     * 产品中心
     */
    Route::group(['prefix' => 'produits'], function () {
        Route::get('/', 'ProduitsController@index');
        Route::any('/create', 'ProduitsController@create');
        Route::any('/original/{id}', 'ProduitsController@original');
        Route::any('/edit/{id}', 'ProduitsController@edit');
        Route::get('/delete', 'ProduitsController@delete');

        /**
         * 产品详情
         */
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', 'DetailsController@index');
            Route::any('/create', 'DetailsController@create');
            Route::any('/edit/{id}', 'DetailsController@edit');
            Route::get('/delete', 'DetailsController@delete');
        });

        /**
         * 预定规则
         */
        Route::group(['prefix' => 'rule'], function () {
            Route::get('/', 'RuleController@index');
            Route::any('/create', 'RuleController@create');
            Route::any('/edit/{id}', 'RuleController@edit');
            Route::get('/delete', 'RuleController@delete');
        });
    });


    /**
     * 分销渠道
     */
    Route::group(['prefix' => 'distribution'], function () {
        Route::get('/', 'DistributionController@index');
        Route::any('/create', 'DistributionController@create');
        Route::any('/edit/{id}', 'DistributionController@edit');
        Route::get('/delete', 'DistributionController@delete');

    });
    /**
     * 授信管理
     */
    Route::group(['prefix' => 'credit'], function () {
        Route::get('/', 'CreditController@index');
        Route::any('/create/{id?}', 'CreditController@create');
        Route::any('/edit/{id}', 'CreditController@edit');
        Route::get('/delete', 'CreditController@delete');

    });
    /**
     * 授信管理
     */
    Route::group(['prefix' => 'sales'], function () {
        Route::get('/', 'SalesController@index');
        Route::any('/create/{id?}', 'SalesController@create');
        Route::any('/edit/{id}', 'SalesController@edit');
        Route::get('/delete', 'SalesController@delete');

    });


    /**
     * 应用管理
     */
    Route::group(['prefix' => 'apply'], function () {
        Route::get('/', 'ApplyController@index');
        Route::any('/create', 'ApplyController@create');
        Route::any('/edit/{id}', 'ApplyController@edit');
        Route::get('/delete', 'ApplyController@delete');

    });


    /**
     * 会员中心
     */
    Route::group(['prefix' => 'member', 'middleware' => 'auth'], function () {
        Route::get('/', 'MemberController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 订单
         */
        Route::group(['prefix' => 'order', 'middleware' => 'auth'], function () {
            Route::get('/', 'OrderController@index');
            Route::any('/create', 'OrderController@create');
            Route::post('/scenic', 'OrderController@scenic');


        });

    });


    /**
     * 系统配置
     */
    Route::group(['prefix' => 'config', 'middleware' => 'auth'], function () {
        Route::any('/', 'ConfigController@index');


        /**
         * 基础数据
         */
        Route::group(['prefix' => 'base', 'middleware' => 'auth'], function () {
            Route::get('/', 'BaseDataController@index');
            Route::any('/create', 'BaseDataController@create');
            Route::post('/scenic', 'BaseDataController@scenic');


        });

    });


});


/**
 * 微信
 */
Route::group(['prefix' => 'weixin', 'namespace' => 'Weixin'], function () {
    Route::get('/', 'HomeController@index');


    /**
     * 会员中心
     */
    Route::group(['prefix' => 'member', 'middleware' => 'auth'], function () {
        Route::get('/', 'MemberController@index');
        Route::any('/create', 'MemberController@create');


        /**
         * 订单
         */
        Route::group(['prefix' => 'pay', 'middleware' => 'auth'], function () {
            Route::get('/', 'PayController@index');
            Route::any('/create', 'PayController@create');
        });
    });


    /**
     * 订单管理
     */
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index');
        Route::any('/create', 'OrderController@create');
    });

    /**
     * 景区资料
     */
    Route::group(['prefix' => 'scenic'], function () {
        Route::get('/', 'ScenicController@index');
        Route::any('/create', 'ScenicController@create');
        Route::any('/edit/{id}', 'ScenicController@edit');
        Route::get('/delete', 'ScenicController@delete');
    });


    /**
     * 产品中心
     */
    Route::group(['prefix' => 'produits'], function () {
        Route::get('/', 'ProduitsController@index');

        Route::any('/create', 'ProduitsController@create');
        /**
         * 产品详情
         */
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', 'DetailsController@index');

            Route::any('/create', 'DetailsController@create');

        });
    });

});
