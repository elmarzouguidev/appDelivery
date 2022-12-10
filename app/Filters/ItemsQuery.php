<?php

namespace App\Filters;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ItemsQuery extends QueryBuilder
{

    public function __construct($model, array $filters = [])
    {
        //request()->query->set('filter', $filter);

        //dd('ome 1');
        $query = $model->query();
        //dd('ome 2');
        parent::__construct($query, request());

        $this->request->query->set('filter', $filters);
        // $this->request->appends(request()->query());
        //dd('ome 3');

        $this->allowedFilters([
            'status',
            //'client',
            AllowedFilter::scope('from_to'),
            AllowedFilter::scope('client','client_filters' ),
            AllowedFilter::scope('product', 'product_filters'),
            AllowedFilter::scope('city', 'cities_filters'),
            AllowedFilter::scope('region', 'regions_filters'),
            AllowedFilter::scope('delivery', 'delivery_filters'),
            AllowedFilter::scope('qte','qte_filters' ),
            AllowedFilter::scope('source', 'source_filters'),

        ]);
    }

    /*public function app()
    {
        return app(get_class($this->model::class));
    }*/
}
