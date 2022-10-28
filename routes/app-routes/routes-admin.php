<?php

use App\Http\Controllers\Sameleon\Admin\Adjustment\AdjustmentController;
use App\Http\Controllers\Sameleon\Admin\Admin\AdminController;
use App\Http\Controllers\Sameleon\Admin\Admin\HistoryController;
use App\Http\Controllers\Sameleon\Admin\Admin\PermissionController;
use App\Http\Controllers\Sameleon\Admin\Admin\RoleController;
use App\Http\Controllers\Sameleon\Admin\Admin\SettingController;
use App\Http\Controllers\Sameleon\Admin\Admin\ProfilController;
use App\Http\Controllers\Sameleon\Admin\Admin\SourceController;
use App\Http\Controllers\Sameleon\Admin\AdminHomeController;
use App\Http\Controllers\Sameleon\Admin\Annonce\AnnonceController;
use App\Http\Controllers\Sameleon\Admin\Bank\BankController;
use App\Http\Controllers\Sameleon\Admin\BL\BLController;
use App\Http\Controllers\Sameleon\Admin\BR\BRController;
use App\Http\Controllers\Sameleon\Admin\City\AdminCityController;
use App\Http\Controllers\Sameleon\Admin\Client\ClientController;
use App\Http\Controllers\Sameleon\Admin\Command\AdminCommandController;
use App\Http\Controllers\Sameleon\Admin\Command\PrintController;
use App\Http\Controllers\Sameleon\Admin\Condition\ConditionController;
use App\Http\Controllers\Sameleon\Admin\Contact\ContactController;
use App\Http\Controllers\Sameleon\Admin\Delivery\DeliveryController;
use App\Http\Controllers\Sameleon\Admin\Group\GroupController;
use App\Http\Controllers\Sameleon\Admin\Historique\HistoriqueController;
use App\Http\Controllers\Sameleon\Admin\Integration\IntegrationController;
use App\Http\Controllers\Sameleon\Admin\Invoice\AdminInvoiceController;
use App\Http\Controllers\Sameleon\Admin\Payment\PaymentController;
use App\Http\Controllers\Sameleon\Admin\Product\AdminProductController;
use App\Http\Controllers\Sameleon\Admin\Ramassage\RamassageController;
use App\Http\Controllers\Sameleon\Admin\Reclamation\ReclamationController;
use App\Http\Controllers\Sameleon\Admin\Region\RegionController;
use App\Http\Controllers\Sameleon\Admin\Setting\API\APIController;
use App\Http\Controllers\Sameleon\Admin\Stock\StockController;
use App\Http\Controllers\Sameleon\Admin\Treasury\TreausryController;
use App\Http\Controllers\Sameleon\Apps\AppsController;
use App\Http\Controllers\Sameleon\Metric\MetricController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminHomeController::class, 'index'])
    ->middleware(['role:SuperAdmin|Admin|Client'])
    ->name('home');
Route::put('/', [AdminHomeController::class, 'viewAnnonce'])
    ->middleware(['role:SuperAdmin|Admin|Client'])
    ->name('home.viewAnnonce');

Route::put('/read-notifications', [AdminHomeController::class, 'markNotification'])
    ->middleware(['role:SuperAdmin|Admin|Client'])
    ->name('home.read.notifications');

Route::group(['prefix' => 'commands'], function () {

    Route::get('/', [AdminCommandController::class, 'index'])->name('commands.index');

    Route::post('/', [AdminCommandController::class, 'store'])->name('commands.store');

    Route::delete('/delete', [AdminCommandController::class, 'delete'])->name('commands.delete');

    Route::post('/import', [AdminCommandController::class, 'import'])->name('commands.import');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{command}', [AdminCommandController::class, 'edit'])->name('commands.edit');
        Route::post('/{command}', [AdminCommandController::class, 'update'])->name('commands.update');
    });

    Route::group(['prefix' => 'archived'], function () {

        Route::get('/', [AdminCommandController::class, 'archived'])->name('commands.archived');
    });

    Route::get('/printer/{command}', [PrintController::class, 'getCommands'])->name('commands.print');
});

Route::group(['prefix' => 'adjustments'], function () {

    Route::get('/', [AdjustmentController::class, 'index'])->name('adjustments.index');

    Route::get('/create', [AdjustmentController::class, 'create'])->name('adjustments.create');
    Route::post('/create', [AdjustmentController::class, 'store'])->name('adjustments.store');

    Route::delete('/', [AdjustmentController::class, 'delete'])->name('adjustments.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{adjustment}', [AdjustmentController::class, 'edit'])->name('adjustments.edit');
        Route::post('/{adjustment}', [AdjustmentController::class, 'update'])->name('adjustments.update');
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

    /****Delivery Entreprise */
    Route::get('/delivery-company', [AdminProductController::class, 'deliveryEntreprise'])->name('products.delivery.index');
});

