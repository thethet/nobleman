<?php


// Home
Route::get('/home',function(){
	return View::make('home.index');
});

Route::get('/',array('uses'=>'CoverController@index'));
Route::get('/login',array('uses'=>'CoverController@index'));
Route::post('/login',array('uses'=>'CoverController@authent'));
Route::get('/logout',array('uses'=>'CoverController@logout'));
Route::post('/forgot',array('uses'=>'CoverController@forgot'));
Route::get('/resetPassword/{email}/{token}',array('uses'=>'CoverController@resetPassword'));
Route::post('/processResetPassword',array('uses'=>'CoverController@processResetPassword'));

// Admin
Route::post('/students/import',array('before' => 'auth','uses'=>'StudentsController@import'));
Route::get('/students/export',array('before' => 'auth','uses'=>'StudentsController@export'));

Route::get('/students',array('before' => 'auth','uses'=>'StudentsController@lists'));
Route::post('/students',array('before' => 'auth','uses'=>'StudentsController@delete'));
Route::get('/students/create',array('before' => 'auth','uses'=>'StudentsController@create'));
Route::post('/students/create',array('before' => 'auth','uses'=>'StudentsController@store'));
Route::get('/students/{id}',array('before' => 'auth','uses'=>'StudentsController@view'));

Route::get('/students/create/paypal/{id}/{data}',array('before' => 'auth','uses'=>'StudentsController@linkpaypal'));
Route::get('/students/create/paypalsuccess',array('before' => 'auth','uses'=>'StudentsController@linkpaypalsuccess'));


Route::post('/students/{id}',array('before' => 'auth','uses'=>'StudentsController@edit'));
Route::put('/students/changestatus/{id}',array('before' => 'auth','uses'=>'StudentsController@changestatus'));
Route::get('/students/listcourse/{id}',array('before' => 'auth','uses'=>'StudentsController@listcourse'));
Route::get('/students/listattendance/{id}',array('before' => 'auth','uses'=>'StudentsController@listattendance'));
Route::get('/students/addcourse/{id}',array('before' => 'auth','uses'=>'StudentsController@addcourse'));
Route::post('/students/addcourse/{id}',array('before' => 'auth','uses'=>'StudentsController@addcourse2'));
Route::post('/students/{stduentId}/sing-up-module',array('before' => 'auth','uses'=>'StudentsController@signUpModule'));
Route::patch('/students/{stduentId}/update-module/{moduleId}',array('before' => 'auth','uses'=>'StudentsController@updateModule'));
Route::delete('/students/{stduentId}/delete-module/{moduleId}',array('before' => 'auth','uses'=>'StudentsController@removeSignUpModule'));

Route::get('/students/download/{id}',array('before' => 'auth','uses'=>'StudentsController@download'));


//Dashboard
Route::get('/dashboard',array('before' => 'auth', 'uses' => 'DashboardController@index'));
Route::post('/dashboard/newstdreport',array('before' => 'auth', 'uses' => 'DashboardController@newstdreport'));
Route::post('/dashboard/paymentreport',array('before' => 'auth', 'uses' => 'DashboardController@paymentreport'));
Route::post('/dashboard/sponsorreport',array('before' => 'auth', 'uses' => 'DashboardController@sponsorreport'));
Route::post('/dashboard/coursereport',array('before' => 'auth', 'uses' => 'DashboardController@coursereport'));


//Print Schedule
Route::get('/print',array('before' => 'auth', 'uses' => 'PrintScheduleController@index'));
Route::post('/print/downloadall',array('before' => 'auth', 'uses' => 'PrintScheduleController@downloadall'));
Route::post('/print/download',array('before' => 'auth', 'uses' => 'PrintScheduleController@download'));
Route::post('/print/show',array('before' => 'auth', 'uses' => 'PrintScheduleController@show'));


//Payment Tracking
Route::get('/payment/export',array('before' => 'auth','uses'=>'PaymentController@export'));
Route::post('/payment/reportexport',array('before' => 'auth','uses'=>'PaymentController@reportexport'));
Route::get('/payment',array('before' => 'auth', 'uses' => 'PaymentController@index'));
Route::post('/payment/report',array('before' => 'auth', 'uses' => 'PaymentController@report'));
Route::put('/payment/changestatus/{id}',array('before' => 'auth','uses'=>'PaymentController@changestatus'));


