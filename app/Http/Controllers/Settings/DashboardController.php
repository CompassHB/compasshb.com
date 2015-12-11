<?php

namespace CompassHB\Www\Http\Controllers\Settings;

use Request;
use CompassHB\Www\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the settings dashboard.
     *
     */
    public function show(Request $request)
    {
        // $data = [
        //     'activeTab' => $request->get('tab', Spark::firstSettingsTabKey()),
        //     'invoices' => [],
        //     'user' => $this->users->getCurrentUser(),
        // ];

        // if (Auth::user()->stripe_id) {
        //     $data['invoices'] = Cache::remember('spark:invoices:'.Auth::id(), 30, function () {
        //         return Auth::user()->invoices();
        //     });
        // }
        return view('settings.profile');
    }
}
