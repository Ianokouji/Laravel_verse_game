<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


Route::get('/verseSelect', function () {
    return view('pages.verseSelector');
})->name('verseSelector');

Route::get('/gameBoard', function () { 
    return view('pages.gameBoard');
})->name('gameBoard');
