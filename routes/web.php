<?php

use App\Http\Controllers\ContractsController;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/', function () {
        return view('dashboard');})->name('home');
    
    Route::get('contracts/pendingSignature', [ContractsController::class, 'pendingSignature'])->name('contracts.pendingSignature');
    
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
    
    Route::get('/contracts', function () {
        return view('contracts.index');})->name('contracts.index');
    
    Route::get('/contracts/create/{id}', function ($id) {
        if($id === 'blank') {
            return view('contracts.blank');
        } else {
            return view('contracts.create',['id' => $id]);
        }
    })->name('contracts.create');
    
    Route::get('/contracts/status/{id}', function ($id) {
        return view('contracts.status',['id' => $id]);})->name('contracts.status');
    
    Route::get('/received/{id}', [ContractsController::class, 'show'])->name('received.show');
    
    Route::get('/templates', function () {
        return view('templates.index');})->name('templates.index');
    
    Route::get('/templates/create', function () {
        return view('templates.create');})->name('templates.create');
    
    Route::get('/templates/{id}/edit', function ($id) {
        return view('templates.edit',['id' => $id]);})->name('templates.edit');
    
    Route::get('/received', function () {
        return view('received.index');})->name('received.index');
     
    Route::get('/contracts/blank ', function () {
        return view('contracts.blank');})->name('contracts.blank');
});