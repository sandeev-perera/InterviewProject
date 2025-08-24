<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



// Used whereAlpha and whereNumber
Route::controller(PostsController::class)->group(function(){
    Route::get('/','showAllPosts')->name('show.index');
    Route::get('/posts/{category}', 'showPostsByCategory')->whereAlpha('category')->name('show.postsByCategory');
    Route::get('/post/{post}', 'show')->whereNumber('post')->name('show.singlePost');
});


Route::prefix("/admin")->middleware(['auth', 'verified','role:Admin'])->group(function(){
    Route::get("/dashboard", [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
    Route::get("/manageProducts", [AdminController::class, "showProductsPage"])->name("show.admin.products");
    Route::get("/manageUsers", [AdminController::class, "viewProfiles"])->name("show.users");
});

Route::prefix("/customer")->middleware(['auth', 'verified', 'role:Customer'])->group(function(){
    Route::get("/dashboard",[CustomerController::class, 'showCustomerDashboard'] )->name('customer.dashboard');
    Route::get('/addPost', [PostsController::class,'showAddPost'])->name('show.addPost');
    Route::post('/addPost', [PostsController::class, "store"])->name('store.post');
});

Route::get('/customers/{id}', [CustomerController::class, 'showCustomerProfile'])->whereNumber('id')->name('show.customer.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/post/{post}', [PostsController::class, "destroy"])->whereNumber('post')->name("delete.post");
    Route::get('/post/update/{post}', [PostsController::class, 'edit'])->whereNumber('post')->name('show.edit.post');
    Route::patch('/post/update/{post}', [PostsController::class, 'update'])->whereNumber('post')->name('posts.update');

});

// Route::get('/customer/dashboard', function () {
//     return view('customer.home');
// })->middleware(['auth', 'verified', 'role:Customer'])->name('customer.dashboard');

// Admin Dashboard
// Route::get('/admin/dashboard', function () {
//     return view('admin.admindashboard');
// })->middleware(['auth', 'verified', 'role:Admin'])->name('admin.dashboard');

// Profile Routes (unchanged)


require __DIR__.'/auth.php';