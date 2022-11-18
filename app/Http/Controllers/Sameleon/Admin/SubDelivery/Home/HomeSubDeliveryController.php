<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Bill\BillInterface;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeSubDeliveryController extends Controller
{


    public function index()
    {

        if (isDelivery() && delivery()->hasRole('DeliveryEntreprise')) {
            $chart_options = [
                'chart_title' => 'Commands par mois',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Sameleon\Chart\CommandChart',
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar',
                //'filter_field' => 'created_at',
                // 'filter_days' => 30, // show only last 30 days
                'chart_color' => '47, 83, 147',
            ];

            $chart = new LaravelChart($chart_options);

            $payments = app(BillInterface::class)->getBills();

            return view('Sameleon.Admin.SubDelivery.Home2.index', compact('chart', 'payments'));
            
        } elseif (isDelivery() && delivery()->hasRole('SubDelivery')) {

            return view('Sameleon.Admin.SubDelivery.Home2SubDelivery.index');
        }
    }
}
