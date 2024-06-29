<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::redirect('/', '/login');

Route::group(['middleware' => ['auth']], function () {
    //
});
