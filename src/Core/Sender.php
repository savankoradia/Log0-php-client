<?php

namespace Log0\Exceptioner\Core;

class Sender {

    private $_data = array();

    public function send($data) {
        $options = new Options();
        $url = $options->getUrl();

        $data['apiKey'] = $options->getApiKey();
        $data['client'] = $options->getClient();
        $data['clientVersion'] = $options->getClientVersion();
        $data['appEnvironment'] = $options->getAppEnv();

        $this->_data = $data;
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

}
