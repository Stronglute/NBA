<?php

use App\Http\Controllers\CapOptionController;
use App\Http\Controllers\CapProductionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndividualPartyController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\PartyMainController;
use App\Http\Controllers\VendorMainController;
use Illuminate\Support\Facades\Auth;
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
// START ROUTE
Route::get('/', function () {
    return view('auth/login');
});

//AUTH ROUTE
Auth::routes();

// HOME CONTROLLER ROUTE
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::view('/Reg', 'auth.register')->middleware('is_admin');
// PARTY MAIN ROUTES
Route::view('/partymainpage', 'PartyMain');
Route::get('/partymaininfo', [PartyMainController::class, 'show']);
Route::post('/partymainstore', [PartyMainController::class, 'store']);
Route::delete('/partymaindelete/{id}', [PartyMainController::class, "destroy"]);
Route::get('/partymainedit/{id}', [PartyMainController::class, 'edit']);
// PARTIES ROUTES
Route::view('/partylist', 'Parties');
Route::get('/showparty', [PartiesController::class, 'index']);
Route::post('/storeparty', [PartiesController::class, 'store']);
Route::get('/editparty/{id}', [PartiesController::class, 'edit']);
Route::delete('/deleteparty/{id}', [PartiesController::class, 'destroy']);
//INDIVIDUAL PARTY ROUTES
Route::get('/ipartyshow/{name}', [IndividualPartyController::class, 'show']);
Route::get('/ipshowpage/{name}', function ($name) {
    return view('individualparty', ['name' => $name]);
});
// CAP PRODUCTION ROUTE
Route::view('/cappage', 'CapProduction');
Route::get('/capinfo', [CapProductionController::class, 'show']);
Route::post('/capinfostore', [CapProductionController::class, 'store']);
Route::delete('/capinfodelete/{id}', [CapProductionController::class, "destroy"]);
Route::get('/capinfoedit/{id}', [CapProductionController::class, 'edit']);
// CAP OPTION ROUTE
Route::view('/capoptpage', 'CapOption');
Route::get('/capopt/{description}', [CapOptionController::class, 'row']);
Route::get('/capoptinfo', [CapOptionController::class, 'show']);
Route::post('/capoptinfostore', [CapOptionController::class, 'store']);
Route::delete('/capoptinfodelete/{id}', [CapOptionController::class, "destroy"]);
Route::get('/capoptinfoedit/{id}', [CapOptionController::class, 'edit']);
// VENDOR MAIN ROUTES
Route::view('/vendormainpage', 'VendorMain');
Route::get('/vendormaininfo', [VendorMainController::class, 'show']);
Route::post('/vendormainstore', [VendorMainController::class, 'store']);
Route::delete('/vendormaindelete/{id}', [VendorMainController::class, "destroy"]);
Route::get('/vendormainedit/{id}', [VendorMainController::class, 'edit']);
// ITEMS PAGES
Route::view('/itempage', 'Item');
Route::get('/iteminfo', [ItemController::class, 'show']);
Route::post('/itemstore', [ItemController::class, 'store']);
Route::delete('/itemdelete/{id}', [ItemController::class, "destroy"]);
Route::get('/itemedit/{id}', [ItemController::class, 'edit']);
