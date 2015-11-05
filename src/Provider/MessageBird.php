<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

use SocialConnect\Common\Http\Client\Client;
use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\HttpClient;

class MessageBird implements ProviderInterface
{
    use HttpClient;

    const CLIENT_VERSION = '1.2.0';

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var string
     */
    private $baseUrl = 'https://rest.messagebird.com/';

    public function __construct(array $configuration, ClientInterface $httpClient)
    {
        $this->configuration = $configuration;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @param string $method
     * @return bool|mixed
     */
    public function request($uri, array $parameters = [], $method = Client::GET)
    {
        $response = $this->httpClient->request(
            $this->baseUrl . $uri,
            $parameters,
            $method,
            [
                'Authorization' => 'AccessKey ' . $this->configuration['secret']
            ],
            []
        );

        if ($response->isSuccess()) {
            return json_decode($response->getBody());
        }

        return false;
    }

    public function getBalance()
    {
        $result = $this->request('balance');

        return 0.0;
    }

    /**
     * @param int|string $phone
     * @param string $message
     * @return bool|mixed
     */
    public function send($phone, $message)
    {
        $result = $this->request(
            'messages',
            [
                'originator' => $this->configuration['from'],
                'body' => $message,
                'recipients' => $phone
            ],
            Client::POST
        );

        var_dump($result);
    }
}
