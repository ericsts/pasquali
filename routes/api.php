<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('autorizacaoTotal')->group(function () {
    Route::prefix('/sinistros')->group(function () {

        Route::post('/classificacao', 'Sinistros\ClassificacaoController@classificar')
            ->name('v1.sinistros.classificacao.post');

        Route::get('/classificacao/encomenda/{encomendaId}', 'Sinistros\ClassificacaoController@obterPorEncomendaId')
            ->name('v1.sinistros.classificacao.encomenda.encomendaId.get');

    });
});
