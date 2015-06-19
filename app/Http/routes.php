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

/* projectMasters */
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
Route::post('projectMasters/getProjectList', ['as'=>'projectMasters/getProjectList', 'uses'=>'ProjectMastersController@getProjectList']);

/* companyMasters */
Route::get('companyMasters', ['as'=>'companyMasters/index', 'uses'=>'CompanyMastersController@index']);
Route::post('companyMasters', ['as'=>'companyMasters/index', 'uses'=>'CompanyMastersController@index']);
Route::get('companyMasters/show/{id}', ['as'=>'companyMasters/show', 'uses'=>'CompanyMastersController@show'])->where('id', '[0-9]+');
Route::post('companyMasters/show/{id}', ['as'=>'companyMasters/show', 'uses'=>'CompanyMastersController@show'])->where('id', '[0-9]+');
Route::get('companyMasters/createInput', ['as'=>'companyMasters/createInput', 'uses'=>'CompanyMastersController@createInput']);
Route::post('companyMasters/createInput', ['as'=>'companyMasters/createInput', 'uses'=>'CompanyMastersController@createInput']);
Route::get('companyMasters/createConfirm', ['as'=>'companyMasters/createConfirm', 'uses'=>'CompanyMastersController@createConfirm']);
Route::post('companyMasters/createConfirm', ['as'=>'companyMasters/createConfirm', 'uses'=>'CompanyMastersController@createConfirm']);
Route::get('companyMasters/createRegist', ['as'=>'companyMasters/createRegist', 'uses'=>'CompanyMastersController@createRegist']);
Route::post('companyMasters/createRegist', ['as'=>'companyMasters/createRegist', 'uses'=>'CompanyMastersController@createRegist']);
Route::get('companyMasters/editInput/{id}', ['as'=>'companyMasters/editInput', 'uses'=>'CompanyMastersController@editInput'])->where('id', '[0-9]+');
Route::post('companyMasters/editInput/{id}', ['as'=>'companyMasters/editInput', 'uses'=>'CompanyMastersController@editInput'])->where('id', '[0-9]+');
Route::get('companyMasters/editConfirm', ['as'=>'companyMasters/editConfirm', 'uses'=>'CompanyMastersController@editConfirm']);
Route::post('companyMasters/editConfirm', ['as'=>'companyMasters/editConfirm', 'uses'=>'CompanyMastersController@editConfirm']);
Route::get('companyMasters/editRegist', ['as'=>'companyMasters/editRegist', 'uses'=>'CompanyMastersController@editRegist']);
Route::post('companyMasters/editRegist', ['as'=>'companyMasters/editRegist', 'uses'=>'CompanyMastersController@editRegist']);
Route::get('companyMasters/deleteConfirm/{id}', ['as'=>'companyMasters/deleteConfirm', 'uses'=>'CompanyMastersController@deleteConfirm'])->where('id', '[0-9]+');
Route::post('companyMasters/deleteConfirm/{id}', ['as'=>'companyMasters/deleteConfirm', 'uses'=>'CompanyMastersController@deleteConfirm'])->where('id', '[0-9]+');
Route::get('companyMasters/delete', ['as'=>'companyMasters/delete', 'uses'=>'CompanyMastersController@delete'])->where('id', '[0-9]+');
Route::post('companyMasters/delete', ['as'=>'companyMasters/delete', 'uses'=>'CompanyMastersController@delete'])->where('id', '[0-9]+');

