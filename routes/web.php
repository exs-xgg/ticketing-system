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

Route::get('/', function () {
    return redirect()->route('faq');
});



Route::post('/register/student/{section}', 'HomeController@register')->name('register.student');
Route::get('/register', 'HomeController@register')->name('register');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::post('/register/student/{section}', 'HomeController@register')->name('register.student');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::prefix('admin')->name('admin.')->middleware(['admin', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@admin_dashboard')->name('dashboard');
    
    Route::get('/concerns', 'Admin\ConcernController@index')->name('concern.index');
    Route::resource('/concern', 'Admin\ConcernController');
    Route::resource('/concerns', 'Admin\ConcernController');

    Route::get('/faq', 'Admin\FaqController@index')->name('faq.index');
    Route::resource('/faq', 'Admin\FaqController')->except('index');
 

    Route::get('/instructor/{id}/course/{course}/section/{section}', 'Admin\InstructorController@section')->name('instructor.section');
    Route::get('/instructor/{id}/course/{course}', 'Admin\InstructorController@course')->name('instructor.course');


    Route::delete('/instructor/trash/{user}', 'Admin\InstructorController@forceDestroy')->name('instructor.forceDestroy');
    Route::put('/instructor/restore/{user}', 'Admin\InstructorController@restore')->name('instructor.restore');
    Route::get('/instructor/trash', 'Admin\InstructorController@trash')->name('instructor.trash');


    
    Route::resource('/instructor', 'Admin\InstructorController');
    Route::get('/student', 'Admin\StudentController@index')->name('student.index');

    // datables
   
});

Route::resource('concern2', 'Concerns2Controller');




Route::prefix('student')->name('student.')->middleware(['verified', 'student', 'auth'])->group(function () {
    Route::get('/concerns', 'Student\ConcernController@index')->name('concern.index');
    Route::resource('/concern', 'Student\ConcernController')->except('index');


// 




    

    Route::get('/dashboard', 'HomeController@student_dashboard')->name('dashboard');
   
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UserController@index')->name('profile.index');
    Route::put('/profile', 'UserController@update')->name('profile.update');
    Route::put('/profile/picture', 'UserController@profile_remove')->name('profile.picture.remove');
    Route::get('/change-password', 'UserController@change_password_index')->name('change.password.index');
    Route::put('/change-password', 'UserController@change_password_update')->name('change.password.update');


       
});
