<?php

namespace App\Jobs;

use App\Models\Visit;
use App\Services\Geoip\GeoipServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Laravel\InterfaceUseragent\UserAgentServiceInterface;

class UserAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $reader;
    public $userAgentObject;
    public $ip;
    public $userAgent;

    public function __construct(GeoipServiceInterface $reader, UserAgentServiceInterface $userAgentObject, string $ip, string $userAgent)
    {
        $this->reader = $reader;
        $this->userAgentObject = $userAgentObject;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->reader->parse($this->ip);
        $isoCode = $this->reader->getIsoCode();
        $isoCountry = $this->reader->getCountry();

        $this->userAgentObject->parse($this->userAgent);
        $browserName = $this->userAgentObject->getBrowserName();
        $systemName = $this->userAgentObject->getSystemName();

        $data = [
            'ip' => $this->ip,
            'country_code' =>$isoCountry,
            'continent_code' =>$isoCode,
            'browser_name' =>$browserName,
            'system_name' =>$systemName,
        ];

        $error = [];
        foreach ($data as $value) {
            if($value == null) {
                $error[] = 1;
            }
        }

        if(empty($error)) {
            Visit::create($data);
        }
    }
}
