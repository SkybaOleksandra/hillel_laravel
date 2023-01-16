<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\Geoip\GeoipServiceInterface;
use App\Services\UserAgent\UserAgentServiceInterface;
use App\Models\Visit;

class GeoIpController extends Controller
{
    public function index(GeoipServiceInterface $reader, UserAgentServiceInterface $userAgent) {


        //$ip = '82.117.232.46';

        $ip = request()->ip();

        $reader->parse($ip);
        $isoCode = $reader->getIsoCode();
        $isoCountry = $reader->getCountry();

        $userAgent->parse(request());
        $browserName = $userAgent->getBrowserName();
        $systemName = $userAgent->getSystemName();

        $data = [
            'ip' => $ip,
            'country_code' =>$isoCountry,
            'continent_code' =>$isoCode,
            'browser_name' =>$browserName,
            'system_name' =>$systemName,
        ];

        $error = [];
        foreach ($data as $value) {
            if($value == null) {
                $error[] = $value;
            }
        }

        if(empty($error)) {
            Visit::create($data);
        }

    }
}
