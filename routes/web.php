<?php declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('force/logout', 'Auth\\LoginController@logout')->name('force.logout');
Route::get('login/{socialProvider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{socialProvider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.redirect');

Route::resource('user', 'UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
