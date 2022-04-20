<?php

use App\Http\Controllers\SuperheroController;
use App\Superhero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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

Route::post('/upload-content',[SuperheroController::class,'uploadContent'])
    ->name('import.content');

Route::get('/superhero', function() {
    return Superhero::all();
});

Route::get('/superhero/sort-order/{order}', function($order) {
    return SuperheroController::getOrdered($order);
});

Route::get('/superhero/sort-order/{order}/paginate/{perpage}', function($order, $perPage) {
    return SuperheroController::getOrderedPaginate($order, $perPage);
});

Route::get('/superhero/paginate/{perpage}', function($perPage) {
    return SuperheroController::getPaginate($perPage);
});

Route::get('/superhero/{property}', function($property) {
    return SuperheroController::getByProperty($property);
});

Route::get('/superhero/{property}/sort-order/{order}', function($property, $order) {
    return SuperheroController::getByPropertyOrdered($property, $order);
});

Route::get('/superhero/{property}/sort-order/{order}/paginate/{perpage}', function($property, $order, $perPage) {
    return SuperheroController::getByPropertyOrderedPaginate($property, $order, $perPage);
});

Route::get('/superhero/{property}/paginate/{perpage}', function($property, $perPage) {
    return SuperheroController::getByPropertyPaginate($property, $perPage);
});

Route::get('/superhero/{property}/{filter}', function($property, $filter) {
    return SuperheroController::getByPropertyFilter($property, $filter);
});