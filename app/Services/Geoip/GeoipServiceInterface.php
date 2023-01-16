<?php

namespace App\Services\Geoip;

interface GeoipServiceInterface {

    public function parse(string $ip): void;
    public function getIsoCode(): ?string;
    public function getCountry(): ?string;
}
