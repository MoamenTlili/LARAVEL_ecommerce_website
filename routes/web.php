<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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




Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/products', function () {

    $result=DB::table('productslist')->get();      
    return view('shop', ['productslist' =>$result]);
});

Route::get('/products/{catid}', function ($catid) {

    $result=DB::table('products')->where('catid' , $catid)->get();
    return view('computer' ,['products'=>$result]);
});





#Route::get('/dashboard', function () {
#   return view('welcome');
#})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->usertype == '1') {
        return view('admin'); // Redirect admin users to the admin page
    } elseif ($user->usertype == '0') {
        return view('welcome'); // Redirect authenticated non-admin users to the welcome page
    } else {
        return redirect('/login'); // Redirect unauthenticated users to the login page
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/category', function () {

    $result=DB::table('productslist')->get();      
    return view('admincategory', ['productslist' =>$result]);
});

Route::get('/category', function () {

    $result=DB::table('productslist')->get();      
    return view('admincategory', ['productslist' =>$result]);
});

Route::get('/product', function () {

    $result=DB::table('products')->get();      
    return view('adminproduct', ['products' =>$result]);
});

/*Route::get('/dashboard', function () {

    return view('admin');
});*/



Route::get('/view_category', [CategoryController::class, 'index'])->name('view_category');
Route::post('/add_category', [CategoryController::class, 'store'])->name('add_category'); 
Route::delete('/delete_category/{id}', [CategoryController::class, 'delete_category'])->name('delete_category');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
