<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\KeyDetailController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PropertyFormController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DholeraInvestmentController;
use App\Http\Controllers\AhmadabadInvestmentController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\DeveloperContactFormController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BrochureFormController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoContentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource(name: 'developers', controller: DeveloperController::class);

//Auth
Route::post('login', action: [AuthController::class, 'login']);
Route::post('register', action: [AuthController::class, 'registerUser']);

//property-types
Route::get('property-types', [PropertyTypeController::class, 'index']);
Route::post('property-types', [PropertyTypeController::class, 'store']);
Route::get('property-types/{route}', [PropertyTypeController::class, 'showByRoute']);
Route::delete('property-types/{route}', [PropertyTypeController::class, 'destroy']);
Route::patch('property-types/{route}', [PropertyTypeController::class, 'update']);

//Amenities
Route::apiResource(name: 'amenities', controller: AmenityController::class);

//key details

Route::get('key-details', action: [KeyDetailController::class, 'index']);       // Get all key details
Route::get('key-details/{id}', [KeyDetailController::class, 'show']);   // Get a single key detail
Route::post('key-details', [KeyDetailController::class, 'store']);      // Add a key detail
Route::put('key-details/{id}', [KeyDetailController::class, 'update']); // Update a key detail
Route::delete('key-details/{id}', [KeyDetailController::class, 'destroy']); // Delete a key detail

// Zone
Route::apiResource(name: 'zones', controller: ZoneController::class);
Route::get('zones-with-locations', [ZoneController::class, 'getAllZonesWithLocations']);
Route::get('zone/{route}', [ZoneController::class, 'getZoneByRoute']);

//location
Route::apiResource('locations', controller: LocationController::class);

//project
Route::apiResource(name: 'projects', controller: ProjectController::class);
Route::post('projects', [ProjectController::class, 'store']); // Delete a key detail

//FAQs
Route::get('/faqs', [FAQController::class, 'index']); // Get all FAQs
Route::get('/faqs/{id}', [FAQController::class, 'show']); // Get single FAQ
Route::post('/faqs', [FAQController::class, 'store']); // Create FAQ
Route::put('/faqs/{id}', [FAQController::class, 'update']); // Update FAQ
Route::delete('/faqs/{id}', [FAQController::class, 'destroy']); // Delete FAQ

//
Route::apiResource(name: '/forms', controller: FormController::class);
//property form
Route::apiResource('/property-form', controller: PropertyFormController::class,);

//developer contact form
Route::apiResource(name: '/developer-contact-form', controller: DeveloperContactFormController::class);

//Developer
Route::post('/developers', [DeveloperController::class, 'store']);
Route::get('/developers/{id?}', [DeveloperController::class, 'show']);
Route::put('/developers/{id}', [DeveloperController::class, 'update']);
Route::delete('/developers/{id}', [DeveloperController::class, 'destroy']);

//Gallery
Route::apiResource('galleries', GalleryController::class);
//blogs
Route::apiResource('blogs', BlogController::class);

//testimonials

Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::get('/testimonials/{id}', [TestimonialController::class, 'show']);
Route::post('/testimonials', [TestimonialController::class, 'store']);
Route::put('/testimonials/{id}', [TestimonialController::class, 'update']);
Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy']);


//brochure
// Route::get('/brochure-forms', [BrochureFormController::class, 'index']);
// Route::post('/brochure-forms', [BrochureFormController::class, 'store']);

Route::apiResource('brochure-forms', controller: BrochureFormController::class);


//developer-contact
Route::post('/developer-contact/send-otp', [DeveloperContactFormController::class, 'sendOtp']);
Route::post('/developer-contact/verify-otp', [DeveloperContactFormController::class, 'verifyOtp']);

//Dashboard Controller
Route::get('/cards', [DashboardController::class, 'getDashboardData']);

//About us
Route::apiResource('/site-info', SiteInfoController::class);

//zones By location
Route::apiResource('/zones_by_location', ZoneController::class);

//Home video
Route::apiResource('video-contents', VideoContentController::class);

//Investment
Route::apiResource('investments', InvestmentController::class);

//ahmadabad-investment
Route::post('/ahmadabad-investment', [AhmadabadInvestmentController::class, 'store']);    // Create
Route::get('/ahmadabad-investment', [AhmadabadInvestmentController::class, 'index']);     // Read All
Route::get('/ahmadabad-investment/{id}', [AhmadabadInvestmentController::class, 'show']); // Read Single
Route::patch('/ahmadabad-investment/{id}', [AhmadabadInvestmentController::class, 'update']); // Update
Route::delete('/ahmadabad-investment/{id}', [AhmadabadInvestmentController::class, 'destroy']); // Delete

//dholera-investments
Route::get('/dholera-investments', [DholeraInvestmentController::class, 'index']);
Route::get('/dholera-investments/{id}', [DholeraInvestmentController::class, 'show']);
Route::post('/dholera-investments', [DholeraInvestmentController::class, 'store']);
Route::patch('/dholera-investments/{id}', [DholeraInvestmentController::class, 'update']);
Route::delete('/dholera-investments/{id}', [DholeraInvestmentController::class, 'destroy']);

//pages
Route::get('/pages', action: [PageController::class, 'index']);
Route::get('/pages/{route}', [PageController::class, 'show']);
Route::post('/pages', [PageController::class, 'store']);
Route::patch('/pages/{id}', [PageController::class, 'update']);
Route::delete('/pages/{id}', [PageController::class, 'destroy']);

Route::prefix(prefix: 'credentials')->group(function () {
    Route::get('/', [CredentialController::class, 'index']); // Get all credentials
    Route::get('/{id}', [CredentialController::class, 'show']); // Get a single credential
    Route::post('/', [CredentialController::class, 'store']); // Create a credential
    Route::put('/{id}', [CredentialController::class, 'update']); // Update a credential
    Route::delete('/{id}', [CredentialController::class, 'destroy']); // Delete a credential
});