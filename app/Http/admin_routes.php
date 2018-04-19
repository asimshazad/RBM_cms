<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Customers ================== */

	Route::resource(config('laraadmin.adminRoute') . '/customers', 'LA\CustomersController');
	Route::get(config('laraadmin.adminRoute') . '/customer_dt_ajax', 'LA\CustomersController@dtajax');
    Route::get(config('laraadmin.adminRoute') . '/customer/measurement/{id?}', 'LA\CustomersController@customer_measurement');
	Route::post(config('laraadmin.adminRoute') . '/customer/get_categories', 'LA\CustomersController@get_categories');
	Route::post(config('laraadmin.adminRoute') . '/customer/save', 'LA\CustomersController@saveMeasurement');


	/* ================== Expense_Categories ================== */
	Route::resource(config('laraadmin.adminRoute') . '/expense_categories', 'LA\Expense_CategoriesController');
	Route::get(config('laraadmin.adminRoute') . '/expense_category_dt_ajax', 'LA\Expense_CategoriesController@dtajax');

	/* ================== Add_Expenses ================== */
	Route::resource(config('laraadmin.adminRoute') . '/add_expenses', 'LA\Add_ExpensesController');
	Route::get(config('laraadmin.adminRoute') . '/add_expense_dt_ajax/', 'LA\Add_ExpensesController@dtajax');

	/* ================== Orders ================== */
	Route::resource(config('laraadmin.adminRoute') . '/orders', 'LA\OrdersController');
	Route::get(config('laraadmin.adminRoute') . '/order_dt_ajax', 'LA\OrdersController@dtajax');



	/* ================== SMS_Templates ================== */
	Route::resource(config('laraadmin.adminRoute') . '/sms_templates', 'LA\SMS_TemplatesController');
	Route::get(config('laraadmin.adminRoute') . '/sms_template_dt_ajax', 'LA\SMS_TemplatesController@dtajax');


	/* ================== Categories ================== */
	Route::resource(config('laraadmin.adminRoute') . '/categories', 'LA\CategoriesController');
	Route::get(config('laraadmin.adminRoute') . '/category_dt_ajax', 'LA\CategoriesController@dtajax');

	/* ================== Parts ================== */
	Route::resource(config('laraadmin.adminRoute') . '/parts', 'LA\PartsController');
	Route::get(config('laraadmin.adminRoute') . '/part_dt_ajax', 'LA\PartsController@dtajax');

	/* ================== Assignments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/assignments', 'LA\AssignmentsController');
	Route::get(config('laraadmin.adminRoute') . '/assignment_dt_ajax', 'LA\AssignmentsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/assignments/save', 'LA\AssignmentsController@storeAssignments');
	Route::post(config('laraadmin.adminRoute') . '/get_parts_by_cat', 'LA\AssignmentsController@get_parts_by_cat_id');

	/* ================== Articles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/articles', 'LA\ArticlesController');
	Route::get(config('laraadmin.adminRoute') . '/article_dt_ajax', 'LA\ArticlesController@dtajax');
});
