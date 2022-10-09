<?php

namespace App\Http\Controllers\Sameleon\Metric;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\User;
use App\Status\Status;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class MetricController extends Controller
{


    public function delivery()
    {
        $users = Delivery::role(['Delivery','DeliveryEntreprise'])

            ->withCount(['commandsDelivery as commands_livred_now' => function ($query) {
                $query->whereStatus(Status::LIVRE)->whereDate('delivered_at', now()->format('Y-m-d'));
            }])

            ->withCount(['commandsDelivery as commands_livred' => function ($query) {
                $query->whereStatus(Status::LIVRE);
            }])
            ->withCount(['commandsDelivery as commands_refused' => function ($query) {
                $query->whereStatus(Status::REFUSE);
            }])
            ->get()
            ->sortBy([['commands_livred', 'desc']]);

        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sameleon\Delivery',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $chart = new LaravelChart($chart_options);
        //  dd($chart);

        return view('Sameleon.Admin.Metric.delivery.index', compact('users', 'chart'));
    }

    public function cities()
    {

        $cities = City::has('commands')
            ->withCount(['commands as commands_livred' => function ($query) {
                $query->whereStatus(Status::LIVRE);
            }])
            ->withCount(['commands as commands_refused' => function ($query) {
                $query->whereStatus(Status::REFUSE);
            }])
            ->get()
            ->sortBy([['commands_livred', 'desc']]);

        //dd($cities);

        return view('Sameleon.Admin.Metric.city.index', compact('cities'));
    }
}
