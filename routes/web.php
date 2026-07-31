<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/demo', function () {
    return view('demo-index');
})->name('demo.index');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/demo-minimal', function () {
    return view('demo-minimal');
})->name('demo.minimal');

Route::get('/components', function () {
    return view('pages.components.index');
})->name('components');

Route::get('/components/{category}', function (string $category) {
    $categories = ['ui', 'form', 'data', 'navigation', 'overlay', 'feedback', 'layout', 'custom'];
    if (!in_array($category, $categories)) {
        abort(404);
    }
    return view("pages.components.{$category}");
})->name('components.category');

Route::get('/custom-components', function () {
    return view('custom-components-demo');
})->name('custom.components');

Route::get('/textarea-demo', function () {
    return view('textarea-demo');
})->name('textarea.demo');

