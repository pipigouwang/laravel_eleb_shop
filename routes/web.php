<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return view('welcome');
//});
//商家登录
Route::get('login','SessionsController@login')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::get('logout','SessionsController@logout')->name('logout');
//用户信息表
Route::resource('users','UsersController');
//审核状态
Route::get('/shops/info/{shop}','ShopsController@info')->name('shops.info');
Route::post('/shops/{shop}','ShopsController@status')->name('shops.status');
//用户注册
Route::get('register', 'UsersController@register')->name('register');//显示注册表单
Route::post('/users', 'UsersController@zhuchestore')->name('users.zhuchestore');//接收注册表单数据
//菜品分类
Route::resource('menucategory','MenucategoryController');
//菜品表
Route::resource('menuses','MenusesController');
//接收文件上传
Route::post('upload',function (){
    $storage = \Illuminate\Support\Facades\Storage::disk('oss');
    $fileName = $storage->putFile('upload',request()->file('file'));
    return[
      'fileName'=>$storage->url($fileName)
    ];
})->name('upload');
//活动路由列表
Route::resource('activities','activitiesController');
//查看活动详情
Route::get('/activities/show/{activity}','ActivitiesController@show')->name('activities.show');
//订单表管理
Route::resource('orders','OrdersController');
//取消订单
Route::get('cleanOrder/{order}','OrdersController@cleanOrder')->name('cleanOrder');
//订单发货
Route::get('sendOrder/{order}','OrdersController@sendOrder')->name('sendOrder');
//查看订单
Route::get('orderCount/{order}','OrdersController@orderCount')->name('orderCount');
//订单统计
Route::get('CountOrder','OrdersController@CountOrder')->name('CountOrder');

