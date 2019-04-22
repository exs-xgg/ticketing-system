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
    Route::resource('/concern', 'Admin\ConcernController')->except('index');

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
    Route::get('/list/courses', 'Admin\CourseController@coursesList')->name('courseList');
});




Route::prefix('student')->name('student.')->middleware(['verified', 'student', 'auth'])->group(function () {
    Route::get('/concerns', 'Student\ConcernController@index')->name('concern.index');
    Route::resource('/concern', 'Student\ConcernController')->except('index');






    

    Route::get('/dashboard', 'HomeController@student_dashboard')->name('dashboard');
    Route::get('/course/{course}/section/{section}/announcements', 'StudentController@announcement')->name('announcement');
    Route::get('/course/{course}/section/{section}/mysection', 'StudentController@section_index')->name('section.index');
    // lesson
    Route::get('/course/{course}/section/{section}/lessons', 'StudentController@lesson_index')->name('lesson.index');
    Route::get('/course/{course}/section/{section}/lesson/{lesson}', 'StudentController@lesson_show')->name('lesson.show');
    Route::get('/course/{course}/section/{section}/lesson/{lesson}/download', 'StudentController@lesson_download')->name('lesson.download');

    Route::get('/course/{course}/section/{section}/quizzes', 'StudentController@quiz_index')->name('quiz.index');
    Route::get('/course/{course}/section/{section}/quiz/{quiz}', 'StudentController@quiz_show')->name('quiz.show');

    Route::get('/course/{course}/section/{section}/assignments', 'StudentController@assignment_index')->name('assignment.index');
    Route::get('/course/{course}/section/{section}/assignment/{assignment}', 'StudentController@assignment_show')->name('assignment.show');

    Route::post('/course/{course}/section/{section}/quiz/{quiz}/takes/code-quiz', 'TakeController@storeCodeQuiz')->name('take.storeCodeQuiz');
    Route::post('/course/{course}/section/{section}/quiz/{quiz}/take', 'TakeController@store')->name('take.store');
    Route::get('/course/{course}/section/{section}/quiz/{quiz}/take/{take}/result', 'TakeController@result')->name('take.result');

    Route::post('/course/{course}/section/{section}/assignment/{assignment}/pass', 'TakeController@store_assignment')->name('pass.store_assignment');
    Route::get('/course/{course}/section/{section}/assignment/{assignment}/pass/{pass}/result', 'TakeController@result_assignment')->name('pass.result_assignment');

    Route::post('/dashboard/register-token', 'StudentController@check_token')->name('check_token');
    Route::get('/dashboard/register-token/{token}', 'StudentController@course_add')->name('course.add');
    Route::post('/dashboard/register/{section}', 'StudentController@register_store')->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UserController@index')->name('profile.index');
    Route::put('/profile', 'UserController@update')->name('profile.update');
    Route::put('/profile/picture', 'UserController@profile_remove')->name('profile.picture.remove');
    Route::get('/change-password', 'UserController@change_password_index')->name('change.password.index');
    Route::put('/change-password', 'UserController@change_password_update')->name('change.password.update');

       
});
