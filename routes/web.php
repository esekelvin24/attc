<?php

use Illuminate\Support\Facades\Route;



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


/*
Route::get('/', function () {
    return view('/frontend.home');
});
*/
Route::get('/', [App\Http\Controllers\FrontendController::class, 'welcome'])->name('welcome');
Route::get('/management_team', [App\Http\Controllers\FrontendController::class, 'management_team'])->name('management_team');
Route::get('/management_team_details/{id}', [App\Http\Controllers\FrontendController::class, 'management_team_details'])->name('management_team_details');
Route::get('/about_us', [App\Http\Controllers\FrontendController::class, 'about_us'])->name('about_us');
Route::get('/our_programmes', [App\Http\Controllers\FrontendController::class, 'our_programmes'])->name('our_programmes');
Route::get('/programme_courses/{programme_id}', [App\Http\Controllers\FrontendController::class, 'programme_courses'])->name('programme_courses');
Route::get('/course_details/{course_id}', [App\Http\Controllers\FrontendController::class, 'course_details'])->name('course_details');
Route::get('/events', [App\Http\Controllers\FrontendController::class, 'events'])->name('events');
Route::get('/event_details/{event_id}', [App\Http\Controllers\FrontendController::class, 'event_details'])->name('event_details');
Route::get('/accommodation', [App\Http\Controllers\FrontendController::class, 'accommodation'])->name('accommodation');
Route::get('/accommodation/{id}', [App\Http\Controllers\FrontendController::class, 'accommodation_description'])->name('accommodation_description');
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');
Route::post('/submit_contact_form', [App\Http\Controllers\FrontendController::class, 'submit_contact_form'])->name('submit_contact_form');

Auth::routes();

Route::view('/permission_denied', 'errors.permission_denied');

Route::get('/register', [App\Http\Controllers\FrontendController::class, 'register'])->name('register');
Route::post('/sumbit_registration', [App\Http\Controllers\FrontendController::class, 'sumbit_registration'])->name('sumbit_registration');



Route::post('/attempt_login', [App\Http\Controllers\DashboardController::class, 'attempt_login'])->name('attempt_login');
Route::post('/attempt_register', [App\Http\Controllers\DashboardController::class, 'attempt_register'])->name('attempt_register');

//Forgot password
Route::post('/password_reset', [App\Http\Controllers\FrontendController::class, 'password_reset'])->name('password_reset');
Route::get('/reset_account', [App\Http\Controllers\FrontendController::class, 'reset_account'])->name('reset_account');
Route::post('/save_changed_password', [App\Http\Controllers\FrontendController::class, 'save_changed_password'])->name('save_changed_password');



