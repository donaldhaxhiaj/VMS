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
    //Purpose Routes
    Route::resource('admin/purpose','PurposeController');

    Route::get('admin/change-password', 'Auth\UpdatePasswordController@index')->name('admin.password.form');
    Route::post('admin/change-password', 'Auth\UpdatePasswordController@update')->name('admin.password.update');
   


    Route::post('visit/ajax-create', 'VisitorController@ajaxStore')->name('visitor.ajaxStore');
    Route::post('admin/visit/EndVisit', 'VisitController@EndVisit')->name('visit.EndVisit');
    Route::post('admin/visit/CancelVisit', 'VisitController@CancelVisit')->name('visit.CancelVisit');
    Route::post('admin/visit/StartVisit', 'VisitController@StartVisit')->name('visit.StartVisit');
    Route::post('admin/visit/StartVisit2', 'VisitController@StartVisit2')->name('visit.StartVisit2');
    Route::post('visitor/ChangeStatus', 'VisitorController@ChangeStatus')->name('visitor.ChangeStatus');
    Route::post('visitor/ajaxList', 'VisitorController@ajaxList' )->name('visitor.ajaxList');
    Route::post('visit/ajaxList', 'VisitController@ajaxList' )->name('visit.ajaxList');

    //Admin Auth Routes
    Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-login', 'Auth\LoginController@login');
    Route::get('admin-logout', 'Auth\LoginController@logout')->name('logout');
});

Route::get('updatePassword','UserController@updatePassword');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

