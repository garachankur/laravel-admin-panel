<?php


// *********** AUTH ****************
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('forgotpassword', function () {
    return view('admin.auth.forgotpassword');
});
Route::get('forgotpassword/{token}', "Auth\LoginController@forgotView");
Route::post('login', 'Auth\LoginController@login');
Route::post('forgotpassword', 'Auth\LoginController@forgotPassword');
Route::any('forgotpasswordset', 'Auth\LoginController@forgotPasswordSet');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    //return "helloo we r in splash page";
    return redirect('admin/dashboard');
});

Route::middleware(['adminAuth'])->group(function () {

    Route::get('/dashboard', 'HomeController@index')->name('adminhome');

    /* ******** ADMIN ********* */
    Route::get('admin-user/editprofile', 'AdminUserController@editProfile');
    Route::get('admin-user/changepassword', 'AdminUserController@changePassword');
    Route::any('admin-route/updateprofile/{id}', 'AdminUserController@updateProfile');

    /* ******** USERS ********* */
    Route::get('users/datatable', 'UserController@getDatatable');
    Route::resource('users', 'UserController');
});