/* tasks */
Route::get('tasks', ['as'=>'tasks/index', 'uses'=>'tasksController@index']);
Route::post('tasks', ['as'=>'tasks/index', 'uses'=>'tasksController@index']);
Route::get('tasks/priorityList', ['as'=>'tasks/priorityList', 'uses'=>'tasksController@priorityList']);
Route::post('tasks/priorityList', ['as'=>'tasks/priorityList', 'uses'=>'tasksController@priorityList']);
Route::get('tasks/priorityRegist', ['as'=>'tasks/priorityRegist', 'uses'=>'tasksController@priorityRegist']);
Route::post('tasks/priorityRegist', ['as'=>'tasks/priorityRegist', 'uses'=>'tasksController@priorityRegist']);
Route::get('tasks/calendar', ['as'=>'tasks/calendar', 'uses'=>'tasksController@calendar']);
Route::post('tasks/calendar', ['as'=>'tasks/calendar', 'uses'=>'tasksController@calendar']);
Route::get('tasks/show/{id}', ['as'=>'tasks/show', 'uses'=>'tasksController@show'])->where('id', '[0-9]+');
Route::post('tasks/show/{id}', ['as'=>'tasks/show', 'uses'=>'tasksController@show'])->where('id', '[0-9]+');
Route::get('tasks/createInput', ['as'=>'tasks/createInput', 'uses'=>'tasksController@createInput']);
Route::post('tasks/createInput', ['as'=>'tasks/createInput', 'uses'=>'tasksController@createInput']);
Route::get('tasks/createConfirm', ['as'=>'tasks/createConfirm', 'uses'=>'tasksController@createConfirm']);
Route::post('tasks/createConfirm', ['as'=>'tasks/createConfirm', 'uses'=>'tasksController@createConfirm']);
Route::get('tasks/createRegist', ['as'=>'tasks/createRegist', 'uses'=>'tasksController@createRegist']);
Route::post('tasks/createRegist', ['as'=>'tasks/createRegist', 'uses'=>'tasksController@createRegist']);
Route::get('tasks/editInput/{id}', ['as'=>'tasks/editInput', 'uses'=>'tasksController@editInput'])->where('id', '[0-9]+');
Route::post('tasks/editInput/{id}', ['as'=>'tasks/editInput', 'uses'=>'tasksController@editInput'])->where('id', '[0-9]+');
Route::get('tasks/editConfirm', ['as'=>'tasks/editConfirm', 'uses'=>'tasksController@editConfirm']);
Route::post('tasks/editConfirm', ['as'=>'tasks/editConfirm', 'uses'=>'tasksController@editConfirm']);
Route::get('tasks/editRegist', ['as'=>'tasks/editRegist', 'uses'=>'tasksController@editRegist']);
Route::post('tasks/editRegist', ['as'=>'tasks/editRegist', 'uses'=>'tasksController@editRegist']);
Route::get('tasks/deleteConfirm/{id}', ['as'=>'tasks/deleteConfirm', 'uses'=>'tasksController@deleteConfirm'])->where('id', '[0-9]+');
Route::post('tasks/deleteConfirm/{id}', ['as'=>'tasks/deleteConfirm', 'uses'=>'tasksController@deleteConfirm'])->where('id', '[0-9]+');
Route::get('tasks/delete', ['as'=>'tasks/delete', 'uses'=>'tasksController@delete'])->where('id', '[0-9]+');
Route::post('tasks/delete', ['as'=>'tasks/delete', 'uses'=>'tasksController@delete'])->where('id', '[0-9]+');

