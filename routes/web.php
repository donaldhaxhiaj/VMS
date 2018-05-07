<?php

// User Routes
Route::group(['namespace' => 'User'],function() {
    Route::get('visitor/visitor', 'VisitorController@visitor')->name('visitor');
    Route::get('visit/{visit}', 'HomeController@visit')->name('visit');
    Route::get('visit/company/{company}', 'HomeController@company')->name('company');
    Route::get('visit/visitors/{visitors}', 'HomeController@visitors')->name('visitors');
});


//Admin Routes
Route::group(['namespace' => 'Admin'],function() {
    Route::get('/','HomeController@index');

    Route::get('admin/home','HomeController@index')->name('admin.home');

    //User Routes
    Route::resource('admin/user','UserController');
    //Roles Routes
    Route::resource('admin/role','RoleController');
    //Permissions Routes
    Route::resource('admin/permission','PermissionController');
    //Visitor Routes
    Route::resource('admin/visitor','VisitorController');
    //Tag Routes
    Route::resource('admin/tag','TagController');
    //Category Routes
    Route::resource('admin/category','CategoryController');
    //visit Routes
    Route::resource('admin/visit','VisitController');
    // Company Routes
    Route::resource('admin/company','CompanyController');

    //Admin Auth Routes
    Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-login', 'Auth\LoginController@login');
    Route::get('admin-logout', 'Auth\LoginController@logout')->name('logout');


});




Auth::routes();

Route::get('admin/home', 'HomeController@index')->name('admin.home');
