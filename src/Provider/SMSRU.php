<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

use SocialConnect\Common\Http\Client\Client;
use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\HttpClient;

class SMSRU implements ProviderInterface
{
    use HttpClient;

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var string
     */
    private $baseUrl = 'http://sms.ru/';

    public function __construct(array $configuration, ClientInterface $httpClient)
    {
        $this->configuration = $configuration;
        $this->httpClient = $httpClient;
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return bool|string
     */
    public function request($uri, array $parameters = [])
    {
        $response = $this->httpClient->request($this->baseUrl . $uri, $parameters, Client::GET, [], []);
        if ($response->isSuccess()) {
            return json_decode($response->getBody());
        }

        return false;
    }

    public function getBalance()
    {
        $result = $this->request('my/balance');

        return 0.0;
    }

    public function send($phone, $message)
    {
        $response = $this->request(
            'sms/send',
            [
                'to' => $phone,
                'text' => $message
            ]
        );
    }
}
