<?php

use App\Http\Controllers\DashboardController;
use App\Models\Category;
use App\Models\Type;
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

Route::get('/', function () {
    $types = Type::get();
    $categories = Category::get();

    return view('dashboard', compact('types', 'categories'));
});
Route::resource('/dashboard', DashboardController::class);

Route::get('/categories/{id}', function ($id) {
    $categories = Category::where('id_type', $id)->get();
    return response()->json($categories);
});
