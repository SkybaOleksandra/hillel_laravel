<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\Geoip\GeoipServiceInterface;
use Laravel\InterfaceUseragent\UserAgentServiceInterface;
use App\Models\Visit;
use App\Jobs\UserAgent;

class GeoIpController extends Controller
{
    public function index(GeoipServiceInterface $reader, UserAgentServiceInterface $userAgentObject) {


        $ip = '82.117.232.46';
        //$ip = request()->ip();
        $userAgent = request()->userAgent();

        UserAgent::dispatch($reader, $userAgentObject, $ip, $userAgent)->onQueue('parsing');
    }
}
