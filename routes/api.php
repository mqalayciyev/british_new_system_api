<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('product', 'App\Http\Controllers\ProductController');


Route::apiResource('login', 'App\Http\Controllers\API\SessionController');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', ['App\Http\Controllers\API\SessionController', 'logoutApi']);
    Route::apiResource('notifications', 'App\Http\Controllers\API\NotificationController');
    Route::prefix('managers')->group(function () {
        Route::apiResource('manager', 'App\Http\Controllers\API\Manage\ManagerController');
        Route::post('/manager/add_image', ['App\Http\Controllers\API\Manage\ManagerController', 'add_image']);
        Route::post('/manager/change_password', ['App\Http\Controllers\API\Manage\ManagerController', 'change_password']);
        Route::post('/manager/delete_image/{id}', ['App\Http\Controllers\API\Manage\ManagerController', 'delete_image']);
        Route::apiResource('company', 'App\Http\Controllers\API\Manage\CompanyController');
        Route::post('/company/add_image', ['App\Http\Controllers\API\Manage\CompanyController', 'add_image']);
        Route::post('/company/delete_image', ['App\Http\Controllers\API\Manage\CompanyController', 'delete_image']);
        Route::apiResource('lesson', 'App\Http\Controllers\API\Manage\LessonController');
        Route::apiResource('level', 'App\Http\Controllers\API\Manage\LevelController');
        Route::apiResource('learning_type', 'App\Http\Controllers\API\Manage\LearningTypeController');
        Route::apiResource('exam_type', 'App\Http\Controllers\API\Manage\ExamTypeController');
        Route::apiResource('age_category', 'App\Http\Controllers\API\Manage\AgeCategoryController');
        Route::apiResource('academic_hour', 'App\Http\Controllers\API\Manage\AcademicHoursController');
        Route::apiResource('teachers_payment', 'App\Http\Controllers\API\Manage\SalaryController');
        Route::apiResource('leads', 'App\Http\Controllers\API\Manage\LeadsController');
        Route::post('/addStudent/{id}', ['App\Http\Controllers\API\Manage\LeadsController', 'addStudent']);
        Route::apiResource('leads-notes', 'App\Http\Controllers\API\Manage\LeadsNoteController');
        Route::apiResource('messages', 'App\Http\Controllers\API\Manage\MessagesController');
        Route::get('/count-messages', ['App\Http\Controllers\API\Manage\MessagesController', 'count_messages']);
        Route::apiResource('evaluations', 'App\Http\Controllers\API\Manage\EvaluationController');
        Route::post('owner', ['App\Http\Controllers\API\Manage\ManagerController', 'owner']);
        Route::apiResource('clients', 'App\Http\Controllers\API\Manage\CorparateController');
        Route::apiResource('offices', 'App\Http\Controllers\API\Manage\OfficeController');
        Route::apiResource('teacher', 'App\Http\Controllers\API\Manage\AcademicStaffController');
        Route::apiResource('announcements', 'App\Http\Controllers\API\Manage\AnnouncementController');
        Route::apiResource('students', 'App\Http\Controllers\API\Manage\StudentController');
        Route::post('/student/study_days/{id}', ['App\Http\Controllers\API\Manage\StudentController', 'study_days']);
        Route::post('/student/lessons/{id}', ['App\Http\Controllers\API\Manage\StudentController', 'lessons']);
        Route::apiResource('group', 'App\Http\Controllers\API\Manage\GroupController');
        Route::post('/group/study_days/{id}', ['App\Http\Controllers\API\Manage\GroupController', 'study_days']);
        Route::post('/group/get-students/{id}', ['App\Http\Controllers\API\Manage\GroupController', 'get_students']);
        Route::post('/group/add-students/{id}', ['App\Http\Controllers\API\Manage\GroupController', 'add_students']);
        Route::apiResource('private', 'App\Http\Controllers\API\Manage\PrivateController');
        Route::post('/private/study_days/{id}', ['App\Http\Controllers\API\Manage\PrivateController', 'study_days']);
        Route::apiResource('demo', 'App\Http\Controllers\API\Manage\DemoController');
        Route::apiResource('exam', 'App\Http\Controllers\API\Manage\ExamController');
        Route::post('/exam/levels/{id}', ['App\Http\Controllers\API\Manage\ExamController', 'levels']);
        Route::get('/exam_tests', ['App\Http\Controllers\API\Manage\ExamController', 'tests']);
        Route::apiResource('tests', 'App\Http\Controllers\API\Manage\TestController');
        Route::apiResource('questions', 'App\Http\Controllers\API\Manage\QuestionController');
        Route::apiResource('payments', 'App\Http\Controllers\API\Manage\FinanceController');
        Route::post('/payments/due', ['App\Http\Controllers\API\Manage\FinanceController', 'due']);
        Route::apiResource('tasks', 'App\Http\Controllers\API\Manage\TasksController');
        Route::post('/tasks/completed', ['App\Http\Controllers\API\Manage\TasksController', 'completed']);
        Route::post('/tasks/status/{id}', ['App\Http\Controllers\API\Manage\TasksController', 'status']);
        Route::apiResource('media', 'App\Http\Controllers\API\Manage\MediaController');
        Route::apiResource('users', 'App\Http\Controllers\API\UserController');
    });

    Route::prefix('teachers')->group(function () {
        Route::apiResource('teacher', 'App\Http\Controllers\API\Teacher\TeacherController');
        Route::post('/teacher/add_image', ['App\Http\Controllers\API\Teacher\TeacherController', 'add_image']);
        Route::post('/teacher/delete_image/{id}', ['App\Http\Controllers\API\Teacher\TeacherController', 'delete_image']);
        Route::apiResource('leads', 'App\Http\Controllers\API\Teacher\LeadsController');
        Route::apiResource('leads-notes', 'App\Http\Controllers\API\Teacher\LeadsNoteController');
        Route::apiResource('messages', 'App\Http\Controllers\API\Teacher\MessagesController');
        Route::get('/count-messages', ['App\Http\Controllers\API\Teacher\MessagesController', 'count_messages']);
        Route::apiResource('manager', 'App\Http\Controllers\API\Teacher\AdminStaffController');
        Route::apiResource('announcements', 'App\Http\Controllers\API\Teacher\AnnouncementController');
        // Route::apiResource('evaluations', 'App\Http\Controllers\API\Teacher\EvaluationController');
        Route::apiResource('tasks', 'App\Http\Controllers\API\Teacher\TasksController');
        Route::post('/tasks/completed', ['App\Http\Controllers\API\Teacher\TasksController', 'completed']);
        Route::post('/tasks/status/{id}', ['App\Http\Controllers\API\Teacher\TasksController', 'status']);

        Route::apiResource('group', 'App\Http\Controllers\API\Teacher\GroupController');
        //            Route::post('/group/study_days/{id}', ['App\Http\Controllers\API\Manage\GroupController', 'study_days']);
        //            Route::post('/group/get-students/{id}', ['App\Http\Controllers\API\Manage\GroupController', 'get_students']);
        //            Route::post('/group/add-students/{id}', ['App\Http\Controllers\API\Manage\GroupController', 'add_students']);
        Route::apiResource('private', 'App\Http\Controllers\API\Teacher\PrivateController');
        //            Route::post('/private/study_days/{id}', ['App\Http\Controllers\API\Manage\PrivateController', 'study_days']);
        Route::apiResource('demo', 'App\Http\Controllers\API\Teacher\DemoController');
        Route::apiResource('exam', 'App\Http\Controllers\API\Teacher\ExamController');
        Route::post('/exam/levels/{id}', ['App\Http\Controllers\API\Teacher\ExamController', 'levels']);
        Route::apiResource('tests', 'App\Http\Controllers\API\Teacher\TestController');
        Route::get('/exam_tests', ['App\Http\Controllers\API\Teacher\ExamController', 'tests']);
        Route::apiResource('questions', 'App\Http\Controllers\API\Teacher\QuestionController');
    });

    Route::prefix('students')->group(function () {
        Route::apiResource('student', 'App\Http\Controllers\API\Student\StudentController');
        Route::post('/student/add_image', ['App\Http\Controllers\API\Student\StudentController', 'add_image']);
        Route::post('/student/delete_image/{id}', ['App\Http\Controllers\API\Student\StudentController', 'delete_image']);
        Route::apiResource('messages', 'App\Http\Controllers\API\Student\MessagesController');
        Route::get('/count-messages', ['App\Http\Controllers\API\Student\MessagesController', 'count_messages']);
        Route::apiResource('announcements', 'App\Http\Controllers\API\Student\AnnouncementController');
        //        Route::apiResource('evaluations', 'App\Http\Controllers\API\Teacher\EvaluationController');
        Route::apiResource('manager', 'App\Http\Controllers\API\Student\AdminStaffController');
        Route::apiResource('tasks', 'App\Http\Controllers\API\Student\TasksController');
        Route::post('/tasks/completed', ['App\Http\Controllers\API\Student\TasksController', 'completed']);
        Route::post('/tasks/status/{id}', ['App\Http\Controllers\API\Student\TasksController', 'status']);

        //        Route::apiResource('group', 'App\Http\Controllers\API\Teacher\GroupController');
        //        Route::apiResource('private', 'App\Http\Controllers\API\Teacher\PrivateController');
        //        Route::apiResource('demo', 'App\Http\Controllers\API\Teacher\DemoController');
        Route::apiResource('exam', 'App\Http\Controllers\API\Student\ExamController');
        //        Route::post('/exam/levels/{id}', ['App\Http\Controllers\API\Teacher\ExamController', 'levels']);
        Route::apiResource('tests', 'App\Http\Controllers\API\Student\TestController');
        Route::apiResource('audio', 'App\Http\Controllers\API\Student\AudioController');
        Route::apiResource('image', 'App\Http\Controllers\API\Student\SlidesController');
        Route::apiResource('video', 'App\Http\Controllers\API\Student\VideoController');
        Route::apiResource('book', 'App\Http\Controllers\API\Student\BooksController');
        Route::apiResource('lesson', 'App\Http\Controllers\API\Student\LessonController');
        Route::apiResource('exam', 'App\Http\Controllers\API\Student\ExamController');
        Route::apiResource('tests', 'App\Http\Controllers\API\Student\TestController');
        Route::post('test-end', ['App\Http\Controllers\API\Student\TestController', 'test_end']);
        //        Route::apiResource('questions', 'App\Http\Controllers\API\Teacher\QuestionController');
        //        });
    });
});

