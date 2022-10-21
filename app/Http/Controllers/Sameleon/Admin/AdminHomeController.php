<?php

namespace App\Http\Controllers\Sameleon\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Annonce;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\User;
use App\Repositories\Bill\BillInterface;
use App\Status\Status;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminHomeController extends Controller
{


    public function index()
    {
        $deliviers = Delivery::role(['Delivery','DeliveryEntreprise'])
            ->withCount('commandsDelivery')
            ->get();

        $chart_options = [
            'chart_title' => 'Compte Client',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sameleon\Chart\Client',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 180, // show only last 30 days
            'chart_color' => '47, 83, 147',
        ];

        if (auth()->user()->hasAnyRole('Admin|SuperAdmin')) {
            $chart_optionss = [
                'chart_title' => 'Commands par mois',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Sameleon\Command',
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar',
                //'filter_field' => 'created_at',
               // 'filter_days' => 30, // show only last 30 days
                'chart_color' => '47, 83, 147',
            ];
        } elseif (auth()->user()->hasRole('Client')) {
            $userId = auth()->id();
            $chart_optionss = [
                'chart_title' => 'Commands par mois',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Sameleon\Chart\CommandChart',
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar',
                //'filter_field' => 'created_at',
                //'filter_days' => 30, // show only last 30 days
                'chart_color' => '47, 83, 147',
            ];
        }


        $chart = new LaravelChart($chart_options);

        $chart2 = new LaravelChart($chart_optionss);

        $payments = app(BillInterface::class)->getBills();

        // dd(auth()->user()->unreadNotifications);
        /*foreach(auth()->user()->unreadNotifications as $notification)
        {
            dd($notification);
        }*/

        return view('Sameleon.Admin.Home2.index', compact('deliviers', 'chart', 'chart2', 'payments'));
    }

    public function viewAnnonce(Request $request)
    {

        $request->validate(['annonceId' => ['required', 'uuid'], 'userId' => ['required', 'uuid']]);

        $annonce = Annonce::whereUuid($request->annonceId)->first();

        $user = auth()->id();

        if ($annonce) {

            $viewed = $annonce->viewed ?? [];

            if ($user && !in_array($user, $viewed)) {

                $viewed = array_merge(
                    $viewed,
                    [$user]
                );

                $annonce->update(['viewed' => $viewed]);
            }
        }
        return redirect()->back();
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications->each->markAsRead();

        //return response()->noContent();
        return redirect()->back();
    }
}
