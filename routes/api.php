<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Department
Route::get('department/list', 'departmentController@listDepartment');
Route::post('department/add', 'departmentController@adddDpartment');
Route::put('department/edit/{id}', 'departmentController@editDepartment');
Route::delete('department/delete/{id}', 'departmentController@deleteDepartment');

// Employee
Route::post('employee/add', 'employeeController@addEmployee');
Route::put('employee/edit/{id}', 'employeeController@editEmployee');
Route::delete('employee/delete/{id}', 'employeeController@deleteEmployee');
Route::get('employee/list', 'employeeController@listEmployee');
Route::get('employee/empWithDep', 'employeeController@empWithDep');
Route::get('employee/empOnStatus/{id}', 'employeeController@empOnStatus');
