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

// Route::get('/', function () {
//     return view('welcome');
// });

//kelola project
Route::group(['prefix' => '/'], function () {
  Route::get('/', 'ProjectController@index')->name('project.index');
  Route::post('/create', 'ProjectController@store')->name('project.store');
  Route::get('/{project_id}', 'ProjectController@show')->name('project.show');
  Route::post('/update/{id}', 'ProjectController@update')->name('project.update');
  Route::get('/delete/{id}', 'ProjectController@destroy')->name('project.destroy');
  // kelola fitur
  Route::group(['prefix' => '/{project_id}'], function () {
    Route::post('/create', 'FeatureController@store')->name('feature.store');
    Route::get('/{feature_id}', 'FeatureController@show')->name('feature.show');
    Route::post('/update/{id}', 'FeatureController@update')->name('feature.update');
    Route::get('/delete/{id}', 'FeatureController@destroy')->name('feature.destroy');
    //kelola skenario
    Route::group(['prefix' => '/{feature_id}'], function () {
      Route::post('/create', 'ScenarioController@store')->name('scenario.store');
      // Route::get('/{scenario_id}', 'ScenarioController@show')->name('scenario.show');
      Route::post('/update/{id}', 'ScenarioController@update')->name('scenario.update');
      Route::get('/delete/{id}', 'ScenarioController@destroy')->name('scenario.destroy');
      //kelola konten skenario
      Route::group(['prefix' => '{scenario_id}/content'], function () {
        Route::post('/create', 'ScenarioController@storeContent')->name('scenario.content.store');
        Route::get('/delete/{type}/{id}', 'ScenarioController@destroyContent')->name('scenario.content.destroy');
      });
    });
  });
});
