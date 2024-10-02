<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.dashboard');
// });

Route::get('/dashboard', [StaffController::class,'all_data'])->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Staff Routes

    Route::get('/staff-show' , [StaffController::class,'show_staff'])->name('show-staff');
    Route::get('/add-staff' , [StaffController::class,'add_staff'])->name('add-staff');
    Route::post('/store-staff' , [StaffController::class,'store_staff'])->name('store-staff');
    Route::post('/edit-store-staff' , [StaffController::class,'edit_store_staff'])->name('edit-store-staff');
    Route::get('/edit-staff/{id}' , [StaffController::class,'edit_staff'])->name('edit-staff');
    Route::get('/delete-staff/{id}' , [StaffController::class,'delete_staff'])->name('delete-staff');
    Route::post('/exelfile-staff' , [StaffController::class,'exel_staff'])->name('staff-exel');




    // Task Controller


 
    Route::get('/task-show' , [TaskController::class,'show_task'])->name('show-task');
    Route::get('/add-task' , [taskController::class,'add_task'])->name('add-task');
    Route::post('/store-task' , [taskController::class,'store_task'])->name('store-task');
    Route::post('/edit-store-task' , [taskController::class,'edit_store_task'])->name('edit-store-task');
    Route::get('/edit-task/{id}' , [taskController::class,'edit_task'])->name('edit-task');
    Route::get('/delete-task/{id}' , [taskController::class,'delete_task'])->name('delete-task');
    Route::post('/exelfile' , [taskController::class,'exel_task'])->name('exel-task');






});

require __DIR__.'/auth.php';
