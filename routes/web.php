<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DtrController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Report2Controller;
use App\Http\Controllers\reportprintController;

use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\SIPController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login.page');
});


Route::get('SIP/main', [SIPController::class, 'main'])->name('sip.main');
Route::post('SIP/save', [SIPController::class, 'save'])->name('sip.save');
Route::get('SIP/manage/{id}', [SIPController::class, 'manage'])->name('sip.manage');
Route::post('/sip/update/{id}', 'SIPController@update')->name('sip.update');
Route::post('/sip/aip/update/{id}', 'SIPController@updateAip')->name('sip.aip.update');

Route::post('/forgot-password', [App\Http\Controllers\LoginController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/sip/procurement/store/{id}', [SIPController::class, 'storeProcurement'])->name('sip.procurement.store');
Route::get('/sip/procurement/list/{id}', [SIPController::class, 'procurementList'])
    ->name('sip.procurement.list');

    Route::get('/sip/procurement/{procurement_id}/items', [SIPController::class, 'procurementItems'])
    ->name('sip.procurement.items');

// Other Main pages
Route::get('/invalid', [MainController::class, 'invalid']);
Route::get('/image-gallery', [MainController::class, 'imageGallery']);
Route::get('/officers', [MainController::class, 'officersPage']);

// Login routes
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.page');
Route::post('/login', [LoginController::class, 'validateUser']);

// After successful login, redirect to Admin Dashboard
Route::get('/admin/main', [AdminController::class, 'main'])->name('admin.main');

// Election routes
Route::get('/election/nominate', [ElectionController::class, 'nominate']);
Route::post('/election/nominate-submit', [ElectionController::class, 'nominateSubmit']);
Route::get('/election/elect', [ElectionController::class, 'elect']);
Route::post('/election/elect-submit', [ElectionController::class, 'electSubmit']);
Route::get('/election/elect2', [ElectionController::class, 'elect2']);
Route::post('/election/elect2-submit', [ElectionController::class, 'elect2Submit']);
Route::post('/election/decline', [ElectionController::class, 'declineNomination']);

// Admin panel routes
Route::get('/admin/main', [AdminController::class, 'main']);
Route::get('/admin/members', [AdminController::class, 'members']);
Route::get('/admin/migs', [AdminController::class, 'migs']);
Route::get('/admin/nominated', [AdminController::class, 'nominated']);
Route::get('/admin/voted', [AdminController::class, 'voted']);

// News routes
Route::get('/news/home', [NewsController::class, 'home'])->name('news.home');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
Route::get('/news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');

Route::post('/change-password', [ResetPasswordController::class, 'changePassword'])->name('password.change');

Route::get('/dtr', [DtrController::class, 'index'])->name('dtr.index');
Route::get('/dtr/user/{id}', [DtrController::class, 'showUserDtr'])->name('dtr.user');
Route::post('/dtr/save-user-remarks', [DtrController::class, 'saveUserRemarks'])->name('dtr.saveUserRemarks');
Route::post('/dtr/save-admin-remarks', [DtrController::class, 'saveAdminRemarks'])->name('dtr.saveAdminRemarks');
Route::get('/dtr/record/{id}', [DtrController::class, 'printableDtr'])->name('dtr.printable');
Route::put('/dtr/update-remark/{id}', [DtrController::class, 'updateRemark'])->name('dtr.updateRemark');
Route::post('/dtr/saveUserRemarks', [DtrController::class, 'saveUserRemarks'])->name('dtr.saveUserRemarks');

Route::get('/report', [ReportController::class, 'showForm'])->name('report.showForm');
Route::get('/report/print/{id}', [ReportController::class, 'print'])->name('report.print');
Route::post('/report/submit', [ReportController::class, 'submitReport'])->name('report.submit');
Route::post('/report-card', [Report2Controller::class, 'store'])->name('report.store');
Route::get('/report/print/{id}', [ReportController::class, 'print'])->name('report.print');
Route::get('/report/search-students', [ReportController::class, 'searchStudents'])->name('report.searchStudents');
Route::get('/students/search', [ReportController::class, 'searchStudents'])->name('students.search');

Route::get('/api/employees/search', [ReportController::class, 'searchEmployee'])->name('api.employees.search');

// Redirect to report2 view (not used in current case)
Route::get('/report-card', [Report2Controller::class, 'showForm'])->name('report2.form');
Route::get('/report2/show', [Report2Controller::class, 'showForm'])->name('report2.show');

Route::get('/report-print/{id}', [ReportController::class, 'print'])->name('reportprint.show');

