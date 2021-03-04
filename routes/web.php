<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\backend\setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Report\ResultReportController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\backend\setup\SchoolSubjectController;
use App\Http\Controllers\backend\student\StudentRollController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Report\AttendanceReportController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\employee\EmployeeAttendanceController;


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

Route::group(['middleware' => 'prevent-back-history'],function(){





Route::get('/', function () {
    return view('admin.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {


    // User Management All Routes
    Route::prefix('users')->group(function () {
        Route::get('view', [UserController::class, 'userView'])->name('user.view');

        Route::get('add', [UserController::class, 'userAdd'])->name('user.add');

        Route::post('store', [UserController::class, 'userStore'])->name('user.store');

        Route::get('edit/{id}', [UserController::class, 'userEdit'])->name('user.edit');

        Route::patch('update/{id}', [UserController::class, 'userUpdate'])->name('user.update');

        Route::get('delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');

    });

    // User Profile and Change Password  Management All Routes
    Route::prefix('profile')->group(function () {
        Route::get('view', [ProfileController::class, 'profileView'])->name('profile.view');

        Route::get('edit', [ProfileController::class, 'profileEdit'])->name('profile.edit');

        Route::patch('store', [ProfileController::class, 'profileStore'])->name('profile.store');

        Route::get('password/view', [ProfileController::class, 'passwordView'])->name('password.view');

        Route::post('password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');



    });


    // User Profile and Change Password  Management All Routes
    Route::prefix('setups')->group(function () {

        // Student Class Routes
        Route::get('student/class/view', [StudentClassController::class, 'viewStudent'])->name('student.class.view');

        Route::get('student/class/add', [StudentClassController::class, 'studentClassAdd'])->name('student.class.add');

        Route::post('student/class/store', [StudentClassController::class, 'studentClassStore'])->name('store.student.class');

        Route::get('student/class/edit/{id}', [StudentClassController::class, 'studentClassEdit'])->name('student.class.edit');

        Route::post('student/class/update/{id}', [StudentClassController::class, 'studentClassUpdate'])->name('update.student.class');

        Route::get('student/class/delete/{id}', [StudentClassController::class, 'studentClassDelete'])->name('student.class.delete');

        // Student Year Routes
        Route::get('student/year/view', [StudentYearController::class, 'viewYear'])->name('student.year.view');

        Route::get('student/year/add', [StudentYearController::class, 'addYear'])->name('student.year.add');

        Route::post('student/year/store', [StudentYearController::class, 'storeYear'])->name('store.student.year');

        Route::get('student/year/edit/{id}', [StudentYearController::class, 'editYear'])->name('student.year.edit');

        Route::post('student/year/update/{id}', [StudentYearController::class, 'updateYear'])->name('update.student.year');

        Route::get('student/year/delete/{id}', [StudentYearController::class, 'deleteYear'])->name('student.year.delete');


        // Student Group Routes
        Route::get('student/group/view', [StudentGroupController::class, 'viewGroup'])->name('student.group.view');

        Route::get('student/group/add', [StudentGroupController::class, 'addGroup'])->name('student.group.add');

        Route::post('student/group/store', [StudentGroupController::class, 'storeGroup'])->name('store.student.group');

        Route::get('student/group/edit/{id}', [StudentGroupController::class, 'editGroup'])->name('student.group.edit');

        Route::post('student/group/update/{id}', [StudentGroupController::class, 'updateGroup'])->name('update.student.group');

        Route::get('student/group/delete/{id}', [StudentGroupController::class, 'deleteGroup'])->name('student.group.delete');


        // Student Shift Routes
        Route::get('student/shift/view', [StudentShiftController::class, 'viewShift'])->name('student.shift.view');

        Route::get('student/shift/add', [StudentShiftController::class, 'addShift'])->name('student.shift.add');

        Route::post('student/shift/store', [StudentShiftController::class, 'storeShift'])->name('store.student.shift');

        Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'editShift'])->name('student.shift.edit');

        Route::post('student/shift/update/{id}', [StudentShiftController::class, 'updateShift'])->name('update.student.shift');

        Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'deleteShift'])->name('student.shift.delete');


        // Fee Category Routes
        Route::get('fee/category/view', [FeeCategoryController::class, 'view'])->name('fee.category.view');

        Route::get('fee/category/add', [FeeCategoryController::class, 'add'])->name('fee.category.add');

        Route::post('fee/category/store', [FeeCategoryController::class, 'store'])->name('fee.category.store');

        Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'edit'])->name('fee.category.edit');

        Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'update'])->name('fee.category.update');

        Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'delete'])->name('fee.category.delete');


        // Fee Category Amount Routes
        Route::get('fee/amount/view', [FeeAmountController::class, 'view'])->name('fee.amount.view');

        Route::get('fee/amount/add', [FeeAmountController::class, 'add'])->name('fee.amount.add');

        Route::post('fee/amount/store', [FeeAmountController::class, 'store'])->name('fee.amount.store');

        Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'edit'])->name('fee.amount.edit');

        Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'update'])->name('fee.amount.update');

        Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'details'])->name('fee.amount.details');


        // Exam Type Routes
        Route::get('exam/type/view', [ExamTypeController::class, 'view'])->name('exam.type.view');

        Route::get('exam/type/add', [ExamTypeController::class, 'add'])->name('exam.type.add');

        Route::post('exam/type/store', [ExamTypeController::class, 'store'])->name('exam.type.store');

        Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'edit'])->name('exam.type.edit');

        Route::post('exam/type/update/{id}', [ExamTypeController::class, 'update'])->name('exam.type.update');

        Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'delete'])->name('exam.type.delete');


        // School Subject Routes
        Route::get('school/subject/view', [SchoolSubjectController::class, 'view'])->name('school.subject.view');

        Route::get('school/subject/add', [SchoolSubjectController::class, 'add'])->name('school.subject.add');

        Route::post('school/subject/store', [SchoolSubjectController::class, 'store'])->name('school.subject.store');

        Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'edit'])->name('school.subject.edit');

        Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'update'])->name('school.subject.update');

        Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'delete'])->name('school.subject.delete');

        // Assign Subject Routes
        Route::get('assign/subject/view', [AssignSubjectController::class, 'view'])->name('assign.subject.view');

        Route::get('assign/subject/add', [AssignSubjectController::class, 'add'])->name('assign.subject.add');

        Route::post('assign/subject/store', [AssignSubjectController::class, 'store'])->name('assign.subject.store');

        Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'edit'])->name('assign.subject.edit');

        Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'update'])->name('assign.subject.update');

        Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'details'])->name('assign.subject.details');



        // Designation Routes
        Route::get('designation/view', [DesignationController::class, 'view'])->name('designation.view');

        Route::get('designation/add', [DesignationController::class, 'add'])->name('designation.add');

        Route::post('designation/store', [DesignationController::class, 'store'])->name('designation.store');

        Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');

        Route::post('designation/update/{id}', [DesignationController::class, 'update'])->name('designation.update');

        Route::get('designation/delete/{id}', [DesignationController::class, 'delete'])->name('designation.delete');
    });


    // User Management All Routes
    Route::prefix('students')->group(function () {
        Route::get('reg/view', [StudentRegController::class, 'view'])->name('student.registration.view');

        Route::get('reg/add', [StudentRegController::class, 'add'])->name('student.registration.add');

        Route::post('reg/store', [StudentRegController::class, 'store'])->name('student.registration.store');

        Route::get('year/class/wise/', [StudentRegController::class, 'classYearWise'])->name('student.year.class.wise');

        Route::get('reg/edit/{student_id}', [StudentRegController::class, 'edit'])->name('student.registration.edit');

        Route::patch('reg/update/{student_id}', [StudentRegController::class, 'update'])->name('student.registration.update');

        Route::get('reg/promotion/{student_id}', [StudentRegController::class, 'promotion'])->name('student.registration.promotion');

        Route::patch('reg/promotion/{student_id}', [StudentRegController::class, 'promote'])->name('student.registration.promote');

        Route::get('reg/details/{student_id}', [StudentRegController::class, 'details'])->name('student.registration.details');
        // Route::get('delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');


        // Student Roll Generate Route
        Route::get('roll/generate/view', [StudentRollController::class, 'view'])->name('roll.generate.view');

        Route::get('reg/getStudents', [StudentRollController::class, 'getStudents'])->name('student.registration.getStudents');

        Route::post('roll/generate/store', [StudentRollController::class, 'store'])->name('roll.generate.store');

        // Registration Fee Route
        Route::get('registration/fee/view', [RegistrationFeeController::class, 'view'])->name('registration.fee.view');

        Route::get('registration/fee/classWiseData', [RegistrationFeeController::class, 'RegistrationFeeClassData'])->name('student.registration.fee.classWise');

        Route::get('registration/fee/payslip', [RegistrationFeeController::class, 'paySlip'])->name('student.registration.fee.payslip');


        // Monthly Fee Route
        Route::get('monthly/fee/view', [MonthlyFeeController::class, 'view'])->name('monthly.fee.view');

        Route::get('monthly/fee/classWiseData', [MonthlyFeeController::class, 'monthlyFeeClassData'])->name('student.monthly.fee.classWise');

        Route::get('monthly/fee/payslip', [MonthlyFeeController::class, 'paySlip'])->name('student.monthly.fee.payslip');


        // exam Fee Route
        Route::get('exam/fee/view', [ExamFeeController::class, 'view'])->name('exam.fee.view');

        Route::get('exam/fee/classWiseData', [ExamFeeController::class, 'examFeeClassData'])->name('student.exam.fee.classWise');

        Route::get('exam/fee/payslip', [ExamFeeController::class, 'paySlip'])->name('student.exam.fee.payslip');
    });

    // Employee Management All Routes
    Route::prefix('employees')->group(function () {

        // Employee Registration All Routes
        Route::get('reg/view', [EmployeeRegController::class, 'view'])->name('employee.registration.view');

        Route::get('reg/add', [EmployeeRegController::class, 'add'])->name('employee.registration.add');

        Route::post('reg/store', [EmployeeRegController::class, 'store'])->name('employee.registration.store');

        Route::get('reg/employee/edit{id}', [EmployeeRegController::class, 'edit'])->name('employee.registration.edit');

        Route::patch('reg/employee/update/{id}', [EmployeeRegController::class, 'update'])->name('employee.registration.update');

        Route::get('reg/employee/details/{id}', [EmployeeRegController::class, 'details'])->name('employee.registration.details');

        // Employee Salary All Routes
        Route::get('salary/employee/view', [EmployeeSalaryController::class, 'view'])->name('employee.salary.view');

        Route::get('salary/employee/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');

        Route::post('salary/employee/store/{id}', [EmployeeSalaryController::class, 'store'])->name('update.increment.store');

        Route::get('salary/employee/details/{id}', [EmployeeSalaryController::class, 'details'])->name('employee.salary.details');


        // Employee Leave All Routes
        Route::get('leave/employee/view', [EmployeeLeaveController::class, 'view'])->name('employee.leave.view');

        Route::get('leave/employee/add', [EmployeeLeaveController::class, 'add'])->name('employee.leave.add');

        Route::post('leave/employee/store', [EmployeeLeaveController::class, 'store'])->name('employee.leave.store');

        Route::get('leave/employee/edit/{id}', [EmployeeLeaveController::class, 'edit'])->name('employee.leave.edit');

        Route::patch('leave/employee/update/{id}', [EmployeeLeaveController::class, 'update'])->name('employee.leave.update');

        Route::get('leave/employee/delete/{id}', [EmployeeLeaveController::class, 'delete'])->name('employee.leave.delete');


        // Employee Leave All Routes
        Route::get('attendance/employee/view', [EmployeeAttendanceController::class, 'view'])->name('employee.attendance.view');

        Route::get('attendance/employee/add', [EmployeeAttendanceController::class, 'add'])->name('employee.attendance.add');

        Route::post('attendance/employee/store', [EmployeeAttendanceController::class, 'store'])->name('employee.attendance.store');

        Route::get('attendance/employee/edit/{date}', [EmployeeAttendanceController::class, 'edit'])->name('employee.attendance.edit');

        Route::get('attendance/employee/details/{date}', [EmployeeAttendanceController::class, 'details'])->name('employee.attendance.details');


        // Employee Leave All Routes
        Route::get('monthly/salary/view', [MonthlySalaryController::class, 'view'])->name('monthly.salary.view');

        Route::get('monthly/salary/get', [MonthlySalaryController::class, 'monthlySalaryGet'])->name('employee.monthly.salary.get');

        Route::get('monthly/salary/paySlip/{employee_id}', [MonthlySalaryController::class, 'monthlySalaryPaySlip'])->name('employee.monthly.salary.paySlip');

    });

    // Marks Management All Routes
    Route::prefix('marks')->group(function () {

        Route::get('marks/entry/add', [MarksController::class, 'marksAdd'])->name('marks.entry.view');

        Route::post('marks/entry/store', [MarksController::class, 'marksStore'])->name('marks.entry.store');

        Route::get('marks/entry/edit', [MarksController::class, 'edit'])->name('marks.entry.edit');

        Route::get('marks/getStudents/edit', [MarksController::class, 'marksEditGetStudents'])->name('student.edit.getStudents');

        Route::post('marks/entry/update', [MarksController::class, 'marksUpdate'])->name('marks.entry.update');


        // Mark Entry Grade
        Route::get('marks/grade/view', [GradeController::class, 'view'])->name('marks.entry.grade');

        Route::get('marks/grade/add', [GradeController::class, 'add'])->name('marks.grade.add');

        Route::post('marks/grade/store', [GradeController::class, 'store'])->name('marks.grade.store');

        Route::get('marks/grade/edit/{id}', [GradeController::class, 'edit'])->name('marks.grade.edit');

        Route::patch('marks/grade/update/{id}', [GradeController::class, 'update'])->name('marks.grade.update');


    }); // End Of Marks Management All Routes

    Route::get('marks/getSubject', [DefaultController::class, 'getSubject'])->name('marks.getSubject');

    Route::get('student/marks/getStudents', [DefaultController::class, 'getStudents'])->name('student.marks.getStudents');



    // Accounts Management All Routes
    Route::prefix('accounts')->group(function () {

        Route::get('student/fee/view', [StudentFeeController::class, 'view'])->name('student.fee.view');

        Route::get('student/fee/add', [StudentFeeController::class, 'add'])->name('student.fee.add');

        Route::get('account.fee.getStudent', [StudentFeeController::class, 'getStudent'])->name('account.fee.getStudent');


        Route::post('student/fee/store', [StudentFeeController::class, 'store'])->name('student.fee.store');

        // Employee Salary All Routes
        Route::get('account/salary/view', [AccountSalaryController::class, 'view'])->name('account.salary.view');

        Route::get('account/salary/add', [AccountSalaryController::class, 'add'])->name('account.salary.add');

        Route::get('account/salary/getEmployee', [AccountSalaryController::class, 'getEmployee'])->name('account.salary.getEmployee');

        Route::post('account/salary/store', [AccountSalaryController::class, 'store'])->name('account.salary.store');

        // Other Cost All Routes
        Route::get('other/cost/view', [OtherCostController::class, 'view'])->name('other.cost.view');

        Route::get('other/cost/add', [OtherCostController::class, 'add'])->name('other.cost.add');

        Route::post('other/cost/store', [OtherCostController::class, 'store'])->name('other.cost.store');

        Route::get('other/cost/edit/{id}', [OtherCostController::class, 'edit'])->name('other.cost.edit');

        Route::patch('other/cost/update/{id}', [OtherCostController::class, 'update'])->name('other.cost.update');

    });

    // Reports Management All Routes
    Route::prefix('reports')->group(function () {

        Route::get('monthly/profit/view', [ProfitController::class, 'monthlyProfitView'])->name('monthly.profit.view');

        Route::get('monthly/profit/dateWise', [ProfitController::class, 'monthlyProfitDateWise'])->name('monthly.profit.dateWise');

        Route::get('report/profit/pdf', [ProfitController::class, 'monthlyProfitPDF'])->name('report.profit.pdf');



        // MarkSheet Generate View All Routes
        Route::get('markSheet/generate/view', [MarkSheetController::class, 'view'])->name('markSheet.generate.view');

        Route::get('markSheet/generate/get', [MarkSheetController::class, 'markSheetGet'])->name('report.markSheet.get');

        // Attendance report All Routes
        Route::get('attendance/report/view', [AttendanceReportController::class, 'view'])->name('attendance.report.view');

        Route::get('report/attendance/get', [AttendanceReportController::class, 'get'])->name('report.attendance.get');



        // Student Result All Routes
        Route::get('student/result/view', [ResultReportController::class, 'view'])->name('student.result.view');

        Route::get('report/student/result/get', [ResultReportController::class, 'get'])->name('report.student.result.get');


        // Student ID Card All Routes
        Route::get('student/IDCard/view', [ResultReportController::class, 'IDCardView'])->name('student.IDCard.view');

        Route::get('student/IDCard/get', [ResultReportController::class, 'IDCardGet'])->name('report.student.IDCard.get');
    });


}); // End Of Middleware Authentication

}); //prevent back history Middleware
