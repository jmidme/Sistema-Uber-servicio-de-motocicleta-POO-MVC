<?php
Route::get("/", ControladorUsuarios::class);
Route::get("/signup", ControladorUsuarios::class."@signup");
Route::get("/signup/:error", ControladorUsuarios::class."@signup");
Route::get("/imagenes", ControladorImagenes::class."@imagenes");

Route::post("/signup/registrar", ControladorUsuarios::class."@insertarUsuario");
Route::post("/registrar", ControladorUsuarios::class."@insertarUsuario");
Route::post("/login", ControladorUsuarios::class."@autenticarUsuario");

Route::get("/dashboard", ControladorDashboard::class);
Route::get("/dashboard/:error", ControladorDashboard::class."@dashboard");
Route::get("/actualizar/:id", ControladorDashboard::class."@actualizar");
Route::get("/listarchofer", ControladorDashboard::class."@obtenerConductor");
Route::get("/finalizar", ControladorDashboard::class);
Route::get("/:error", ControladorUsuarios::class."@index");

Route::post("/listar", ControladorDashboard::class."@obtenerDatos");

Route::post("/verimagenes", ControladorImagenes::class."@registrarimagenes");