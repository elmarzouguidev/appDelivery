<?php

namespace App\Http\Controllers\Sameleon\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\User;
use App\Repositories\Bill\BillInterface;
use App\Status\Status;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminHomeController extends Controller
{


    public function index()
    {
        $deliviers = User::role('Delivery')
            ->withCount('commandsDelivery')

            ->get();

        $chart_options = [
            'chart_title' => 'Compte Client',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sameleon\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
            'chart_color' => '47, 83, 147',
        ];
        $chart_optionss = [
            'chart_title' => 'Commands par mois',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sameleon\Command',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
            'chart_color' => '47, 83, 147',
        ];

        $chart = new LaravelChart($chart_options);

        $chart2 = new LaravelChart($chart_optionss);

        $payments = app(BillInterface::class)->getBills();

        return view('Sameleon.Admin.Home2.index', compact('deliviers', 'chart', 'chart2', 'payments'));
    }
}
