<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceCodeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSessionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function() {
//     return view('portfolio.show');
// });

Route::get('/', [EventController::class, 'index']);
Route::get('/portfolio/{user}', [PortfolioController::class, 'show']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/update-announcement-statuses', [AnnouncementController::class, 'updateStatuses']);
Route::get('/search', SearchController::class);
Route::get('/events', [EventController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/{conversation}', [MessageController::class, 'show']);
    Route::get('/overview/user', [OverviewController::class, 'index']);
    Route::delete('/logout', [SessionController::class, 'destroy']);
    Route::get('/account-settings', [RegisteredUserController::class, 'edit']);
    Route::patch('/account-settings/{user}', [RegisteredUserController::class, 'update']);
    Route::post('/messages', [MessageController::class, 'checkAndCreateConversation']);
    Route::post('/send-message', [MessageController::class, 'store']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::post('/reply', [ReplyController::class, 'store']);
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::post('/validate-post', [AnnouncementController::class, 'validatePost']);
    Route::post('/invalidate-post', [AnnouncementController::class, 'invalidatePost']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('/session', [EventSessionController::class, 'store']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{event}/{eventSession}', [EventSessionController::class, 'show']);
    Route::post('/events/{event}/{eventSession}', [EventSessionController::class, 'update']);
    Route::post('/attendance/{event}/{eventSession}/{attendanceCode}', [AttendanceCodeController::class, 'show']);
    Route::get('/attendance-codes/{eventSession}', [AttendanceCodeController::class, 'showPerSession']);
    Route::post('/attendance-codes-generator', [AttendanceCodeController::class, 'generateCodes']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store'])->name('login');
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/reset-password', [RegisteredUserController::class, 'resetPassword']);
});


Route::get('/test', function () {
    // return request()->path();
    return dd(Auth::id());
});

Route::get('/test-success', [PostController::class, 'testSuccess']);
Route::get('/test-danger', [PostController::class, 'testDanger']);
Route::get('/test-warning', [PostController::class, 'testWarning']);
Route::get('/test-multiple', [PostController::class, 'testMultiple']);
