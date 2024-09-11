<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'studentRegiter'])->name('studentRegister');

Route::get('/login',function(){
 return redirect('/');
});
Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'userLogin'])->name('userLogin');
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/forget-password',[AuthController::class,'forgetPasswordLoad']);
Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');
Route::get('/reset-password',[AuthController::class,'resetPasswordLoad']);
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('resetPassword');
Route::group(['middleware'=>['web','checkAdmin']],function(){
Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);

    //subjects route
    Route::post('/add-subject',[AdminController::class,'addSubject'])->name('addSubject');
    Route::post('/edit-subject',[AdminController::class,'editSubject'])->name('editSubject');
    Route::post('/delete-subject',[AdminController::class,'deleteSubject'])->name('deleteSubject');
    //exams route
    Route::get('/admin/exam',[AdminController::class,'examDashboard']);
    Route::post('/add-exam',[AdminController::class,'addExam'])->name('addExam');
    Route::get('/get-exam-detail/{id}',[AdminController::class,'getExamDetail'])->name('getExamDetail');
    Route::post('/update-exam',[AdminController::class,'updateExam'])->name('updateExam');
    Route::post('/delete-exam',[AdminController::class,'deleteExam'])->name('deleteExam');
    //Q&A Route
    Route::get('/admin/qnans',[AdminController::class,'qnDashboard']);
    Route::post('/admin/qnans',[AdminController::class,'addQna'])->name('addQna');
    Route::get('/get-qna-details',[AdminController::class,'getQnaDetails'])->name('getQnaDetails');
    Route::get('/delete-ans',[AdminController::class,'deleteAns'])->name('deleteAns');
    Route::get('/update-qnans',[AdminController::class,'updateQna'])->name('updateQna');
    Route::post('/delete-qnans',[AdminController::class,'deleteQna'])->name('deleteQna');
    Route::post('/import/-qnans',[AdminController::class,'importQna'])->name('importQna');
    //Students Routing
    Route::get('/admin/students',[AdminController::class,'studentDashbaord']);
    Route::post('/add-student',[AdminController::class,'addStudent'])->name('addStudent');
   //qna-exam Routing
   Route::get('/get-questions',[AdminController::class,'getQuestions'])->name('getQuestions');
});
Route::group(['middleware'=>['web','checkStudent']],function(){
Route::get('/dashboard',[AuthController::class,'loadDashboard']);
});