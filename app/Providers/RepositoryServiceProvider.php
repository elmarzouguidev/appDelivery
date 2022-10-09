<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    private array $repositories = [

        [
            'abstract' => "App\Repositories\Admin\AdminInterface",
            'concrete' => "App\Repositories\Admin\AdminRepository"
        ],

        [
            'abstract' => "App\Repositories\Client\ClientInterface",
            'concrete' => "App\Repositories\Client\ClientRepository"
        ],
        [
            'abstract' => "App\Repositories\Delivery\DeliveryInterface",
            'concrete' => "App\Repositories\Delivery\DeliveryRepository"
        ],
        [
            'abstract' => "App\Repositories\Company\CompanyInterface",
            'concrete' => "App\Repositories\Company\CompanyRepository"
        ],

        [
            'abstract' => "App\Repositories\City\CityInterface",
            'concrete' => "App\Repositories\City\CityRepository"
        ],
        [
            'abstract' => "App\Repositories\Region\RegionInterface",
            'concrete' => "App\Repositories\Region\RegionRepository"
        ],
        [
            'abstract' => "App\Repositories\Invoice\InvoiceInterface",
            'concrete' => "App\Repositories\Invoice\InvoiceRepository"
        ],
        [
            'abstract' => "App\Repositories\Product\ProductInterface",
            'concrete' => "App\Repositories\Product\ProductRepository"
        ],
        [
            'abstract' => "App\Repositories\Stock\StockInterface",
            'concrete' => "App\Repositories\Stock\StockRepository"
        ],
        [
            'abstract' => "App\Repositories\Bill\BillInterface",
            'concrete' => "App\Repositories\Bill\BillRepository"
        ],
        [
            'abstract' => "App\Repositories\Command\CommandInterface",
            'concrete' => "App\Repositories\Command\CommandRepository"
        ],
        [
            'abstract' => "App\Repositories\Bank\BankInterface",
            'concrete' => "App\Repositories\Bank\BankRepository"
        ],
        [
            'abstract' => "App\Repositories\Group\GroupInterface",
            'concrete' => "App\Repositories\Group\GroupRepository"
        ],
        [
            'abstract' => "App\Repositories\Integration\IntegrationInterface",
            'concrete' => "App\Repositories\Integration\IntegrationRepository"
        ],
        [
            'abstract' => "App\Repositories\Source\SourceInterface",
            'concrete' => "App\Repositories\Source\SourceRepository"
        ],
        [
            'abstract' => "App\Repositories\BL\BLInterface",
            'concrete' => "App\Repositories\BL\BLRepository"
        ]
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $repo) {

            $this->app->bind(
                $repo['abstract'],
                $repo['concrete'],
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
