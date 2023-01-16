<?php

namespace App\Services\UserAgent;

use hisorange\BrowserDetect\Parser;

class BrowserDetectionService implements UserAgentServiceInterface {

    protected $_parser;
    protected $_data;

    public function __construct() {
        $this->_parser = new Parser();
    }

    public function parse($_data): void {
        $this->_data = $this->_parser->detect();
    }
    /**
     * @return string|null
     */

    public function getBrowserName(): ?string {
        return $this->_data->browserFamily();
    }
    /**
     * @return string|null
     */

    public function getSystemName(): ?string {
        return $this->_data->platformFamily();
    }
}
