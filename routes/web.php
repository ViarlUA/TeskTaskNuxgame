<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'register')
    ->name('home');

Route::group([
    'middleware' => ['auth'],
    'prefix'     => 'tokens',
    'as'         => 'tokens.',
],
    static function () {
        Route::post('/{oldToken}', [TokenController::class, 'generate'])
            ->name('generate');
        
        Route::get('/{token}', [TokenController::class, 'show'])
            ->withoutMiddleware('auth')
            ->name('view');
        
        Route::delete('/{token}',
            [TokenController::class, 'deactivate'])
            ->name('deactivate');
    }
);

Route::group([
    'middleware' => ['auth',],
    'prefix'     => 'games',
    'as'         => 'games.',
],
    static function () {
        Route::get('/', [GameController::class, 'index'])
            ->name('index');
        
        Route::post('/play', [GameController::class, 'play'])
            ->name('play');
    }
);

require __DIR__ . '/auth.php';