//Route::prefix('manager')->group(function () {


//    Route::post('/login', ['App\Http\Controllers\API\SessionController', 'store']);
//    Route::apiResource('login', 'App\Http\Controllers\API\SessionController');
//    Route::post('/logout/{session}', ['App\Http\Controllers\API\SessionController', 'destroy']);
//    Route::group(['middleware' => 'manager'], function () {
//        Route::apiResource('tasks', 'App\Http\Controllers\API\Manage\TasksController');
//        Route::apiResource('leads', 'App\Http\Controllers\API\Manage\LeadsController');
//        Route::apiResource('messages', 'App\Http\Controllers\API\Manage\MessagesController');
//        Route::apiResource('corparate', 'App\Http\Controllers\API\Manage\CorparateController');
//        Route::apiResource('offices', 'App\Http\Controllers\API\Manage\OfficeController');
//        Route::apiResource('administrative-staff', 'App\Http\Controllers\API\Manage\AdminStaffController');
//        Route::apiResource('academic-staff', 'App\Http\Controllers\API\Manage\AcademicStaffController');
//        Route::apiResource('teacher-available', 'App\Http\Controllers\API\Manage\TeacherAvailableController');
//        Route::apiResource('announcement', 'App\Http\Controllers\API\Manage\AnnouncementController');
//        Route::apiResource('students', 'App\Http\Controllers\API\Manage\StudentController');
//        Route::apiResource('group-lesson', 'App\Http\Controllers\API\Manage\GroupController');
//        Route::apiResource('private-lesson', 'App\Http\Controllers\API\Manage\PrivateController');
//        Route::apiResource('demo-lesson', 'App\Http\Controllers\API\Manage\DemoController');
//        Route::apiResource('exam', 'App\Http\Controllers\API\Manage\ExamController');
//        Route::apiResource('attendance-map', 'App\Http\Controllers\API\Manage\AttendanceMapController');
//        Route::apiResource('media', 'App\Http\Controllers\API\Manage\MediaController');
//        Route::apiResource('tests', 'App\Http\Controllers\API\Manage\TestController');
//        Route::apiResource('scheduling', 'App\Http\Controllers\API\Manage\SchedulingController');
//        Route::apiResource('finance', 'App\Http\Controllers\API\Manage\FinanceController');
//        Route::apiResource('evaluation', 'App\Http\Controllers\API\Manage\EvaluationController');
//        Route::apiResource('lesson', 'App\Http\Controllers\API\Manage\LessonController');
//        Route::apiResource('level', 'App\Http\Controllers\API\Manage\LevelController');
//        Route::apiResource('learning-type', 'App\Http\Controllers\API\Manage\LearningTypeController');
//        Route::apiResource('age-category', 'App\Http\Controllers\API\Manage\AgeCategoryController');
//        Route::apiResource('academic-hours', 'App\Http\Controllers\API\Manage\AcademicHoursController');
//        Route::apiResource('salary', 'App\Http\Controllers\API\Manage\SalaryController');
//        Route::apiResource('company', 'App\Http\Controllers\API\Manage\CompanyController');
//    });
//    Route::group(['prefix' => 'manager'], function () {});
//});

//Route::prefix('student')->group(function () {
//    // Route::get('/login', ['App\Http\Controllers\API\SessionController', 'index'])->name('student.login');
//    Route::apiResource('login', 'App\Http\Controllers\API\SessionController');
//    Route::group(['middleware' => 'student'], function () {});
//    Route::group(['prefix' => 'student'], function () {});
//});