/* holders */
Route::get('holders', ['as'=>'holders/index', 'uses'=>'HoldersController@index']);
Route::post('holders', ['as'=>'holders/index', 'uses'=>'HoldersController@index']);
Route::get('holders/show/{id}', ['as'=>'holders/show', 'uses'=>'HoldersController@show'])->where('id', '[0-9]+');
Route::post('holders/show/{id}', ['as'=>'holders/show', 'uses'=>'HoldersController@show'])->where('id', '[0-9]+');
Route::get('holders/createInput', ['as'=>'holders/createInput', 'uses'=>'HoldersController@createInput']);
Route::post('holders/createInput', ['as'=>'holders/createInput', 'uses'=>'HoldersController@createInput']);
Route::get('holders/createConfirm', ['as'=>'holders/createConfirm', 'uses'=>'HoldersController@createConfirm']);
Route::post('holders/createConfirm', ['as'=>'holders/createConfirm', 'uses'=>'HoldersController@createConfirm']);
Route::get('holders/createRegist', ['as'=>'holders/createRegist', 'uses'=>'HoldersController@createRegist']);
Route::post('holders/createRegist', ['as'=>'holders/createRegist', 'uses'=>'HoldersController@createRegist']);
Route::get('holders/editInput/{id}', ['as'=>'holders/editInput', 'uses'=>'HoldersController@editInput'])->where('id', '[0-9]+');
Route::post('holders/editInput/{id}', ['as'=>'holders/editInput', 'uses'=>'HoldersController@editInput'])->where('id', '[0-9]+');
Route::get('holders/editConfirm', ['as'=>'holders/editConfirm', 'uses'=>'HoldersController@editConfirm']);
Route::post('holders/editConfirm', ['as'=>'holders/editConfirm', 'uses'=>'HoldersController@editConfirm']);
Route::get('holders/editRegist', ['as'=>'holders/editRegist', 'uses'=>'HoldersController@editRegist']);
Route::post('holders/editRegist', ['as'=>'holders/editRegist', 'uses'=>'HoldersController@editRegist']);
Route::get('holders/deleteConfirm/{id}', ['as'=>'holders/deleteConfirm', 'uses'=>'HoldersController@deleteConfirm'])->where('id', '[0-9]+');
Route::post('holders/deleteConfirm/{id}', ['as'=>'holders/deleteConfirm', 'uses'=>'HoldersController@deleteConfirm'])->where('id', '[0-9]+');
Route::get('holders/delete', ['as'=>'holders/delete', 'uses'=>'HoldersController@delete'])->where('id', '[0-9]+');
Route::post('holders/delete', ['as'=>'holders/delete', 'uses'=>'HoldersController@delete'])->where('id', '[0-9]+');
Route::post('holders/getHolderList', ['as'=>'holders/getHolderList', 'uses'=>'HoldersController@getHolderList']);
/* companyMasters */
Route::get('companyMasters', ['as'=>'companyMasters/index', 'uses'=>'CompanyMastersController@index']);
Route::post('companyMasters', ['as'=>'companyMasters/index', 'uses'=>'CompanyMastersController@index']);
Route::get('companyMasters/show/{id}', ['as'=>'companyMasters/show', 'uses'=>'CompanyMastersController@show'])->where('id', '[0-9]+');
Route::post('companyMasters/show/{id}', ['as'=>'companyMasters/show', 'uses'=>'CompanyMastersController@show'])->where('id', '[0-9]+');
Route::get('companyMasters/createInput', ['as'=>'companyMasters/createInput', 'uses'=>'CompanyMastersController@createInput']);
Route::post('companyMasters/createInput', ['as'=>'companyMasters/createInput', 'uses'=>'CompanyMastersController@createInput']);
Route::get('companyMasters/createConfirm', ['as'=>'companyMasters/createConfirm', 'uses'=>'CompanyMastersController@createConfirm']);
Route::post('companyMasters/createConfirm', ['as'=>'companyMasters/createConfirm', 'uses'=>'CompanyMastersController@createConfirm']);
Route::get('companyMasters/createRegist', ['as'=>'companyMasters/createRegist', 'uses'=>'CompanyMastersController@createRegist']);
Route::post('companyMasters/createRegist', ['as'=>'companyMasters/createRegist', 'uses'=>'CompanyMastersController@createRegist']);
Route::get('companyMasters/editInput/{id}', ['as'=>'companyMasters/editInput', 'uses'=>'CompanyMastersController@editInput'])->where('id', '[0-9]+');
Route::post('companyMasters/editInput/{id}', ['as'=>'companyMasters/editInput', 'uses'=>'CompanyMastersController@editInput'])->where('id', '[0-9]+');
Route::get('companyMasters/editConfirm', ['as'=>'companyMasters/editConfirm', 'uses'=>'CompanyMastersController@editConfirm']);
Route::post('companyMasters/editConfirm', ['as'=>'companyMasters/editConfirm', 'uses'=>'CompanyMastersController@editConfirm']);
Route::get('companyMasters/editRegist', ['as'=>'companyMasters/editRegist', 'uses'=>'CompanyMastersController@editRegist']);
Route::post('companyMasters/editRegist', ['as'=>'companyMasters/editRegist', 'uses'=>'CompanyMastersController@editRegist']);
Route::get('companyMasters/deleteConfirm/{id}', ['as'=>'companyMasters/deleteConfirm', 'uses'=>'CompanyMastersController@deleteConfirm'])->where('id', '[0-9]+');
Route::post('companyMasters/deleteConfirm/{id}', ['as'=>'companyMasters/deleteConfirm', 'uses'=>'CompanyMastersController@deleteConfirm'])->where('id', '[0-9]+');
Route::get('companyMasters/delete', ['as'=>'companyMasters/delete', 'uses'=>'CompanyMastersController@delete'])->where('id', '[0-9]+');
Route::post('companyMasters/delete', ['as'=>'companyMasters/delete', 'uses'=>'CompanyMastersController@delete'])->where('id', '[0-9]+');


Route::get('tasks', 'TasksController@index');
Route::post('tasks', 'TasksController@index');