//Courses1(no use)
/*Route::get('/courses1',array('before' => 'auth', 'uses'=>'Courses1Controller@index'));
Route::post('/courses1',array('before' => 'auth','uses'=>'Courses1Controller@delete'));
Route::get('/courses1/create',array('before' => 'auth','uses'=>'Courses1Controller@create'));
Route::post('/courses1/create',array('before' => 'auth','uses'=>'Courses1Controller@store'));
Route::get('/courses1/{id}',array('before' => 'auth','uses'=>'Courses1Controller@view'));
Route::patch('/courses1/{id}',array('before' => 'auth','uses'=>'Courses1Controller@edit'));
Route::post('/courses1',array('before' => 'auth','uses'=>'Courses1Controller@delete'));
Route::get('/courses1/download/{id}',array('before' => 'auth','uses'=>'Courses1Controller@download'));*/


// CHANGE MODULES TO BE BECOMES COURSES
Route::post('/courses/import',array('before' => 'auth','uses'=>'CoursesController@import'));
Route::get('/courses/export',array('before' => 'auth','uses'=>'CoursesController@export'));

Route::get('/courses',array('before' => 'auth','uses'=>'CoursesController@index'));
Route::post('/courses',array('before' => 'auth','uses'=>'CoursesController@delete'));
Route::get('/courses/create',array('before' => 'auth','uses'=>'CoursesController@create'));
Route::post('/courses/create',array('before' => 'auth','uses'=>'CoursesController@store'));
Route::get('/courses/{id}',array('before' => 'auth','uses'=>'CoursesController@view'));
Route::post('/courses/{id}',array('before' => 'auth','uses'=>'CoursesController@edit'));

Route::get('/courses/download/{id}',array('before' => 'auth','uses'=>'CoursesController@download'));


//Lessons
Route::post('/lessons/import',array('before' => 'auth','uses'=>'LessonsController@import'));
Route::get('/lessons/export',array('before' => 'auth','uses'=>'LessonsController@export'));

Route::get('/lessons',array('before' => 'auth','uses'=>'LessonsController@index'));
Route::post('/lessons',array('before' => 'auth','uses'=>'LessonsController@delete'));
Route::get('/lessons/create',array('before' => 'auth','uses'=>'LessonsController@create'));
Route::post('/lessons/create',array('before' => 'auth','uses'=>'LessonsController@store'));
Route::get('/lessons/{id}',array('before' => 'auth','uses'=>'LessonsController@show'));
Route::post('/lessons/{id}',array('before' => 'auth','uses'=>'LessonsController@edit'));
Route::get('/lessons/download/{id}',array('before' => 'auth','uses'=>'LessonsController@download'));


//attendance
Route::get('/attendance/export',array('before' => 'auth','uses'=>'AttendanceController@export'));
Route::post('/attendance/filterexport',array('before' => 'auth','uses'=>'AttendanceController@filterexport'));

Route::get('/attendance',array('before' => 'auth','uses'=>'AttendanceController@index'));
Route::post('/attendance',array('before' => 'auth','uses'=>'AttendanceController@mark'));
Route::post('/attendance/datefilter',array('before' => 'auth','uses'=>'AttendanceController@datefilter'));
Route::get('/attendance/mark',array('before' => 'auth','uses'=>'FakeController@markattendance'));
Route::get('/attendance/marksheet',array('before' => 'auth','uses'=>'FakeController@marksheetattendance'));

Route::get('/attendance/create',array('before' => 'auth','uses'=>'AttendanceController@create'));

//trainer
Route::get('/trainers/export',array('before' => 'auth','uses'=>'TrainersController@export'));
Route::get('/trainers',array('before' => 'auth','uses'=>'TrainersController@lists'));
Route::get('/trainers/create',array('before' => 'auth','uses'=>'TrainersController@create'));
Route::post('/trainers/create',array('before' => 'auth','uses'=>'TrainersController@store'));
Route::post('/trainers',array('before' => 'auth','uses'=>'TrainersController@delete'));
Route::get('/trainers/{id}',array('before' => 'auth','uses'=>'TrainersController@view'));
Route::post('/trainers/{id}',array('before' => 'auth','uses'=>'TrainersController@edit'));


