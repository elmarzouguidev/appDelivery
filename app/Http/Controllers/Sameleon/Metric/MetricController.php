<?php

namespace App\Http\Controllers\Sameleon\Metric;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class MetricController extends Controller
{


    public function delivery()
    {
        $users = User::role('Delivery')->with('metrics')->get();
        
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sameleon\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $chart = new LaravelChart($chart_options);
      //  dd($chart);

        return view('Sameleon.Admin.Metric.delivery.index', compact('users','chart'));
    }
}