Route::group(['middleware'=>['auth']], function(){


Route::post('/offer_letter/submit', [App\Http\Controllers\DashboardController::class, 'submit_offer_letter'])->name('submit_offer_letter');
Route::post('bank_transfer_completed', [App\Http\Controllers\FeesController::class, 'bank_transfer_completed'])->name('bank_transfer_completed');


Route::get('/programme_list', [App\Http\Controllers\ProgrammeController::class, 'programme_list'])->name('programme_list');
Route::post('/programme_edit', [App\Http\Controllers\ProgrammeController::class, 'programme_edit'])->name('programme_edit');
Route::post('/create_programme', [App\Http\Controllers\ProgrammeController::class, 'create_programme'])->name('create_programme');
Route::post('/save_edited_programme', [App\Http\Controllers\ProgrammeController::class, 'save_edited_programme'])->name('save_edited_programme');
Route::post('/save_programme', [App\Http\Controllers\ProgrammeController::class, 'save_programme'])->name('save_programme');

Route::get('/my_time_table', [App\Http\Controllers\CourseController::class, 'my_time_table'])->name('my_time_table');
Route::get('/course_timetable_details/{course_id}', [App\Http\Controllers\CourseController::class, 'course_timetable_details'])->name('course_timetable_details');


Route::post('/timetable_edit', [App\Http\Controllers\CourseController::class, 'timetable_edit'])->name('timetable_edit');


Route::get('/courses_time_table', [App\Http\Controllers\CourseController::class, 'courses_time_table'])->name('courses_time_table');
Route::post('/new_timetable', [App\Http\Controllers\CourseController::class, 'new_timetable'])->name('new_timetable');
Route::post('/get_courses_by_programme_id', [App\Http\Controllers\CourseController::class, 'get_courses_by_programme_id'])->name('get_courses_by_programme_id');

Route::post('/get_timetable_date_range', [App\Http\Controllers\CourseController::class, 'get_timetable_date_range'])->name('get_timetable_date_range');
Route::post('/save_timetable', [App\Http\Controllers\CourseController::class, 'save_timetable'])->name('save_timetable');
Route::post('/save_update_timetable', [App\Http\Controllers\CourseController::class, 'save_update_timetable'])->name('save_update_timetable');
Route::post('/delete_timetable', [App\Http\Controllers\CourseController::class, 'delete_timetable'])->name('delete_timetable');





Route::post('/save_edited_course', [App\Http\Controllers\CourseController::class, 'save_edited_course'])->name('save_edited_course');
Route::post('/save_course', [App\Http\Controllers\CourseController::class, 'save_course'])->name('save_course');


Route::post('/create_course', [App\Http\Controllers\CourseController::class, 'create_course'])->name('create_course');
Route::post('/course_edit', [App\Http\Controllers\CourseController::class, 'course_edit'])->name('course_edit');

Route::get('/courses_list', [App\Http\Controllers\CourseController::class, 'courses_list'])->name('courses_list');
Route::get('/map_course_to_lecturer', [App\Http\Controllers\HomeController::class, 'map_course_to_lecturer'])->name('map_course_to_lecturer');
Route::get('/assigned_courses', [App\Http\Controllers\CourseController::class, 'assigned_courses'])->name('assigned_courses');
Route::get('/my_certificate', [App\Http\Controllers\ApplicationController::class, 'my_certificate'])->name('my_certificate');
Route::get('/my_pdf_certificate/{application_id}', [App\Http\Controllers\ApplicationController::class, 'my_pdf_certificate'])->name('my_pdf_certificate');

Route::get('/take_ca', [App\Http\Controllers\assessment\AssessmentController::class, 'take_ca'])->name('take_ca');
Route::get('/take_ca_questions', [App\Http\Controllers\assessment\AssessmentController::class, 'take_ca_questions'])->name('take_ca_questions');
Route::post('/next_question', [App\Http\Controllers\assessment\AssessmentController::class, 'next_question'])->name('next_question');
Route::post('/prev_question', [App\Http\Controllers\assessment\AssessmentController::class, 'prev_question'])->name('prev_question');
Route::post('/this_log', [App\Http\Controllers\assessment\AssessmentController::class, 'this_log'])->name('this_log');

Route::post('/save_question_edit', [App\Http\Controllers\assessment\AssessmentController::class, 'save_question_edit'])->name('save_question_edit');
Route::post('/edit_question', [App\Http\Controllers\assessment\AssessmentController::class, 'edit_question'])->name('edit_question');
Route::get('/manage_question', [App\Http\Controllers\assessment\AssessmentController::class, 'manage_question'])->name('manage_question');
Route::get('/upload_ca_question', [App\Http\Controllers\assessment\AssessmentController::class, 'upload_ca_question'])->name('upload_ca_question');
Route::post('/save_ca_upload', [App\Http\Controllers\assessment\AssessmentController::class, 'save_ca_upload'])->name('save_ca_upload');

Route::get('/manage_assessment_weight', [App\Http\Controllers\assessment\AssessmentController::class, 'assessment_weight'])->name('assessment_weight');
Route::get('/manage_assessment', [App\Http\Controllers\assessment\AssessmentController::class, 'manage_assessment'])->name('manage_assessment');
Route::get('/map_lecturer_to_courses', [App\Http\Controllers\CourseController::class, 'map_lecturer_to_courses'])->name('map_lecturer_to_courses');
Route::post('/edit_assessment', [App\Http\Controllers\assessment\AssessmentController::class, 'edit_assessment'])->name('edit_assessment');
Route::post('/save_edit_assessment', [App\Http\Controllers\assessment\AssessmentController::class, 'save_edit_assessment'])->name('save_edit_assessment');


Route::post('/get_assessment_student_list', [App\Http\Controllers\assessment\AssessmentController::class, 'get_assessment_student_list'])->name('get_assessment_student_list');
Route::post('/add_student_to_assessment', [App\Http\Controllers\assessment\AssessmentController::class, 'add_student_to_assessment'])->name('add_student_to_assessment');


Route::post('/add_new_assessment', [App\Http\Controllers\assessment\AssessmentController::class, 'add_new_assessment'])->name('add_new_assessment');
Route::post('/save_assessement', [App\Http\Controllers\assessment\AssessmentController::class, 'save_assessement'])->name('save_assessement');


Route::get('/student_ca_result/{assessment_id}/{course_id}', [App\Http\Controllers\assessment\AssessmentController::class, 'student_ca_result'])->name('student_ca_result');
Route::get('/my_ca_result', [App\Http\Controllers\assessment\AssessmentController::class, 'my_ca_result'])->name('my_ca_result');
Route::get('/event_list', [App\Http\Controllers\EventController::class, 'event_list'])->name('event_list');
Route::post('/edit_event', [App\Http\Controllers\EventController::class, 'edit_event'])->name('edit_event');
Route::post('/save_edit_event', [App\Http\Controllers\EventController::class, 'save_edit_event'])->name('save_edit_event');
Route::post('/create_event', [App\Http\Controllers\EventController::class, 'create_event'])->name('create_event');
Route::post('/save_event', [App\Http\Controllers\EventController::class, 'save_event'])->name('save_event');





Route::get('/all_students', [App\Http\Controllers\StudentController::class, 'all_students'])->name('all_students');
Route::get('/my_students', [App\Http\Controllers\StudentController::class, 'my_students'])->name('my_students');


Route::post('/save_mapped_lecturer', [App\Http\Controllers\CourseController::class, 'save_mapped_lecturer'])->name('save_mapped_lecturer');
Route::post('/course_map_list', [App\Http\Controllers\CourseController::class, 'course_map_list'])->name('course_map_list');





Route::get('/payment_report', [App\Http\Controllers\FeesController::class, 'payment_report'])->name('payment_report');

 
Route::get('/pay_tution_fees', [App\Http\Controllers\FeesController::class, 'pay_tution_fees'])->name('pay_tution_fees');
Route::get('/payment/{type}/{id}', [App\Http\Controllers\FeesController::class, 'payment'])->name('payment');
Route::post('/verify_transaction', [App\Http\Controllers\FeesController::class, 'verify_transaction'])->name('verify_transaction');


Route::get('/confirm_bank_transfer', [App\Http\Controllers\FeesController::class, 'confirm_bank_transfer'])->name('confirm_bank_transfer');
Route::post('/save_confirm_bank_transfer', [App\Http\Controllers\FeesController::class, 'save_confirm_bank_transfer'])->name('save_confirm_bank_transfer');


Route::post('/get_apply_course_list', [App\Http\Controllers\FrontendController::class, 'get_apply_course_list'])->name('get_apply_course_list');

Route::get('/apply', [App\Http\Controllers\FrontendController::class, 'apply'])->name('apply');
Route::post('/sumbit_application', [App\Http\Controllers\FrontendController::class, 'sumbit_application'])->name('sumbit_application');
Route::get('/application_level_approval/{application_id?}/{action?}', [App\Http\Controllers\ApplicationController::class, 'application_level_approval'])->name('application_level_approval');


Route::get('/my_application', [App\Http\Controllers\ApplicationController::class, 'my_application'])->name('my_application');
Route::get('/student_application', [App\Http\Controllers\ApplicationController::class, 'student_application'])->name('student_application');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/roles', [App\Http\Controllers\PermissionController::class, 'Permission'])->name('roles');
    

//First Time Password Change
Route::post('/first_changepsw', [App\Http\Controllers\DashboardController::class, 'first_changepsw'])->name('first_changepsw');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'landing'])->name('dashboard');

