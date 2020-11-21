<?php

use App\Http\Controllers\gerenciador;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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




Route::get('/', [gerenciador::class,'index'])->name('atividades.index');
Route::get('atividades/', [gerenciador::class,'store'])->name('atividade.store');
Route::get('atividades/{atividade}', [gerenciador::class,'show'])->name('atividade.show');
Route::delete('atividades/{atividade}', [gerenciador::class, 'destroy'])->name('atividade.destroy');
Route::get('atividades/update/{id}/concluir', [gerenciador::class, 'concluir'])->name('atividades.concluir');