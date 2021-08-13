<?php

namespace App\Http\Controllers;

use App\FlatReportingQuickLink;
new \Illuminate\Database\Eloquent\Collection;

class MainController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function index()
    {
        $fillFlatReportingQuickLinks = FlatReportingQuickLink::first();

        $serversHealth = isset($fillFlatReportingQuickLinks->services_health) ? collect(json_decode($fillFlatReportingQuickLinks->services_health)) : [];
        $vin = isset($fillFlatReportingQuickLinks->vin) ? collect(json_decode($fillFlatReportingQuickLinks->vin)) : [];
        $vout = isset($fillFlatReportingQuickLinks->vout) ? collect(json_decode($fillFlatReportingQuickLinks->vout)) : [];
        $NetNonMicrosoft = isset($fillFlatReportingQuickLinks->net_non_microsoft) ? collect(json_decode($fillFlatReportingQuickLinks->net_non_microsoft)): [];
        $NetMicrosoft = isset($fillFlatReportingQuickLinks->net_microsoft) ? collect(json_decode($fillFlatReportingQuickLinks->net_microsoft)) : [];

        return view('welcome')
            ->with('servicesHealth', $serversHealth)
            ->with('VIN', $vin)
            ->with('VOUT', $vout)
            ->with('NetNonMicrosoft', $NetNonMicrosoft)
            ->with('NetMicrosoft', $NetMicrosoft);
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }
}
