<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//questo file è responsabile si servire le chiamate API di Laravel, e tutte le rotte qui contenute, hanno prefisso /api

// /api/posts
Route::get('/posts', 'Api\PostController@index');

// /api/posts/*
Route::get('/posts/{slug}', 'Api\PostController@show');
