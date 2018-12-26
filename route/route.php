<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::get('hissoapserver', 'index/soap');


//Route::group('/api', function () {
Route::get('api/plans/:page', 'api/index/plans');
Route::get('api/planslist/:orderid', 'api/index/planslist');
Route::get('api/applogin', 'api/index/checklogin');
Route::get('api/applogout', 'api/index/applogout');
Route::get('api/logs', 'api/index/logs');
Route::post('api/applogout', 'api/index/applogout');
Route::post('api/logs', 'api/index/logs');

Route::get('api/userinfo', 'api/index/userinfo');
Route::post('api/setorderid', 'api/index/setorderid');
Route::get('api/setorderid', 'api/index/setorderid');

//})->prefix('\app\api\\');

return [

];