Route::get('/profile_update_reminder', [App\Http\Controllers\DashboardController::class, 'profile_update_reminder'])->name('profile_update_reminder');


Route::get('/submit_profile_pic', [App\Http\Controllers\DashboardController::class, 'submit_profile_pic'])->name('submit_profile_pic');

Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');

Route::get('/create_department', [App\Http\Controllers\DashboardController::class, 'create_department'])->name('create_department');
Route::get('/edit_department', [App\Http\Controllers\DashboardController::class, 'edit_department'])->name('edit_department');
Route::get('/new_user', [App\Http\Controllers\DashboardController::class, 'make'])->name('new_user');
//Route::get('/edit_user', [App\Http\Controllers\DashboardController::class, 'make'])->name('edit_user');
Route::post('/save_user',[App\Http\Controllers\user\UserController::class, 'save'])->name('save_user');
Route::post('/save_edits',[App\Http\Controllers\user\UserController::class, 'save_edits'])->name('save_edits');
Route::post('/save_edits_profile',[App\Http\Controllers\user\UserController::class, 'save_edits_profile'])->name('save_edits_profile');


Route::post('/get_designation',[App\Http\Controllers\user\UserController::class, 'get_designation'])->name('get_designation');


Route::post('/get_role_info',[App\Http\Controllers\RoleController::class, 'get_role_info'])->name('get_role_info');
Route::get('/manage_role',[App\Http\Controllers\RoleController::class, 'manage_role'])->name('manage_role');
Route::post('/add_new_role',[App\Http\Controllers\RoleController::class, 'add_new_role'])->name('add_new_role');
Route::post('/save_role',[App\Http\Controllers\RoleController::class, 'save_role'])->name('save_role');
Route::post('/edit_role',[App\Http\Controllers\RoleController::class, 'edit_role'])->name('edit_role');
Route::post('/save_edit_role',[App\Http\Controllers\RoleController::class, 'save_edit_role'])->name('save_edit_role');

