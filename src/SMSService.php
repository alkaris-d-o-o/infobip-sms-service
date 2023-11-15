<?php

namespace Alkaris\SMSService;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class SMSService{

    protected $_api_key_prefix, $_api_key, $_url_base_path;
    protected $_sender;
    protected $_headers = [];
    protected $_content, $_phone_number;
    protected $_client, $_response;

    public function __construct($apiKeyPrefix, $apiKey, $urlBasePath){
        $this->_api_key_prefix = $apiKeyPrefix;
        $this->_api_key = $apiKey;
        $this->_url_base_path = $urlBasePath;

        /* Setup API KEY and others */

        $this->setHeaders();

        /* Create new Client */
        $this->_client = new Client($this->_headers);
    }
    protected function setHeaders($verify = false){
        $this->_headers = [
            'base_uri' => $this->_url_base_path,
            'headers' => [
                'Authorization' => $this->_api_key_prefix . " " . $this->_api_key,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'verify' => $verify
        ];
    }
    public function setSender($sender){ $this->_sender = $sender; }
    public function setContent($content){ $this->_content = $content; }
    public function setNumber($phoneNumber){ $this->_phone_number = $phoneNumber; }
    public function sendSMS(){
        $this->_client->request(
            'POST',
            'sms/2/text/advanced', [
                RequestOptions::JSON => [
                    'messages' => [
                        [
                            'from' => $this->_sender,
                            'destinations' => [
                                ['to' => $this->_phone_number]
                            ],
                            'text' => $this->_content
                        ]
                    ]
                ],
            ]
        );
    }
}

