<?php

namespace App\Services\UserAgent;

use donatj\UserAgent\UserAgentParser;

class UserAgentParserService implements UserAgentServiceInterface {

    protected $_parser;
    protected $_data;

    public function __construct() {
        $this->_parser = new UserAgentParser();
    }

    public function parse($_data): void {
        $this->_data = $this->_parser->parse($_data);
    }
    /**
     * @return string|null
     */

    public function getBrowserName(): ?string {
        return $this->_data->browser();
    }
    /**
     * @return string|null
     */

    public function getSystemName(): ?string {
        return $this->_data->platform();
    }

}