//trainer schedules at admin
Route::get('/trainerschedule/export',array('before' => 'auth','uses'=>'TrainersScheduleController@export'));
Route::post('/trainerschedule/filterexport',array('before' => 'auth','uses'=>'TrainersScheduleController@filterexport'));
Route::get('/trainerschedule',array('before' => 'auth','uses'=>'TrainersScheduleController@index'));
Route::post('/trainerschedule/datefilter',array('before' => 'auth','uses'=>'TrainersScheduleController@datefilter'));
Route::post('/trainerschedule',array('before' => 'auth','uses'=>'TrainersScheduleController@delete'));
Route::get('/trainerschedule/create',array('before' => 'auth','uses'=>'TrainersScheduleController@create'));
Route::post('/trainerschedule/create',array('before' => 'auth','uses'=>'TrainersScheduleController@store'));
Route::any('/trainerschedule/lessonsajax',array('before' => 'auth','uses'=>'TSlessonsAjaxController@lessonsajax'));
Route::any('/trainerschedule/sessionajax',array('before' => 'auth','uses'=>'TSSessionsAjaxController@sessionajax'));

Route::any('/trainerschedule/lessonsajaxedit',array('before' => 'auth','uses'=>'TSlessonseditAjaxController@lessonsajaxedit'));
Route::any('/trainerschedule/sessionajaxedit',array('before' => 'auth','uses'=>'TSSessionseditAjaxController@sessionajaxedit'));
Route::get('/trainerschedule/{id}',array('before' => 'auth','uses'=>'TrainersScheduleController@show'));
Route::post('/trainerschedule/{id}',array('before' => 'auth','uses'=>'TrainersScheduleController@edit'));


//trainer dashboard
Route::get('/trainer/attendance/export',array('before' => 'auth','uses'=>'TrainerAttendanceController@export'));
Route::post('/trainer/attendance/filterexport',array('before' => 'auth','uses'=>'TrainerAttendanceController@filterexport'));

Route::get('/trainer/attendance',array('before' => 'auth','uses' => 'TrainerAttendanceController@index'));
Route::post('trainer/attendance',array('before' => 'auth','uses' => 'TrainerAttendanceController@mark'));
Route::post('trainer/attendance-filter',array('before' => 'auth','uses' => 'TrainerAttendanceController@filter'));
Route::post('trainer/attendanceflt',array('before' => 'auth','uses' => 'TrainerAttendanceController@markflt'));

Route::get('/trainer/schedules',array('before' => 'auth','uses' => 'TrainerDashboardController@index'));
Route::get('/trainer/announcement',array('before' => 'auth','uses'=>'TrainerDashboardController@traannouncementshow'));
Route::get('/trainer/stdbylesson',array('before' => 'auth','uses'=>'TrainerDashboardController@stdbylesson'));
Route::post('trainer/stdbylesson-filter',array('before' => 'auth','uses' => 'TrainerDashboardController@stdbylessonfilter'));

Route::get('/trainer/stdbylesson/export',array('before' => 'auth','uses'=>'TrainerDashboardController@export'));
Route::post('/trainer/stdbylesson-filter/filterexport',array('before' => 'auth','uses'=>'TrainerDashboardController@filterexport'));

//user
Route::get('/users',array('before' => 'auth','uses'=>'FakeController@users'));
Route::get('/users/create',array('before' => 'auth','uses'=>'UsersController@create'));
Route::post('/users/create',array('before' => 'auth','uses'=>'UsersController@store'));

//student

Route::get('/appointment',array('before' => 'auth','uses'=>'AppointmentController@index'));
Route::get('/appointment/book',array('before' => 'auth','uses'=>'AppointmentController@book'));
Route::post('/appointment/book',array('before' => 'auth','uses'=>'AppointmentController@store'));
Route::get('/appointment/{id}',array('before' => 'auth','uses'=>'AppointmentController@lists'));

Route::post('/appointment',array('before' => 'auth','uses'=>'AppointmentController@delete'));

Route::any('/appointmentajax',array('before' => 'auth','uses'=>'AppointmentAjaxController@sessionajax'));


//certificate
Route::get('/cert',array('before' => 'auth','uses'=>'CertController@index'));
Route::get('/cert/cert1',array('before' => 'auth','uses'=>'CertController@cert1'));
Route::post('/cert/cert1',array('before' => 'auth','uses'=>'CertController@save1'));
Route::get('/cert/cert2',array('before' => 'auth','uses'=>'CertController@cert2'));
Route::post('/cert/cert2',array('before' => 'auth','uses'=>'CertController@save2'));
Route::get('/cert/cert3',array('before' => 'auth','uses'=>'CertController@cert3'));
Route::post('/cert/cert3',array('before' => 'auth','uses'=>'CertController@save3'));
Route::get('/cert/cert4',array('before' => 'auth','uses'=>'CertController@cert4'));
Route::post('/cert/cert4',array('before' => 'auth','uses'=>'CertController@save4'));


