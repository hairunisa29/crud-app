<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

route::get("/", [ProductController::class, 'index'])->name('index.index');
route::get("/product/create", [ProductController::class, 'create'])->name('index.create');
route::post('/product/store', [ProductController::class, 'store'])->name('index.store');
route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('index.edit');
route::put('/product/update/{id}', [ProductController::class, 'update'])->name('index.update');
route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('index.destroy');