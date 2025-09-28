<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FrontController;

use App\Http\Controllers\MainsController;
use App\Http\Controllers\NavbarsController;
use App\Http\Controllers\Section1sController;
use App\Http\Controllers\Section2sController;
use App\Http\Controllers\Section2_imgsController;
use App\Http\Controllers\Section3sController;
use App\Http\Controllers\Section3_categoriesController;
use App\Http\Controllers\Section3_category_imagesController;
use App\Http\Controllers\Section4sController;
use App\Http\Controllers\Section4_imagesController;
use App\Http\Controllers\Section5sController;
use App\Http\Controllers\Section5_tablasController;
use App\Http\Controllers\Section6sController;
use App\Http\Controllers\Social_networksController;
use App\Http\Controllers\FootersController;
use App\Http\Controllers\Front_previewsController;

use App\Http\Controllers\SendEmailController;

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

Route::get('/', [
    App\Http\Controllers\AgenceController::class,
    'conDesempenho',
]);

Route::get('/con_desempenho', [
    App\Http\Controllers\AgenceController::class,
    'conDesempenho',
])->name('conDesempenho');

Route::post('/relatorio', [
    App\Http\Controllers\AgenceController::class,
    'relatorio',
])->name('relatorio');

Route::post('/con_desem_consultor_rel', [
    App\Http\Controllers\AgenceController::class,
    'con_desem_consultor_rel',
]);

Auth::routes();

Route::get('/admin/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::resource('front', FrontController::class);

Route::resource('/admin/main', MainsController::class);
Route::resource('/admin/navbar', NavbarsController::class);
Route::resource('/admin/section1', Section1sController::class);
Route::resource('/admin/section2', Section2sController::class);
Route::resource('/admin/section2_img', Section2_imgsController::class);
Route::resource('/admin/section3', Section3sController::class);
Route::resource(
    '/admin/section3_categories',
    Section3_categoriesController::class
);
Route::resource(
    '/admin/section3_category_images',
    Section3_category_imagesController::class
);
Route::resource('/admin/section4', Section4sController::class);
Route::resource('/admin/section4_images', Section4_imagesController::class);
Route::resource('/admin/section5', Section5sController::class);
Route::resource('/admin/section5_tabla', Section5_tablasController::class);
Route::resource('/admin/section6', Section6sController::class);
Route::resource('/admin/social_network', Social_networksController::class);
Route::resource('/admin/footer', FootersController::class);
Route::resource('/admin/front_preview', Front_previewsController::class);

Route::get('/admin/change-password', [
    App\Http\Controllers\HomeController::class,
    'changePassword',
])->name('change-password');
Route::post('/admin/change-password', [
    App\Http\Controllers\HomeController::class,
    'updatePassword',
])->name('update-password');

Route::get('/admin/change-user', [
    App\Http\Controllers\HomeController::class,
    'changeUser',
])->name('change-user');
Route::post('/admin/change-user', [
    App\Http\Controllers\HomeController::class,
    'updateUser',
])->name('update-user');

Route::post('send-email', [
    App\Http\Controllers\SendEmailController::class,
    'index',
])->name('send-email');

/* Route::post('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('meherreralab@gmail.com')->send(new \App\Mail\NotifyMail($details));
   
    dd("Email is Sent.");
})->name('send-email'); */
