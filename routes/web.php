<?php

use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\FileController;
use App\Http\Controllers\admin\GuidelineController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SubmissionController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\TeamMemberController;
use App\Http\Controllers\DashbordController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('index', [DashbordController::class, 'index'])->name('index');
    Route::get('/file', [FileController::class, 'index'])->name('file');

    Route::prefix('book')->name('book.')->group(function () {
        Route::get('index', [BookController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [BookController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{book_id}', [BookController::class, 'edit'])->name('edit');
        Route::get('del/{book_id}', [BookController::class, 'del'])->name('del');
        Route::get('list', [BookController::class, 'list'])->name('list');
    });
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('index', [TeamController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [TeamController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{team_id}', [TeamController::class, 'edit'])->name('edit');
        Route::get('del/{team_id}', [TeamController::class, 'del'])->name('del');
        Route::get('list', [TeamController::class, 'list'])->name('list');
        Route::prefix('team_member')->name('team_member.')->group(function () {
            Route::get('index/{team_id}', [TeamMemberController::class, 'index'])->name('index');
            Route::match(['GET', 'POST'], 'add/{team_id}', [TeamMemberController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{team_id}/{team_member_id}', [TeamMemberController::class, 'edit'])->name('edit');
            Route::get('del/{team_member_id}', [TeamMemberController::class, 'del'])->name('del');
            Route::get('list/{team_id}', [TeamMemberController::class, 'list'])->name('list');
        });
    });
    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('index', [SubmissionController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [SubmissionController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{sub_id}', [SubmissionController::class, 'edit'])->name('edit');
        Route::get('del/{sub_id}', [SubmissionController::class, 'del'])->name('del');
        Route::get('list', [SubmissionController::class, 'list'])->name('list');
    });
    Route::prefix('guideline')->name('guideline.')->group(function () {
        Route::get('index', [GuidelineController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [GuidelineController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{guideline_id}', [GuidelineController::class, 'edit'])->name('edit');
        Route::get('del/{guideline_id}', [GuidelineController::class, 'del'])->name('del');
        Route::get('list', [GuidelineController::class, 'list'])->name('list');
    });
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('index', [FaqController::class, 'index'])->name('index');
        Route::match(['POST'], 'add', [FaqController::class, 'add'])->name('add');
        Route::match(['POST'], 'edit/{faq_id}', [FaqController::class, 'edit'])->name('edit');
        Route::get('del/{faq_id}', [FaqController::class, 'del'])->name('del');
    });
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('index',[SettingController::class,'index'])->name('index');
        Route::prefix('policy')->name('policy.')->group(function () {
            Route::get('policy_index', [SettingController::class, 'policy_index'])->name('policy_index');
            Route::match(['POST'], 'policy_add', [SettingController::class, 'policy_add'])->name('policy_add');
            Route::match(['POST'], 'policy_edit/{policy_id}', [SettingController::class, 'policy_edit'])->name('policy_edit');
            Route::get('policy_del/{policy_id}', [SettingController::class, 'policy_del'])->name('policy_del');
        });
        Route::prefix('about')->name('about.')->group(function () {
            Route::get('about_index', [SettingController::class, 'about_index'])->name('about_index');
            Route::match(['POST'], 'about_add', [SettingController::class, 'about_add'])->name('about_add');
            Route::match(['POST'], 'about_edit/{about_id}', [SettingController::class, 'about_edit'])->name('about_edit');
            Route::get('about_del/{about_id}', [SettingController::class, 'about_del'])->name('about_del');
        });
        Route::prefix('contact')->name('contact.')->group(function(){
            Route::match(['GET','POST'],'index',[ContactController::class,'index'])->name('index');
            Route::get('del/{contact_id}',[ContactController::class,'del'])->name('del');
        });
    });
});