Route::group(['prefix' => 'stock'], function () {

    Route::get('/', [StockController::class, 'index'])->name('stock.index');
    Route::post('/', [StockController::class, 'store'])->name('stock.store');
    Route::post('update/{stock}', [StockController::class, 'update'])->name('stock.update');
    Route::delete('/delete', [StockController::class, 'delete'])->name('stock.delete');
});


Route::group(['prefix' => 'cities'], function () {

    Route::get('/', [AdminCityController::class, 'index'])->name('cities.index');

    Route::post('/', [AdminCityController::class, 'store'])->name('cities.store');
    
    Route::post('/city/{city}', [AdminCityController::class, 'update'])->name('cities.update');

    Route::delete('/', [AdminCityController::class, 'delete'])->name('cities.delete');
});


Route::group(['prefix' => 'regions'], function () {

    Route::get('/', [RegionController::class, 'index'])->name('regions.index');

    Route::post('/', [RegionController::class, 'store'])->name('regions.store');
    Route::post('/region/{region}', [RegionController::class, 'update'])->name('regions.update');

    Route::delete('/', [RegionController::class, 'delete'])->name('regions.delete');
});



Route::group(['prefix' => 'clients'], function () {

    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::put('/sync', [ClientController::class, 'syncPermission'])->name('clients.permissions.sync');

    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/create', [ClientController::class, 'store'])->name('clients.store');

    Route::delete('/', [ClientController::class, 'delete'])->name('clients.delete');

    Route::put('/', [ClientController::class, 'activate'])->name('clients.activate');


    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{client}', [ClientController::class, 'edit'])->name('clients.edit');
        Route::post('/{client}', [ClientController::class, 'update'])->name('clients.update');
    });
});

Route::group(['prefix' => 'drivers'], function () {

    Route::get('/', [DeliveryController::class, 'index'])->name('delivery.index');

    Route::get('/create', [DeliveryController::class, 'create'])->name('delivery.create');
    Route::post('/create', [DeliveryController::class, 'store'])->name('delivery.store');

    Route::delete('/', [DeliveryController::class, 'delete'])->name('delivery.delete');

    Route::group(['prefix' => 'edit'], function () {

        Route::get('/{delivery}', [DeliveryController::class, 'edit'])->name('delivery.edit');
        Route::post('/{delivery}', [DeliveryController::class, 'update'])->name('delivery.update');
    });

    Route::get('/{delivery}/team', [DeliveryController::class, 'team'])->name('delivery.team');
});

Route::group(['prefix' => 'invoices'], function () {

    Route::get('/', [AdminInvoiceController::class, 'index'])->name('invoices.index');
    Route::delete('/delete', [AdminInvoiceController::class, 'delete'])->name('invoices.delete');
});

Route::group(['prefix' => 'payments'], function () {

    Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
    Route::delete('/delete', [PaymentController::class, 'delete'])->name('payments.delete');
});

Route::group(['prefix' => 'treausry'], function () {

    Route::get('/', [TreausryController::class, 'index'])->name('treausry.index');
    Route::delete('/delete', [TreausryController::class, 'delete'])->name('treausry.delete');
});

Route::group(['prefix' => 'b-livraison'], function () {

    Route::get('/', [BLController::class, 'index'])->name('b-livraison.index');
    Route::delete('/delete', [BLController::class, 'delete'])->name('b-livraison.delete');
    
});