Route::post('/save_permission',[App\Http\Controllers\PermissionController::class, 'save_permission'])->name('save_permission');
Route::post('/edit_permission',[App\Http\Controllers\PermissionController::class, 'edit_permission'])->name('edit_permission');
Route::post('/save_edit_permission',[App\Http\Controllers\PermissionController::class, 'save_edit_permission'])->name('save_edit_permission');
Route::post('/get_permission_info',[App\Http\Controllers\PermissionController::class, 'get_permission_info'])->name('get_permission_info');
Route::post('/add_new_permission',[App\Http\Controllers\PermissionController::class, 'add_new_permission'])->name('add_new_permission');
Route::get('/manage_permission',[App\Http\Controllers\PermissionController::class, 'manage_permission'])->name('manage_permission');
Route::get('/assign_permissions_to_user/{user_id}',[App\Http\Controllers\PermissionController::class, 'assign_permissions_to_user'])->name('assign_permissions_to_user');
Route::post('/save_menu_permission',[App\Http\Controllers\PermissionController::class, 'save_menu_permission'])->name('save_menu_permission');
Route::post('/get_role_menu_list',[App\Http\Controllers\PermissionController::class, 'get_role_menu_list'])->name('get_role_menu_list');


Route::post('/save_assign_special_perm',[App\Http\Controllers\PermissionController::class, 'save_assign_special_perm'])->name('save_assign_special_perm');



Route::get('/change_my_password',[App\Http\Controllers\user\UserController::class, 'change_my_password'])->name('change_my_password');
Route::post('/save_password_change',[App\Http\Controllers\user\UserController::class, 'save_password_change'])->name('save_password_change');
Route::post('/reset_password',[App\Http\Controllers\user\UserController::class, 'reset_password'])->name('reset_password');

 

Route::post('/profile_pic/submit',[App\Http\Controllers\DashboardController::class, 'submit_profile_pic'])->name('submit_profile_pic');
Route::get('/profile/{user_id?}',[App\Http\Controllers\DashboardController::class, 'profile'])->name('profile');


Route::get('/new_user',[App\Http\Controllers\user\UserController::class, 'make'])->name('new_user');
Route::post('/username_check', [App\Http\Controllers\user\UserController::class, 'username_check'])->name('username_check');

Route::get('/all_students',[App\Http\Controllers\StudentController::class, 'manage_students'])->name('all_students');
Route::get('/my_students',[App\Http\Controllers\StudentController::class, 'my_students'])->name('my_students');



Route::get('/manage_user',[App\Http\Controllers\user\UserController::class, 'manage_user'])->name('manage_user');
Route::get('/manage_department',[App\Http\Controllers\DashboardController::class, 'manage_department'])->name('manage_department');

Route::get('/manage_special_permission',[App\Http\Controllers\PermissionController::class, 'manage_special_permission'])->name('manage_special_permission');
Route::get('/manage_menu_permission',[App\Http\Controllers\PermissionController::class, 'manage_menu_permission'])->name('manage_menu_permission');


Route::post('/get_user_role',[App\Http\Controllers\RoleController::class, 'get_user_role'])->name('get_user_role');

Route::post('/application_level_approval',[App\Http\Controllers\PermissionController::class, 'application_level_approval'])->name('application_level_approval');
Route::get('/application_details/{application_id}',[App\Http\Controllers\ApplicationController::class, 'application_details'])->name('application_details');



Route::get('/manage_designation',[App\Http\Controllers\DashboardController::class, 'manage_designation'])->name('manage_designation');

});

















Route::group(['middleware' => 'role:developer'], function() {

 
 });