Route::get('/cert/certificates',array('before' => 'auth','uses'=>'CertController@certificatelists'));
Route::get('/cert/certificates/{id}',array('before' => 'auth','uses'=>'CertController@certificateview'));
Route::post('/cert/certificates/{id}',array('before' => 'auth','uses'=>'CertController@certificateedit'));
Route::get('/cert/create',array('before' => 'auth','uses'=>'CertController@create'));
Route::post('cert/create',array('before' => 'auth','uses'=>'CertController@storenewcertificate'));
Route::post('/cert/certificates',array('before' => 'auth','uses'=>'CertController@certificatedelete'));

Route::get('/cert/generatecertlists/export',array('before' => 'auth','uses'=>'CertController@export'));
Route::get('/cert/generatecertlists',array('before' => 'auth','uses'=>'CertController@generatelists'));
Route::get('/cert/generatecert',array('before' => 'auth','uses'=>'CertController@gcertcreate'));
Route::post('/cert/generatecert',array('before' => 'auth','uses'=>'CertController@gcertstore'));

Route::post('/cert/generatecertlists',array('before' => 'auth','uses'=>'CertController@gcertdelete'));


Route::patch('/cert/certificate-receive-status/{id}',array('before' => 'auth','uses'=>'CertController@updateCertificateStatus'));

Route::post('/cert/generatecertlists',array('before' => 'auth','uses'=>'CertController@gcertdelete'));

Route::get('/cert/generatecertlists/download/{id}',array('before' => 'auth','uses'=>'CertController@download'));


//announcement
Route::get('/announcement',array('before' => 'auth','uses'=>'AnnouncementController@index'));
Route::get('/announcement/create',array('before' => 'auth','uses'=>'AnnouncementController@create'));
Route::post('/announcement/create',array('before' => 'auth','uses'=>'AnnouncementController@store'));
Route::get('/announcement/{id}',array('before' => 'auth','uses'=>'AnnouncementController@show'));
Route::post('/announcement/{id}',array('before' => 'auth','uses'=>'AnnouncementController@update'));
Route::post('/announcement',array('before' => 'auth','uses'=>'AnnouncementController@delete'));

Route::get('/stdannouncement',array('before' => 'auth','uses'=>'AnnouncementController@stdannouncementshow'));

//dashboard (student announcement page)
//Route::get('/dashboard',array('before' => 'auth','uses'=>'AnnouncementController@lists'));


//change password
Route::get('/changepassword',array('before' => 'auth', 'uses'=>'ChangepasswordController@index'));
Route::post('/changepassword/create',array('before' => 'auth', 'uses'=>'ChangepasswordController@store'));


//calendar settings
//Route::get('/settings',array('before' => 'auth', 'uses'=>'CalendarSettingController@index'));
//Route::get('/sessions',array('before' => 'auth', 'uses'=>'CalendarSettingController@index'));
Route::get('/sessions/show',array('before' => 'auth', 'uses'=>'CalendarSettingController@show'));
Route::post('/sessions/show',array('before' => 'auth', 'uses'=>'CalendarSettingController@show'));
Route::post('/sessions/create',array('before' => 'auth', 'uses'=>'CalendarSettingController@store'));



//holidays
Route::get('/holidays',array('before' => 'auth','uses'=>'HolidaysController@index'));
Route::get('/holiday/create',array('before' => 'auth', 'uses' => 'HolidaysController@create'));
Route::post('/holiday/create',array('before' => 'auth','uses'=>'HolidaysController@store'));
Route::get('/holiday/{id}',array('before' => 'auth','uses'=>'HolidaysController@view'));
Route::post('/holiday/{id}',array('before' => 'auth','uses'=>'HolidaysController@edit'));
Route::post('/holiday',array('before' => 'auth','uses'=>'HolidaysController@delete'));


//student dashboard
Route::get('/stdschedules',array('before' => 'auth','uses' => 'StudentDashboardController@index'));
Route::any('/stdschedules/bookingajax',array('before' => 'auth','uses'=>'StudentDashboardScheduleBookingAjaxController@bookingajax'));
Route::any('/stdschedules/unbookingajax',array('before' => 'auth','uses'=>'StudentDashboardScheduleUnBookingAjaxController@unbookingajax'));

Route::any('/stdschedules/waitbookingajax',array('before' => 'auth','uses'=>'StudentDashboardScheduleWaitBookingAjaxController@waitbookingajax'));

