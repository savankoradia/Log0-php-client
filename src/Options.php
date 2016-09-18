<?php

namespace Log0\Exceptioner;

class Options {

    private $apiKey;
    private $url = "";
    private $client = "php0";
    private $clientVersion = "1.0.0";
    private $appEnv = "production";

    public function getApiKey() {
        $this->apiKey = (defined('LOG0_API_KEY') && !empty(LOG0_API_KEY)) ? LOG0_API_KEY : "";
        return $this->apiKey;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getClient() {
        return $this->client;
    }

    public function getClientVersion() {
        return $this->clientVersion;
    }

    public function getAppEnv() {
        $this->appEnv = (defined('APP_ENV') && !empty(APP_ENV)) ? APP_ENV : "production";
        return $this->appEnv;
    }

    public function setAppEnv($appEnv) {
        $this->appEnv = $appEnv;
    }

}
