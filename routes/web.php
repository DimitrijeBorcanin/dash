<?php

use App\Http\Livewire\Customer\CreateCustomer;
use App\Http\Livewire\Customer\ShowCustomer;
use App\Http\Livewire\Customer\ShowCustomers;
use App\Http\Livewire\Orders\Dashboard;
use App\Http\Livewire\Orders\ShowOrder;
use App\Http\Livewire\Orders\ShowProfit;
use App\Http\Livewire\Product\CreateProduct;
use App\Http\Livewire\User\ShowUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Users
    Route::get('/zaposleni', ShowUsers::class)->name('users')->middleware(['roles:1']);

    // Customers
    Route::get('/kupci', ShowCustomers::class)->name('customers')->middleware(['roles:1,2,3,5']);
    Route::get('/kupci/dodaj', CreateCustomer::class)->name('customers.create')->middleware(['roles:1,2,3,5']);
    Route::get('/kupci/{customer}', ShowCustomer::class)->name('customer')->middleware(['roles:1,2,3,5']);

    // Products
    Route::get('/kupci/{customer}/porudzbina/dodaj', CreateProduct::class)->name('products.create')->middleware(['roles:1,2,3,5']);

    // Orders
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/obracun', ShowProfit::class)->name('profit')->middleware(['roles:1']);
    Route::get('/kupci/{customer}/porudzbina/{order}', ShowOrder::class)->name('order')->middleware(['roles:1,2,3,4,5']);

    //Helpers
    if(env('APP_DEBUG')){
        Route::get('/migrate-fresh', function(){
            Artisan::call('migrate:fresh --seed');
            dd('Migrated!');
        });

        Route::get('/migrate', function(){
            Artisan::call('migrate', ["--force" => true]);
            dd('Database is fresh and seeded!');
        });

        Route::get('/clear', function(){
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            dd('Cleared!');
        });

        Route::get('/cron-test', function(){
            Artisan::call('command:instructionssent');
        });
    }
});
