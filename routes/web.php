<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'AppController@index')->name('index');
Route::post('/', function () {
    return redirect('/');
})->name('index-post');
Route::get('/karya/{karya}', 'AppController@karyaShow')->name('karya.detail');
Route::get('/karya', 'AppController@karya')->name('karya');
Route::get('/berita/{berita}', 'AppController@beritaShow')->name('berita.detail');
Route::get('/berita', 'AppController@berita')->name('berita');

Auth::routes(['reset' => false, 'confirm' => false]);

Route::name('admin.')->prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    // data master
    // Route::get('/tool/up', 'ToolController@up')->name('tool.up');
    Route::name('master.')->group(function () {
        Route::resource('matakuliah', 'MatakuliahController');
        Route::resource('category', 'CategoryController');
        Route::resource('berita', 'BeritaController');
        Route::resource('user', 'UserController')->except(['show']);

        Route::resource('team', 'TeamController');

        Route::post('/team/cari-pengguna', 'TeamController@cariPengguna')->name('team.search');

        Route::post('/team/{team}/approve', 'TeamController@approve')->name('team.approve');
        Route::post('/team/{team}/reject', 'TeamController@reject')->name('team.reject');

        Route::get('/team/{team}/member/create', 'TeamController@createMember')->name('team.member.create');
        Route::post('/team/{team}/member/create', 'TeamController@storeMember')->name('team.member.store');
        Route::delete('/team/{team}/member/{member}', 'TeamController@destroyMember')->name('team.member.destroy');

        Route::get('karya-fetch-form/{category}', 'KaryaController@fetchForm')->name('karya.fetch-form');
        Route::get('karya-personal/create/{category?}', 'KaryaPersonalController@create')->name('karya-personal.create');
        Route::resource('karya-personal', 'KaryaPersonalController')->except('create');
        Route::get('team/{team}/karya/create/{category?}', 'Team\KaryaController@create')->name('team.karya.create');
        Route::resource('team.karya', 'Team\KaryaController')->except('create');
        Route::resource('karya.asset', 'KaryaAssetController')->except(['index', 'show']);
        Route::post('/karya/{karya}/approve', 'KaryaController@approve')->name('karya.approve');
        Route::post('/karya/{karya}/reject', 'KaryaController@reject')->name('karya.reject');
        Route::resource('karya', 'KaryaController')->only(['index', 'show']);

        Route::get('/setting', 'SettingController@edit')->name('setting.edit');
        Route::put('/setting', 'SettingController@update')->name('setting.update');
    });
});