Route::group(['prefix' => 'b-router'], function () {

    Route::get('/', [BRController::class, 'index'])->name('b-router.index');
    Route::delete('/delete', [BRController::class, 'delete'])->name('b-router.delete');
    
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

Route::group(['middleware' => ['role:SuperAdmin']], function () {

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


Route::group(['prefix' => 'complaints'], function () {

    Route::get('/', [ReclamationController::class, 'index'])->name('complaints.index');
    Route::post('/', [ReclamationController::class, 'store'])->name('complaints.store');
    Route::delete('/delete', [ReclamationController::class, 'delete'])->name('complaints.delete');

    Route::group(['prefix' => 'show'], function () {

        Route::get('/{reclamation}', [ReclamationController::class, 'show'])->name('complaints.show');
        Route::post('/{reclamation}', [ReclamationController::class, 'update'])->name('complaints.update');
    });
});


Route::group(['prefix' => 'ramassage'], function () {

    Route::get('/', [RamassageController::class, 'index'])->name('ramassage.index');
    Route::post('/', [RamassageController::class, 'store'])->name('ramassage.store');
    Route::delete('/delete', [RamassageController::class, 'delete'])->name('ramassage.delete');

    Route::put('/', [RamassageController::class, 'demande'])->name('ramassage.demande');
});


Route::group(['prefix' => 'contact'], function () {

    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/', [ContactController::class, 'store'])->name('contact.store');
    Route::delete('/delete', [ContactController::class, 'delete'])->name('contact.delete');
});


Route::group(['prefix' => 'banks'], function () {

    Route::get('/', [BankController::class, 'index'])->name('banks.index');

    Route::get('/create', [BankController::class, 'create'])->name('banks.create');
    Route::post('/create', [BankController::class, 'store'])->name('banks.store');

    Route::get('/edit/{bank}', [BankController::class, 'edit'])->name('banks.edit');
    Route::post('/edit/{bank}', [BankController::class, 'update'])->name('banks.update');

    Route::delete('/delete', [BankController::class, 'delete'])->name('banks.delete');

    Route::put('/', [BankController::class, 'activate'])->name('banks.activate');
});


Route::group(['prefix' => 'groups'], function () {

    Route::get('/', [GroupController::class, 'index'])->name('groups.index');

    Route::get('/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/create', [GroupController::class, 'store'])->name('groups.store');

    Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('groups.edit');
    Route::post('/edit/{group}', [GroupController::class, 'update'])->name('groups.update');

    Route::delete('/delete', [GroupController::class, 'delete'])->name('groups.delete');

    Route::put('/', [GroupController::class, 'activate'])->name('groups.activate');
});

Route::group(['prefix' => 'metrics'], function () {

    Route::get('/delivery', [MetricController::class, 'delivery'])->name('metrics.delivery');

    Route::get('/cities', [MetricController::class, 'cities'])->name('metrics.cities');
});



Route::group(['prefix' => 'settings'], function () {

    Route::group(['prefix' => 'company'], function () {

        Route::get('/', [SettingController::class, 'index'])->name('company');
        Route::post('/', [SettingController::class, 'store'])->name('company.store');
    });
});


Route::group(['prefix' => 'settings'], function () {

    Route::get('/', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/', [SettingController::class, 'update'])->name('settings.store');

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', [SettingController::class, 'invoice'])->name('settings.invoice');
        Route::post('/', [SettingController::class, 'invoiceUpdate'])->name('settings.invoice.store');
    });

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [SettingController::class, 'page'])->name('settings.page');
        Route::post('/', [SettingController::class, 'pageUpdate'])->name('settings.page.store');
    });

    Route::group(['prefix' => 'integrations'], function () {

        Route::get('/', [IntegrationController::class, 'index'])->name('settings.integrations.index');
        Route::post('/', [IntegrationController::class, 'store'])->name('settings.integrations.store');

        Route::delete('/delete', [IntegrationController::class, 'delete'])->name('settings.integrations.delete');

        Route::get('/edit/{integration}', [IntegrationController::class, 'edit'])->name('settings.integrations.edit');
        Route::post('/edit/{integration}', [IntegrationController::class, 'update'])->name('settings.integrations.update');

        Route::put('/', [IntegrationController::class, 'activate'])->name('settings.integrations.activate');
    });
});

Route::group(['prefix' => 'account'], function () {

    Route::group(['prefix' => 'info'], function () {

        Route::get('/', [ProfilController::class, 'index'])->name('profil');
        Route::post('/', [ProfilController::class, 'update'])->name('profil.update');

        Route::post('/password', [ProfilController::class, 'updatePassword'])->name('profil.update.password');

        Route::post('/company', [ProfilController::class, 'updateCompany'])->name('profil.update.company');

        Route::post('/bank', [ProfilController::class, 'updateBank'])->name('profil.update.bank');
    });

    Route::group(['prefix' => 'history'], function () {

        Route::get('/', [HistoryController::class, 'index'])->name('history');
        Route::delete('/', [HistoryController::class, 'delete'])->name('history.delete');
    });

    Route::group(['prefix' => 'api-integration'], function () {

        Route::get('/', [APIController::class, 'index'])->name('api.index');
        Route::post('/', [APIController::class, 'createToken'])->name('api.update.token');
    });

    Route::group(['prefix' => 'data-sources'], function () {

        Route::get('/', [SourceController::class, 'index'])->name('profile.sources.index');
        Route::post('/', [SourceController::class, 'store'])->name('profile.sources.store');
    });
});


Route::group(['prefix' => 'apps'], function () {

    Route::get('/', [AppsController::class, 'index'])->name('apps.index');
});


Route::group(['prefix' => 'annonces'], function () {

    Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::post('/', [AnnonceController::class, 'store'])->name('annonces.store');

    Route::delete('/delete', [AnnonceController::class, 'delete'])->name('annonces.delete');

    Route::put('/', [AnnonceController::class, 'activate'])->name('annonces.activate');
});

Route::group(['prefix' => 'conditions'], function () {

    Route::get('/', [ConditionController::class, 'index'])->name('conditions.index');
    Route::post('/', [ConditionController::class, 'store'])->name('conditions.store');

    Route::delete('/delete', [ConditionController::class, 'delete'])->name('conditions.delete');

    Route::put('/', [ConditionController::class, 'activate'])->name('conditions.activate');
});

Route::group(['prefix' => 'historiques'], function () {

    Route::get('/', [HistoriqueController::class, 'index'])->name('historiques.index');

    Route::delete('/delete', [HistoriqueController::class, 'delete'])->name('historiques.delete');
});