Route::get('/registercourse',array('before' => 'auth','uses' => 'StudentsRegisterMoreCourseController@index'));
Route::get('/addmorecourse',array('before' => 'auth','uses' => 'StudentsRegisterMoreCourseController@createCourse'));

Route::any('/addmorecourse/moduledataajax',array('before' => 'auth','uses' => 'ModuleDataAjaxController@moduleDataAjax'));

Route::post('/addmorecourse',array('before' => 'auth','uses' => 'StudentsRegisterMoreCourseController@storeCourse'));

Route::get('/addmorecourse/paypal/{id}/{data}',array('before' => 'auth','uses'=>'StudentsRegisterMoreCourseController@linkpaypal'));
Route::get('/addmorecourse/paypalsuccess',array('before' => 'auth','uses'=>'StudentsRegisterMoreCourseController@linkpaypalsuccess'));

/*====================================== Report Module ============================================*/

Route::group(['before' => 'auth'],function()
{
	Route::group(['prefix' => 'reports'],function(){
		Route::get('certified-students/export','ReportController@certifiedStudentsExport');
		Route::get('certified-students','ReportController@certifiedStudents');
		Route::get('attendance-students/export','ReportController@attendanceStudentsExport');
		Route::get('attendance-students','ReportController@attendanceStudents');
		Route::get('trial-students/export','ReportController@trialStudentsExport');
		Route::get('trialstudents-history','ReportController@trialstudentsHistory');

		Route::get('trainer-course-taught/export','ReportController@trainerCourseTaughtExport');
		Route::get('trainer-course-taught','ReportController@trainerCourseTaught');
		Route::get('trainer-students/export','ReportController@trainerStudentTaughtExport');
		Route::get('trainer-students','ReportController@trainerStudentTaught');

		Route::get('course-history/export','ReportController@courseHistoryExport');
		Route::get('course-history','ReportController@courseHistory');
		Route::post('course-history/filter-export','ReportController@courseHistoryFilterExport');
		Route::post('course-history/filter','ReportController@courseHistoryFilter');
	});

	Route::resource('branch','BranchController');

});

/*=================================== End Report Module ============================================*/


//Reminder
Route::get('/remindertostudents',array('before' => 'auth','uses' => 'ReminderController@remindertoStudents'));
Route::post('/remindertostudents/sendemail',array('before' => 'auth','uses' => 'ReminderController@sendEmailToStudents'));

Route::get('/remindertotrialstudents',array('before' => 'auth','uses' => 'ReminderController@remindertoTrialStudents'));
Route::post('/remindertostudents/sendemail',array('before' => 'auth','uses' => 'ReminderController@sendEmailToTrialStudents'));

Route::get('/remindertotrainers',array('before' => 'auth','uses' => 'ReminderController@remindertoTrainers'));
Route::post('/remindertotrainers/sendemailtotrainers',array('before' => 'auth','uses' => 'ReminderController@sendEmailToTrainers'));

Route::get('/reminderforcourseexpire',array('before' => 'auth','uses' => 'ReminderController@reminderforCourseExpire'));
Route::post('/reminderforcourseexpire/sendemailfor-courseexpire',array('before' => 'auth','uses' => 'ReminderController@sendEmailForCourseExpire'));


//Reminder Template
Route::get('/remindertostudents-template',array('before' => 'auth','uses' => 'ReminderTemplateController@remindertostudentsTempalte'));
Route::post('/remindertostudents-template',array('before' => 'auth','uses' => 'ReminderTemplateController@remindertostudentsTempalteSave'));

Route::get('/remindertotrialstudents-template',array('before' => 'auth','uses' => 'ReminderTemplateController@remindertotrialstudentsTempalte'));
Route::post('/remindertotrialstudents-template',array('before' => 'auth','uses' => 'ReminderTemplateController@remindertotrialstudentsTempalteSave'));

Route::get('/remindertotrainers-template',array('before' => 'auth','uses' => 'ReminderTemplateController@remindertotrainersTempalte'));
Route::post('/remindertotrainers-template',array('before' => 'auth','uses' => 'ReminderTemplateController@remindertotrainersTempalteSave'));

Route::get('/reminderforcourseexpire-template',array('before' => 'auth','uses' => 'ReminderTemplateController@reminderforcourseexpireTempalte'));
Route::post('/reminderforcourseexpire-template',array('before' => 'auth','uses' => 'ReminderTemplateController@reminderforcourseexpireTempalteSave'));
