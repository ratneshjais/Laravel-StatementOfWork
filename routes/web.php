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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{filter}/sows/list', 'SowController@sowList')->name('sowslist')->middleware('auth');
Route::get('{filter}/sows/{id}', 'SowController@sowView')->name('sowView')->middleware('auth');
Route::get('{filter}/sows/{id}/action','SowController@sowActionForm')->name('sows_action')->middleware('auth');
Route::get('{filter}/sows/{id}/step/{step}', 'SowController@stepEdit')->name('sowEdit')->middleware('auth');
Route::get('{filter}/sows/{id}/revision', 'SowController@revision')->name('revision')->middleware('auth');
Route::get('{filter}/sows/{sow_id}/delete-file', 'FileUploadController@deleteFile')->name('deleteFile')->middleware('auth');
Route::get('{filter}/sows/{sow_id}/file-upload', 'FileUploadController@fileUpload')->name('uploaded_file.upload')->middleware('auth');

Route::get('/workflows/{user_id}/add', 'WorkflowController@createWithUser')->name('wfCreateWithUser')->middleware('auth');
Route::get('/workflows/{id}/useredit', 'WorkflowController@editWithUser')->name('wfEditWithUser')->middleware('auth');
Route::post('/workflows/editwithuser', 'WorkflowController@updateWithUser')->name('wfUpdateWithUser')->middleware('auth');
Route::POST('/workflows/storewithuser', 'WorkflowController@storeWithUser')->name('wfStoreWithUser')->middleware('auth');

Route::get('sow_header', 'SowMasterController@sow_header')->name('sow_header')->middleware('auth');
Route::get('sow_header/{id}/show', 'SowMasterController@sow_header_view')->name('sow_header_show')->middleware('auth');
Route::get('sow_header/{id}/edit', 'SowMasterController@sow_header_edit')->name('sow_header_edit')->middleware('auth');
Route::post('sow_header/{id}/update', 'SowMasterController@sow_header_update')->name('sow_header_update')->middleware('auth');

Route::get('geratePdfSows/{id}', 'SowController@generatePdf')->name('geratePdfSows')->middleware('auth');

Route::post('annexupdate',['as' => 'annexupdate', 'uses' => 'SowController@annexupdate'])->middleware('auth');
Route::post('authorizationUpdate',['as' => 'authorizationUpdate', 'uses' => 'SowController@authorizationUpdate'])->middleware('auth');
 
Route::post('comment_store', 'SowController@sowTransition')->name('comment_store')->middleware('auth');

Route::get('/sows/get-signed-sow/{sow_id}', 'FileUploadController@getUploadedSignedSow')->name('get-signed-sow')->middleware('auth');
Route::post('/sows/file-upload', 'FileUploadController@fileUploadPost')->name('uploaded_file.upload.post')->middleware('auth');

Route::get('procuring/get-all-records', 'ProcuringController@getAllActiveRecords')->name('get-procuring-parties')->middleware('auth');
Route::get('project_type/get-all-records', 'ProjectTypeController@getAllActiveRecords')->name('get-project-types')->middleware('auth');
Route::get('search-result', 'HomeController@getFilteredSows')->name('search-result')->middleware('auth');

//Datatbales
Route::post('projectroledt', 'ProjectroleController@prdatatables' )->name('prdatatables');
Route::post('managerdt', 'ManagersController@mdatatables' )->name('mdatatables');
Route::post('locationdt', 'LocationController@loc_datatables' )->name('locationdt');
Route::post('roledt', 'RoleController@role_datatables' )->name('roledt');
Route::post('skilldt', 'ProjectskillController@skill_datatables' )->name('skilldt');
Route::post('permissiondt', 'PermissionController@permission_datatables' )->name('permissiondt');
Route::post('procuringdt', 'ProcuringController@procuring_datatables' )->name('procuringdt');
Route::post('project_typedt', 'ProjectTypeController@project_type_datatables' )->name('project_typedt');
Route::post('sow_headerdt', 'SowMasterController@sow_header_datatables' )->name('sow_headerdt');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('procuring','ProcuringController');
    Route::resource('project_type','ProjectTypeController');
    Route::resource('sows','SowController');
    Route::resource('locations', 'LocationController');
    Route::resource('projectroles','ProjectroleController');
    Route::resource('projectskills','ProjectskillController');
    Route::resource('managers','ManagersController');
    Route::resource('workflows','WorkflowController');
    Route::resource('permission','PermissionController');
});

Route::get('location_revoke/{id}', 'LocationController@location_revoke')->name('location_revoke')->middleware('auth');
Route::get('skill_revoke/{id}', 'ProjectskillController@skill_revoke')->name('skill_revoke')->middleware('auth');
Route::get('manager_revoke/{id}', 'ManagersController@manager_revoke')->name('manager_revoke')->middleware('auth');
Route::get('projectroles_revoke/{id}', 'ProjectroleController@projectroles_revoke')->name('projectroles_revoke')->middleware('auth');
Route::get('procuring_revoke/{id}', 'ProcuringController@procuring_revoke')->name('procuring_revoke')->middleware('auth');
Route::get('project_type_revoke/{id}', 'ProjectTypeController@project_type_revoke')->name('project_type_revoke')->middleware('auth');

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('/amendment/add', 'SowController@createAmendment')->name('createAmendment')->middleware('auth');
Route::post('amendmentStore',['as' => 'amendmentStore', 'uses' => 'SowController@amendmentStore'])->middleware('auth');
Route::post('amendmentUpdate/{id}',['as' => 'amendmentUpdate', 'uses' => 'SowController@amendmentUpdate'])->middleware('auth');
Route::get('amendmentEdit/{id}', 'SowController@amendmentEdit')->name('amendmentEdit')->middleware('auth');


