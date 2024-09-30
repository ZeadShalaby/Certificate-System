<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackAlertNotification;
use App\Http\Controllers\CertficateController;
use App\Http\Controllers\NotificationController;

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

//?start//
Route::middleware('locale')->group(function () {

    // ?todo login & register $logout users 
    Route::get('/regist', [UserController::class, 'registerIndex'])->name('registindex');
    Route::get('/login', [UserController::class, 'loginIndex'])->name('loginindex');
    Route::POST('/login/check', [UserController::class, 'login'])->name('login');
    Route::POST('/regist/create', [UserController::class, 'register'])->name('register');
    Route::get('/login/checklogin', function () {
        redirect(route('logout'));
    });


    // ?todo you must be auth and verify your email
    Route::middleware(['auth', 'verified'])->group(function () {

        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
        // ?todo generate code and send certficate to user mail
        Route::get('/generateQRCode', [CertficateController::class, 'generateQrCode'])->name('generate.QRCode');
        // ?todo Excel routes
        Route::get('/excel', [ExcelController::class, 'index'])->name('excel.index');
        Route::POST('/excel/upload', [ExcelController::class, 'uploadExcel'])->name('excel.upload');
    });
});

Route::get('/lang/{lang}', [LanguageController::class, 'change'])->name('lang.change');
Route::get('/verfiyemail/{user}', [UserController::class, 'verfiy'])->name('verify.email');

//? todo show certificate
Route::get('/certificate/{certificate}', [CertficateController::class, 'show'])->name('certificate.show');

// ? todo notification as read
Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');


// ? test notification
Route::get('/send-alert', function () {
    $users = User::all(); // Or use a specific user
    Notification::send($users, new SlackAlertNotification());
    return 'Alert sent!';
});
