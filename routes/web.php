<?php

use Illuminate\Support\Facades\Route;

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


//Auth::routes(['register' => false]);

//date_default_timezone_set('Asia/Dhaka');

Route::group(['middleware' => ['install']], function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index');

    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    //auth
    Route::group(['middleware' => ['auth']], function () {
    	Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    	
        //Profile Controller
        Route::get('profile/show', 'App\Http\Controllers\ProfileController@show')->name('profile.show');
        Route::get('profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
        Route::post('profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
        Route::get('password/change', 'App\Http\Controllers\ProfileController@password_change')->name('password.change');
        Route::post('password/update', 'App\Http\Controllers\ProfileController@update_password')->name('password.update');
        //Settings Controller
        Route::any('general_settings', 'App\Http\Controllers\SettingController@general')->name('general_settings');
        Route::any('app_settings', 'App\Http\Controllers\SettingController@app')->name('app_settings');
        Route::any('cache_clear', 'App\Http\Controllers\SettingController@cache_clear')->name('cache_clear');
        Route::post('store_settings', 'App\Http\Controllers\SettingController@store_settings')->name('store_settings');
        
        //Backup Controller
        Route::any('database_backup', 'App\Http\Controllers\BackupController@index')->name('database_backup');
        Route::get('notifications/deleteall', 'App\Http\Controllers\NotificationController@deleteall');
        Route::resource('notifications', 'App\Http\Controllers\NotificationController');
                 
        //App Controller
        Route::resource('apps', 'App\Http\Controllers\AppController');
        Route::get('manage_app/{app_unique_id?}', 'App\Http\Controllers\ManageAppController@index');
        Route::post('store_app_settings/{app_id}/{platform}', 'App\Http\Controllers\ManageAppController@store_app_settings')->name('store_app_settings');

        Route::resource('sports_types', 'App\Http\Controllers\SportsTypeController');
        Route::resource('live_matches', 'App\Http\Controllers\LiveMatchController');
		Route::resource('highlights', 'App\Http\Controllers\HighlightController');
        Route::resource('promotions', 'App\Http\Controllers\PromotionController');
        Route::resource('popular_series', 'App\Http\Controllers\PopularSeriesController');
        Route::resource('fixures', 'App\Http\Controllers\FixureController');
        Route::get('update/{table}/{id}/{field}/{value}', function($table, $id, $field, $value){
            \DB::table($table)->where('id', $id)->update([$field => $value]);

            return response()->json(['result' => 'success', 'message' => _lang( $field . ' has been updated sucessfully.')]);
        });

    });

});

Route::get('/cache', function(){
	Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
});

//Install Controller
Route::get('/installation', 'App\Http\Controllers\Install\InstallController@index');
Route::get('install/database', 'App\Http\Controllers\Install\InstallController@database');
Route::post('install/process_install', 'App\Http\Controllers\Install\InstallController@process_install');
Route::get('install/create_user', 'App\Http\Controllers\Install\InstallController@create_user');
Route::post('install/store_user', 'App\Http\Controllers\Install\InstallController@store_user');
Route::get('install/system_settings', 'App\Http\Controllers\Install\InstallController@system_settings');
Route::post('install/finish', 'App\Http\Controllers\Install\InstallController@final_touch');

Route::get('/server_cache_clear', 'App\Http\Controllers\WebsiteController@server_cache_clear');


