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
use App\Http\Controllers\StudentReg\AssignStudentRegController;
use App\Http\Controllers\StudentReg\RollNumberController;
use App\Http\Controllers\StudentReg\RegistrationFeesController;
use App\Http\Controllers\StudentReg\MonthlyFeesController;
use App\Http\Controllers\StudentReg\ExamFeesController;
//employee Payrool
use App\Http\Controllers\EmployeeManagement\EmployeeRegistrationController;
use App\Http\Controllers\EmployeeManagement\EmployeeSalaryController;
use App\Http\Controllers\EmployeeManagement\EmployeeLeaveController;
use App\Http\Controllers\EmployeeManagement\EmployeeAttendenceController;
use App\Http\Controllers\EmployeeManagement\EmployeeMontlySalaryController;

//Marks Management
use App\Http\Controllers\MarksManagement\MarkMangementContoller;
use App\Http\Controllers\MarksManagement\MarksGradeController;

//Account Management
use App\Http\Controllers\AccountManagement\StudentFeeController;
use App\Http\Controllers\AccountManagement\AccountSalaryController;
use App\Http\Controllers\AccountManagement\OtherCostController;



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
Route::prefix('student')->group(function(){
//student Registration
Route::resource('registration',AssignStudentRegController::class);
Route::get('studentpromote/{stu_id}',[AssignStudentRegController::class, 'PromoteStudent'])->name('registration.promote');
Route::post('studentpromote/{stu_id}',[AssignStudentRegController::class, 'UpdatePromoteStudent'])->name('registration.updatepromote');
Route::get('generatestudentDetails/{id}',[AssignStudentRegController::class, 'StudentDetailsPDF'])->name('studentdetails.pdf');
//end of student registration
Route::get('rollview',[RollNumberController::class, 'RollView'])->name('rollview.view');
Route::post('assignrolenumber',[RollNumberController::class, 'StudentRoleStore'])->name('assignrolenumber.post');

//student Registration fees Management
Route::controller(RegistrationFeesController::class)->group(function(){
Route::get('registrationfee/fees','RegisterationFeesView')->name('registrationfee.view');
Route::get('registrationfee/fees/classwiseget','ClassWiseGet')->name('registrationfee.fees.classwiseget');
Route::get('registrationfee/payslip','GeneratePaySlip')->name('student.registrationfee.payslip');
});
//end of student Registration fees Management
//monthly Fees Management
Route::controller(MonthlyFeesController::class)->group(function(){
Route::get('monthlyFees/fees','MonthlyFeesView')->name('monthlyFees.view');
Route::get('monthlyFees/fees/classandmonthwise','ClassAndMonthWiseGet')->name('montlyfee.fees.classandmonthwiseget');
Route::get('monthlyFees/payslip','GeneratePaySlip')->name('student.monthlyfee.payslip');
});
//end of monthly fees Management
//Exam Fees Management
Route::controller(ExamFeesController::class)->group(function(){
    Route::get('examFees/fees','examFeesView')->name('examFees.view');
    Route::get('examFees/fees/classandmonthwise','ClassAndMonthWiseGet')->name('examfee.fees.classandmonthwiseget');
    Route::get('examFees/payslip','GeneratePaySlip')->name('student.examfee.payslip');
});
//end of Exam fees

}); //end of Student Prefix
Route::get('getstudents',[RollNumberController::class, 'GetStudent'])->name('jsonfetch.getstudents');

