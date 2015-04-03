<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('projectMasters', ['as'=>'projectMasters/index', 'uses'=>'ProjectMastersController@index']);
Route::post('projectMasters', ['as'=>'projectMasters/index', 'uses'=>'ProjectMastersController@index']);
Route::get('projectMasters/show/{id}', ['as'=>'projectMasters/show', 'uses'=>'ProjectMastersController@show'])->where('id', '[0-9]+');
Route::post('projectMasters/show/{id}', ['as'=>'projectMasters/show', 'uses'=>'ProjectMastersController@show'])->where('id', '[0-9]+');
Route::get('projectMasters/createInput', ['as'=>'projectMasters/createInput', 'uses'=>'ProjectMastersController@createInput']);
Route::post('projectMasters/createInput', ['as'=>'projectMasters/createInput', 'uses'=>'ProjectMastersController@createInput']);
Route::get('projectMasters/createConfirm', ['as'=>'projectMasters/createConfirm', 'uses'=>'ProjectMastersController@createConfirm']);
Route::post('projectMasters/createConfirm', ['as'=>'projectMasters/createConfirm', 'uses'=>'ProjectMastersController@createConfirm']);
Route::get('projectMasters/createRegist', ['as'=>'projectMasters/createRegist', 'uses'=>'ProjectMastersController@createRegist']);
Route::post('projectMasters/createRegist', ['as'=>'projectMasters/createRegist', 'uses'=>'ProjectMastersController@createRegist']);
Route::get('projectMasters/editInput/{id}', ['as'=>'projectMasters/editInput', 'uses'=>'ProjectMastersController@editInput'])->where('id', '[0-9]+');
Route::post('projectMasters/editInput/{id}', ['as'=>'projectMasters/editInput', 'uses'=>'ProjectMastersController@editInput'])->where('id', '[0-9]+');
Route::get('projectMasters/editConfirm', ['as'=>'projectMasters/editConfirm', 'uses'=>'ProjectMastersController@editConfirm']);
Route::post('projectMasters/editConfirm', ['as'=>'projectMasters/editConfirm', 'uses'=>'ProjectMastersController@editConfirm']);
Route::get('projectMasters/editRegist', ['as'=>'projectMasters/editRegist', 'uses'=>'ProjectMastersController@editRegist']);
Route::post('projectMasters/editRegist', ['as'=>'projectMasters/editRegist', 'uses'=>'ProjectMastersController@editRegist']);
Route::get('projectMasters/deleteConfirm/{id}', ['as'=>'projectMasters/deleteConfirm', 'uses'=>'ProjectMastersController@deleteConfirm'])->where('id', '[0-9]+');
Route::post('projectMasters/deleteConfirm/{id}', ['as'=>'projectMasters/deleteConfirm', 'uses'=>'ProjectMastersController@deleteConfirm'])->where('id', '[0-9]+');
Route::get('projectMasters/delete', ['as'=>'projectMasters/delete', 'uses'=>'ProjectMastersController@delete'])->where('id', '[0-9]+');
Route::post('projectMasters/delete', ['as'=>'projectMasters/delete', 'uses'=>'ProjectMastersController@delete'])->where('id', '[0-9]+');



Route::get('tasks', 'TasksController@index');
Route::post('tasks', 'TasksController@index');
