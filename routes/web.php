<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Auth::routes();
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){


    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::resource('grades', 'GradeController');
    Route::resource('classrooms', 'ClassroomController');
    Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
    Route::post('filter_classes', 'ClassroomController@filter_classes')->name('filter_classes');
    Route::resource('sections', 'SectionController');
    Route::get('/classes/{id}', 'SectionController@getclasses');
    Route::view('craete/parent','livewire.createParent')->name('create.parent');
    Route::resource('parent-attachment', 'ParentAttachmentController');
});




Route::get('test',function(){
    return view('pages.test');
});