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
    return redirect()->route('login');
});

Route::get('/register', 'HomeController@register')->name('register');
Route::post('/register-token', 'HomeController@check_token')->name('check_token');
Route::get('/register/privacy-policy', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('/register/{token}', 'HomeController@register_student')->name('register_student');
Route::post('/register/student/{section}', 'HomeController@register')->name('register.student');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::prefix('admin')->name('admin.')->middleware(['admin', 'auth'])->group(function () {
    Route::put('/course/{course}/status', 'Admin\CourseController@status')->name('course.status');
    Route::get('/dashboard', 'HomeController@admin_dashboard')->name('dashboard');
    
    Route::get('/courses', 'Admin\CourseController@index')->name('course.index');
    Route::resource('/course', 'Admin\CourseController')->except('index');

    Route::get('/faq', 'Admin\FaqController@index')->name('faq.index');
    Route::resource('/faq', 'Admin\FaqController')->except('index');
    Route::delete('/faq/{faq}', 'FaqController@forceDestroy')->name('faq.destroy');

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

Route::prefix('instructor')->name('instructor.')->middleware(['verified', 'instructor', 'auth'])->group(function () {
    Route::get('/all-course', 'HomeController@instructor_dashboard')->name('dashboard');

    Route::get('/course/{course}/sections', 'Instructor\SectionController@index')->name('section.index');
    Route::put('/course/{course}/section/{section}/status', 'Instructor\SectionController@status')->name('section.status');
    Route::get('/course/{course}/section/deactivated', 'Instructor\SectionController@deactivated')->name('section.deactivated');
    Route::resource('/course/{course}/section', 'Instructor\SectionController')->except(['index','show']);

    Route::get('/course/{course}/announcements', 'Instructor\AnnouncementController@index')->name('announcement.index');
    Route::resource('/course/{course}/announcement', 'Instructor\AnnouncementController')->except(['index','show']);

    Route::resource('/course/{course}/section/{section}/student', 'Instructor\StudentController');

    Route::get('/course/{course}/lessons', 'Instructor\LessonController@index')->name('lesson.index');
    Route::get('/course/{course}/lesson/download/{lesson}', 'Instructor\LessonController@download')->name('lesson.download');
    Route::put('/course/{course}/lesson/{lesson}/status', 'Instructor\LessonController@status')->name('lesson.status');
    Route::resource('/course/{course}/lesson', 'Instructor\LessonController')->except(['index']);

    Route::get('/course/{course}/quizzes', 'Instructor\QuizController@index')->name('quiz.index');
    Route::put('/take/{take}', 'Instructor\QuizController@takeUpdate')->name('quiz.takeUpdate');
    Route::put('/course/{course}/quiz/{quiz}/status', 'Instructor\QuizController@status')->name('quiz.status');
    Route::get('/course/{course}/quiz/{quiz}/take/{take}', 'Instructor\QuizController@takeShow')->name('quiz.takeShow');
    Route::put('/course/{course}/quiz/{quiz}/status', 'Instructor\QuizController@status')->name('quiz.status');
    Route::resource('/course/{course}/quiz', 'Instructor\QuizController')->except(['index']);

    Route::get('/course/{course}/assignments', 'Instructor\AssignmentController@index')->name('assignment.index');
    Route::put('/pass/{pass}', 'Instructor\AssignmentController@passUpdate')->name('assignment.passUpdate');
    Route::get('/course/{course}/assignment/{assignment}/section/{section}/submit/{submit}', 'Instructor\AssignmentController@show_submit')->name('assignment.submit');
    Route::put('/course/{course}/assignment/{assignment}/status', 'Instructor\AssignmentController@status')->name('assignment.status');
    Route::resource('/course/{course}/assignment', 'Instructor\AssignmentController')->except(['index']);

    Route::get('/course/{course}/tokens', 'Instructor\TokenController@index')->name('token.index');
    Route::resource('/course/{course}/token', 'Instructor\TokenController')->except(['index','show']);

    Route::resource('/course/{course}/quiz/{quiz}/question', 'Instructor\QuestionController');

    Route::get('/course/{course}/assignment/{assignment}/question', 'Instructor\QuestionAssignmentController@index')->name('question.assignmentIndex');
    Route::get('/course/{course}/assignment/{assignment}/question/create', 'Instructor\QuestionAssignmentController@create')->name('question.assignmentCreate');
    Route::post('/course/{course}/assignment/{assignment}/question', 'Instructor\QuestionAssignmentController@store')->name('question.assignmentStore');
    Route::get('/course/{course}/assignment/{assignment}/question/{question}/edit', 'Instructor\QuestionAssignmentController@edit')->name('question.assignmentEdit');
    Route::put('/course/{course}/assignment/{assignment}/question/{question}', 'Instructor\QuestionAssignmentController@update')->name('question.assignmentUpdate');
    Route::delete('/course/{course}/assignment/{assignment}/question/{question}', 'Instructor\QuestionAssignmentController@destroy')->name('question.assignmentDestroy');

    Route::get('/export/{course}/{section}', 'Instructor\SectionController@export')->name('export.section');
});


Route::prefix('student')->name('student.')->middleware(['verified', 'student', 'auth'])->group(function () {
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
    Route::get('/my-files', 'UserController@my_files')->name('my_files');
    Route::post('/my-files', 'UserController@files_store')->name('my_files.store');
    Route::get('/my-files/download/{file}', 'UserController@files_download')->name('my_files.download');
    Route::delete('/my-files/{file}', 'UserController@files_destroy')->name('my_files.destroy');

    Route::post('/new-message', 'MessageController@store')->name('message.store');
    Route::post('/new-message/reply/{convo}', 'MessageController@reply')->name('message.reply');
    Route::get('/{student?}/course/{course?}/section/{section?}/{tab?}/messages', 'MessageController@index')->name('message.index');
    Route::get('/{student?}/course/{course?}/section/{section?}/{tab?}/messages/convo/{convo}', 'MessageController@show')->name('message.show');

    Route::get('/{instructor?}/course/{course?}/{tab?}/messages', 'MessageController@index3')->name('message.index3');
    Route::get('/{instructor?}/course/{course?}/{tab?}/messages/convo/{convo}', 'MessageController@show3')->name('message.show3');

    Route::get('/messages', 'MessageController@index2')->name('message.index2');
    Route::get('/messages/convo/{convo}', 'MessageController@show2')->name('message.show2');

    Route::post('/runcode', 'TakeController@runCode')->name('runCode');
    Route::get('/markAsRead', 'MessageController@markAsRead')->name('markAsRead');
    Route::get('/markAsAllRead', 'MessageController@markAsAllRead')->name('markAsAllRead');
    Route::get('/getUserFullname', 'UserController@getUserFullname')->name('getUserFullname');
    Route::get('/get_messages_url', 'UserController@get_messages_url')->name('get_messages_url');
});
