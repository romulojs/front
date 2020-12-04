<?php

use Illuminate\Support\Facades\Route;

//CONTROLLERS
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\DashboardController;

Route::prefix("/")->group(function(){
    Route::get("", [DefaultController::class, 'index'])->name("login");
    Route::post("/CarregarUsuario", [DefaultController::class, 'carregarUsuario'])->name("CarregarUsuario");
});

Route::prefix("/dashboard")->group(function(){
    Route::get("/home", [DashboardController::class, 'home'])->middleware("usersession")->name("home");
    Route::get("/deslogarUsuarios", [DashboardController::class, 'DeslogarUsuarios'])->middleware("usersession")->name("deslogarUsuario");
});
