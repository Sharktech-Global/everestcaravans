<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CareerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\NewsAndEventsController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\VehicleComparisonController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\SeoApiController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\PolicyController as ApiPolicyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Home
Route::get('/home', [HomeController::class, 'index']);

// About Us
Route::get('/about-us', [AboutController::class, 'index']);

//Faq
Route::get('/faqs', [HomeController::class, 'faq']);



// News and Events
Route::get('/news-events', [NewsAndEventsController::class, 'index']);

// General
Route::get('/general', [HomeController::class, 'general']);

//section
Route::get('/section_1', [HomeController::class, 'section']);
Route::get('/section', [SectionController::class, 'section']);

// /services
Route::get('/services', [ServiceController::class, 'index']);

//contact
Route::post('/contact-form', [ContactController::class, 'store']);


//career
Route::get('/career', [CareerController::class, 'index']);
Route::post('/career-form', [CareerController::class, 'store']);

// vehicle comparison
Route::get('/vehicle/list', [VehicleComparisonController::class, 'list']);
Route::post('/vehicle/varients', [VehicleComparisonController::class, 'varients']);
Route::post('/vehicle/list/', [VehicleComparisonController::class, 'single_list']);
Route::post('/vehicle/comparison/', [VehicleComparisonController::class, 'comparison']);
 
// vehicle search
Route::post('/vehicle/search', [VehicleController::class, 'list']);


//testimonial
Route::get('/testimonials', [TestimonialController::class, 'index']);

//Policy
Route::get('/terms', [ApiPolicyController::class, 'terms']);
Route::get('/privacy', [ApiPolicyController::class, 'privacy']);
Route::get('/cookie', [ApiPolicyController::class, 'cookie']);
Route::get('/refund', [ApiPolicyController::class, 'refund']);

//blog
Route::get('/blog', [BlogController::class, 'index']);

//seo
Route::get('/seo/{slug}',[SeoApiController::class,'index']);