//Employee Management Prefix
Route::prefix('employeeManagement')->group(function(){
    //Employee Registration 
Route::controller(EmployeeRegistrationController::class)->group(function(){
Route::get('emp/registration','ViewEmpRegis')->name('empregistration.ViewEmpRegis');
Route::get('emp/create','CreateEmp')->name('empregistration.create');
Route::post('emp/createpost','AddEmployee')->name('empregistration.createpost');
Route::get('emp/edit/{id}','EditEmployee')->name('empregistration.edit');
Route::post('emp/update/{id}','UpdateEmployee')->name('empregistration.update');
Route::get('emp/delete/{id}','DeleteEmployee')->name('empregistration.delete');
Route::get('emp/viewpdf/{id}','viewPdf')->name('empregistration.viewPdf');
}); //end of employee Registration

//Employee Salary Controller
Route::controller(EmployeeSalaryController::class)->group(function(){
Route::get('salary/view','ViewSalary')->name('salary.view');
Route::post('salary/SalaryIncrementpost/{id}','SalaryIncrementSave')->name('salary.incrementpost');
Route::get('salary/SalaryIncrement/{id}','SalaryIncrement')->name('salary.increment');
Route::get('salary/viewDetails/{id}','ViewSalaryDetails')->name('salary.viewdetails');
// Route::post('salary/update/{id}','UpdateSalary')->name('salary.update');
// Route::get('salary/delete/{id}','DeleteSalary')->name('salary.delete');
}); //end of employee Salary Controller
 
//Employee Leave 
Route::controller(EmployeeLeaveController::class)->group(function(){
Route::get('leave/view','LeaveView')->name('leave.view');
Route::get('leave/create','CreateLeave')->name('leave.create');
Route::post('leave/save','SaveLeave')->name('leave.save');
Route::get('leave/edit/{id}','EditLeave')->name('leave.edit');
Route::post('leave/update/{id}','UpdateLeave')->name('leave.update');
Route::get('leave/delete/{id}','DeleteLeave')->name('leave.delete');

});//end of Employee Leave Controller

//Employee Attendence
Route::controller(EmployeeAttendenceController::class)->group(function(){
Route::get('attendence/view','AttendenceView')->name('attendence.view');
Route::get('attendence/create','AttendenceCreate')->name('attendence.create');
Route::post('attendence/save','AttendenceSave')->name('attendence.save');
Route::get('attendence/edit/{attendence_date}','AttendenceEdit')->name('attendence.edit');
Route::get('attendence/details/{attendence_date}','AttendenceDetails')->name('attendence.details');
Route::get('attendence/delete/{attendence_date}','AttendenceDelete')->name('attendence.delete');
Route::post('attendence/update/{attendence_date}','AttendenceUpdate')->name('attendence.update');
}); //end of Employee Attendence

//EMployee Monthly Salary Controller
Route::controller(EmployeeMontlySalaryController::class)->group(function(){
Route::get('monthlysalary/view','ViewMonthlySalary')->name('monthlysalary.view');
Route::get('montlysalary/get','MonthlySalaryGet')->name('monthlysalary.get');
Route::get('monthlysalary/payslip/{empid}','MonthlySalaryPayslip')->name('monthlysalary.payslip');
}); //end of EmployeeMonthlySalaryController

}); //end of Employee Management Prefix

//Marks Management Prefix
Route::prefix('marks')->group(function(){
//Marks Controller
Route::controller(MarkMangementContoller::class)->group(function(){
Route::get('addmarks','AddMarks')->name('marks.addmarks');
Route::get('getsubject','GetSubjectJson')->name('marks.getsubjectjson'); //jsonroute
Route::get('getstudentjson','GetStudentJson')->name('marks.getstudentjson');//json route
Route::post('savestudentMarks','SaveStudentMarks')->name('marks.save');
Route::get('studentmarksedit','EditStudentMarks')->name('marks.edit');
Route::get('getstudentmarks','GetPreviousStudentMarks')->name('marks.getmarksjson'); //json route
Route::post('updatedstudentmarks','UpdateStudentMarks')->name('marks.update');
}); //end of Marks Controller

//Grade Controller
Route::controller(MarksGradeController::class)->group(function(){
Route::get('grade/view','ViewGrade')->name('grade.view');
Route::get('grade/create','CreateGrade')->name('grade.create');
Route::get('grade/edit/{id}','EditGrade')->name('grade.edit');
Route::post('grade/save','SaveGrade')->name('grade.save');
Route::post('grade/update/{id}','UpdateGrade')->name('grade.update');
Route::get('grade/delete/{id}','DeleteGrade')->name('grade.delete');
});
//end of Grade Controller

});
//end of Marks Management prefix

//Account Managemet Prefix
Route::prefix('account')->group(function(){
//StudentFee Management Controller
Route::controller(StudentFeeController::class)->group(function(){
Route::get('fees/view','StudentFeesView')->name('fees.view');
Route::get('fees/create','StudentFeesCreate')->name('fees.create');
Route::get('fees/edit/{id}','StudentFeesEdit')->name('fees.edit');
Route::get('fees/delete/{id}','StudentFeesDelete')->name('fees.delete');
Route::post('fees/save','SaveFeesData')->name('fees.save');
Route::get('fees/getstudentjson','GetStudentJson')->name('account.fees.getstudentjosn');
});
//end of Student Fee Controller

//Account Salary Controller
Route::controller(AccountSalaryController::class)->group(function(){
Route::get('empsalary/view','EmployeeSalaryView')->name('acc.empsalary.view');
Route::get('empsalary/add/edit','EmployeeSalaryAddEdit')->name('acc.empsalary.addedit');
Route::get('empsalary/delete/{id}','EmployeeSalaryDelete')->name('acc.empsalary.delete');
Route::post('empsalary/save','EmployeeSalarySave')->name('acc.empsalary.save');
Route::get('empsalary/getemployee','GetEmployeeSalaryJosn')->name('acc.empsalary.getemployeejosn');
});
//End of Account Salary Controller
//Other Cost conttoller
Route::controller(OtherCostController::class)->group(function(){
Route::get('cost/view','ViewCost')->name('cost.view');
Route::get('cost/create','CreateCost')->name('cost.create');
Route::post('cost/save','SaveCost')->name('cost.save');
Route::get('cost/edit/{id}','EditCost')->name('cost.edit');
Route::post('cost/update/{id}','UpdateCost')->name('cost.update');
Route::get('cost/delete/{id}','DeleteCost')->name('cost.delete');
});
//end of other Controller

});
//end of Account Management prefix



});//end of Auth Middleware

