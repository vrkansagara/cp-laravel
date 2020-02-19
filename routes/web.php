<?php declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function(){
    return view('vueapp');
})->where('any', '.*');


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

Route::get('fabric', 'FabricController@index')->name('fabric');

Route::get('home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('force/logout', 'Auth\\LoginController@logout')->name('force.logout');
Route::get('login/{socialProvider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{socialProvider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.redirect');

Route::resource('user', 'UsersController');
Route::resource('role', 'RolesController');

Auth::routes();

Route::get('test', 'TestController@index')->name('test.index');
Route::get('test/create', 'TestController@create')->name('test.create');
Route::resource('calender', 'CalenderController');


Route::get('/page', function () {
    return view('page',
        [
            'title' => "Page 2 - A little about the Author",
            'author' => json_encode([
                "name" => "Fisayo Afolayan",
                "role" => "Software Enginner",
                "code" => "Always keeping it clean"
            ])
        ]
    );
});
