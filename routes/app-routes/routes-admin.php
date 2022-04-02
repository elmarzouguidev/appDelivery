<?php

use App\Http\Controllers\Sameleon\Admin\Admin\AdminController;
use App\Http\Controllers\Sameleon\Admin\Admin\PermissionController;
use App\Http\Controllers\Sameleon\Admin\Admin\RoleController;
use App\Http\Controllers\Sameleon\Admin\Admin\SettingController;
use App\Http\Controllers\Sameleon\Admin\AdminHomeController;
use App\Http\Controllers\Sameleon\Admin\City\AdminCityController;
use App\Http\Controllers\Sameleon\Admin\Client\ClientController;
use App\Http\Controllers\Sameleon\Admin\Command\AdminCommandController;
use App\Http\Controllers\Sameleon\Admin\Product\AdminProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AdminHomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'commands'], function () {

    Route::get('/', [AdminCommandController::class, 'index'])->name('commands.index');
    Route::post('/', [AdminCommandController::class, 'store'])->name('commands.store');
    Route::delete('/delete', [AdminCommandController::class, 'delete'])->name('commands.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{command}', [AdminCommandController::class, 'edit'])->name('commands.edit');
        Route::post('/{command}', [AdminCommandController::class, 'update'])->name('commands.update');
    });
});

Route::group(['prefix' => 'products'], function () {

    Route::get('/', [AdminProductController::class, 'index'])->name('products.index');

    Route::get('/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/create', [AdminProductController::class, 'store'])->name('products.store');

    Route::delete('/', [AdminProductController::class, 'delete'])->name('products.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{product}', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::post('/{product}', [AdminProductController::class, 'update'])->name('products.update');
    });
});



Route::group(['prefix' => 'cities'], function () {

    Route::get('/', [AdminCityController::class, 'index'])->name('cities.index');

    Route::post('/', [AdminCityController::class, 'store'])->name('cities.store');
    Route::post('/city/{city}', [AdminCityController::class, 'update'])->name('cities.update');

    Route::delete('/', [AdminCityController::class, 'delete'])->name('cities.delete');
});

Route::group(['prefix' => 'clients'], function () {

    Route::get('/', [ClientController::class, 'index'])->name('clients.index');

    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/create', [ClientController::class, 'store'])->name('clients.store');

    Route::delete('/', [ClientController::class, 'delete'])->name('clients.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{client}', [ClientController::class, 'edit'])->name('clients.edit');
        Route::post('/{client}', [ClientController::class, 'update'])->name('clients.update');
    });
});

Route::group(['prefix' => 'auth/admins'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admins.index');

    Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admins.store');

    Route::delete('/', [AdminController::class, 'delete'])->name('admins.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{user}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::post('/{user}', [AdminController::class, 'update'])->name('admins.update');
    });
});

Route::group(['middleware' => ['role:SuperAdmin','cache_response']], function () {

    Route::group(['prefix' => 'auth/permissions'], function () {

        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');

        //Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');

        Route::delete('/', [PermissionController::class, 'delete'])->name('permissions.delete');

        Route::group(['prefix' => 'edit'], function () {

            Route::get('/{user}', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::post('/{user}', [PermissionController::class, 'update'])->name('permissions.update');
        });
    });

    Route::group(['prefix' => 'auth/roles'], function () {

        Route::get('/', [RoleController::class, 'index'])->name('roles.index');

        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/create', [RoleController::class, 'store'])->name('roles.store');

        Route::delete('/', [RoleController::class, 'delete'])->name('roles.delete');

        Route::group(['prefix' => 'edit'], function () {

            Route::get('/{user}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::post('/{user}', [RoleController::class, 'update'])->name('roles.update');
        });
    });
});

Route::group(['prefix' => 'auth/settings'], function () {

    Route::get('/', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/', [SettingController::class, 'store'])->name('settings.store');
});


Route::group(['prefix' => 'settings'], function () {

    Route::group(['prefix' => 'company'], function () {

        Route::get('/', [SettingController::class, 'index'])->name('company');
        Route::post('/', [SettingController::class, 'store'])->name('company.store');
    });
});
