<?php

namespace App\Services\Geoip;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class MaxmindService implements GeoipServiceInterface {

    protected $_reader;
    protected $_data;

    public function __construct() {
        $this->_reader = new Reader(
            base_path().DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'geoip'.DIRECTORY_SEPARATOR.'GeoLite2-Country.mmdb'
        );
    }

    public function parse(string $ip): void {
        try {
            $this->_data = $this->_reader->country($ip);
        } catch (AddressNotFoundException) {
            // do something
        }
    }
    /**
     * @return string|null
     */
    public function getIsoCode(): ?string {
        return $this->_data->continent->code ??null;
    }
    /**
     * @return string|null
     */
    public function getCountry(): ?string {
        return $this->_data->country->isoCode ??null;
    }

}
