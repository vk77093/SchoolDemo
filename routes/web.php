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
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\StudentManagement\ClassManagementController;
use App\Http\Controllers\StudentManagement\YearController;
use App\Http\Controllers\StudentManagement\StudentGroupController;
use App\Http\Controllers\StudentManagement\ShiftManagementController;
use App\Http\Controllers\StudentManagement\FeeCategoryController;
use App\Http\Controllers\StudentManagement\FeeCategoryAmountController;
use App\Http\Controllers\StudentManagement\ExamTypeController;
use App\Http\Controllers\StudentManagement\SubjectTypeController;
use App\Http\Controllers\StudentManagement\AssignSubjectController;
use App\Http\Controllers\StudentManagement\DesignationController;

Route::get('/',[UserController::class,'GoToLoginPage'])->name('home')->middleware(['guest:'.config('fortify.guard')]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[UserController::class,'GoToAdminDashboard'] )->name('dashboard');
});

Route::get('/logout',[UserController::class,'LogoutUser'])->name('user.logout');
Route::middleware('auth:sanctum')->group(function(){
//User Manager Route
Route::prefix('user')->group(function(){
Route::controller(UserController::class)->group(function(){
Route::get('viewuser','ViewUser')->name('user.view');
Route::get('createuser','CreateUser')->name('user.create');
Route::get('edituser/{id}','EditUser')->name('user.edit');
Route::post('createuser','CreateUserPost')->name('user.createpost');
Route::post('updateuser/{id}','UpdateUserPost')->name('user.updatepost');
Route::get('deleteuser/{id}','DeleteUser')->name('user.delete');
});
});// end of usercontroller

Route::prefix('profile')->group(function () {
Route::controller(ProfileController::class)->group(function () {
Route::get('view','ViewProfile')->name('profile.view');
Route::get('edit','EditProfile')->name('profile.edit');
Route::post('update','UpdateProfileAction')->name('profile.update');
Route::get('changepassword','ChangePasswordPage')->name('profile.changepassword');
Route::post('updatepassword','ChangePasswordPageAction')->name('profile.updatepassword');
});
});//end of profileController
//SetUp Management

Route::prefix('setup')->group(function(){
//Class Setup
Route::controller(ClassManagementController::class)->group(function(){
Route::get('student/class/view','ViewClass')->name('student.view.class');
Route::get('student/class/edit/{id}','EditClass')->name('student.edit.class');
Route::get('student/class/delete/{id}','DeleteClass')->name('student.delete.class');
Route::get('student/class/create','CreateClass')->name('student.create.class');
Route::post('student/class/add','AddClass')->name('student.add.class');
Route::post('student/class/update/{id}','UpdateClass')->name('student.update.class');

});
//end of class Setup
//year Management
Route::controller(YearController::class)->group(function (){
    Route::get('student/year/view','ViewYear')->name('student.view.year');
    Route::get('student/year/edit/{id}','EditYear')->name('student.edit.year');
    Route::get('student/year/delete/{id}','DeleteYear')->name('student.delete.year');
    Route::get('student/year/create','CreateYear')->name('student.create.year');
    Route::post('student/year/add','AddYear')->name('student.add.year');
    Route::post('student/year/update/{id}','UpdateYear')->name('student.update.year');
}); //end of year Management

//student Group Management
Route::resource('studentgroup', StudentGroupController::class);
Route::get('student/{id}',[StudentGroupController::class,'DeleteGroup'])->name('studentgroup.group.delete');
//end of group Management

//shiftManagement
Route::resource('shift',ShiftManagementController::class);
Route::get('shiftdelete/{id}',[ShiftManagementController::class,'DeleteShift'])->name('shift.delete');
//end of shiftManagement

//fee Category management
Route::resource('feecategory', FeeCategoryController::class);
Route::get('feecatgeoryDelete/{id}',[FeeCategoryController::class,'DeleteFeeCategory'])->name('feecategory.delete');
//end of fee Category management

//FeeCategoryAmountController management
Route::resource('feecateamount', FeeCategoryAmountController::class);
Route::get('feeamt/{id}',[FeeCategoryAmountController::class,'DeleteFeeCategoryAmount'])->name('feecateamount.delete');

//end of FeeCate amout manage

//exam Type
Route::resource('examtype',ExamTypeController::class);
Route::get('/examtypedelete/{id}',[ExamTypeController::class,'DeleteExamType'])->name('examtype.delete');
//end of exam Type

//subject Type
Route::resource('subject',SubjectTypeController::class);
Route::get('subjectDel/{id}',[SubjectTypeController::class,'DeleteSubject'])->name('subject.delete');
// end of subject Type

//assign Subject
Route::resource('assignsubject',AssignSubjectController::class);
Route::get('/assignSubDel/{id}',[SubjectTypeController::class,'DeleteAssignedSubject'])->name('assignsubject.delete');
//edn of assign subject

//Designation management
Route::resource('designation',DesignationController::class);
Route::get('designationDelete/{id}',[DesignationController::class,'DeleteDesignation'])->name('designation.delete');
//end of Designation management

});//end of prefix setupController
});
