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
Route::get('project_roles', 'ProjectRoleController@getAllData');
Route::get('project_skills', 'ProjectSkillController@getAllData');
Route::get('sow_team_compositions/{sow}', 'SowTeamCompositionController@show');
Route::post('sow_team_compositions', 'SowTeamCompositionController@store');
Route::put('sow_team_compositions/{sowTeamComposition}', 'SowTeamCompositionController@update');
Route::delete('sow_team_compositions/{sowTeamComposition}', 'SowTeamCompositionController@delete');
Route::get('attribute_comment/{sow}/{attribute}', 'AttributeCommentController@atribCommentlist')->name('AtribCommentlist');
Route::get('attribute_comment/{sow}', 'AttributeCommentController@sowCommentlist')->name('sowCommentlist');
Route::post('attribute_comment', 'AttributeCommentController@store')->name('sowslist'); 
Route::get('attribute_comment_by_cid/{commentID}', 'AttributeCommentController@sowCommentlistByComment')->name('sowCommentlistByComment');
Route::get('project_header/{protype}', 'SowMasterController@sowHeaderlist')->name('sowHeaderlist');
//Route::post('sow_list/{id}', 'SowController@getAllSow');


