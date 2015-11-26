<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Rebilly\Client;

class Controller extends BaseController
{
    /** @var Client */
    protected $client;

    /**
     * @return Client
     */
    protected function client()
    {
        if ($this->client === null) {
            $this->client = new Client([
                'apiKey' => getenv('REBILLY_API_KEY'),
                'baseUrl' => getenv('REBILLY_API_HOST'),
            ]);
        }

        return $this->client;
    }

    /**
     * @param $config array
     */
    protected function setSession($config)
    {
        $_SESSION['customerId'] = $config['customerId'];
        $_SESSION['credentialId'] = $config['credentialId'];
        $_SESSION['username'] = $config['username'];
        $_SESSION['token'] = $config['token'];
    }

    /**
     * Unset the login session
     */
    protected function unsetSession()
    {
        unset(
            $_SESSION['customerId'],
            $_SESSION['credentialId'],
            $_SESSION['username'],
            $_SESSION['token']
        );
        session_destroy();
    }
}
