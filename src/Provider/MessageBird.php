<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

use RuntimeException;
use SocialConnect\Common\Http\Client\Client;
use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\HttpClient;
use SocialConnect\SMS\Entity\SmsResult;
use SocialConnect\SMS\Exception\InvalidConfigParameter;

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

        if (empty($this->configuration['secret'])) {
            throw new InvalidConfigParameter('Secret cannot be empty!');
        }

        if (empty($this->configuration['from'])) {
            throw new InvalidConfigParameter('From cannot be empty!');
        }
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
            ]
        );

        if ($response->isSuccess()) {
            return json_decode($response->getBody());
        }

        return false;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        $response = $this->request('balance');
        if (!$response) {
            throw new RuntimeException('Wrong response on account/get-balance');
        }

        return (float) $response->amount;
    }

    /**
     * @param int|string $phone
     * @param string $message
     * @return bool|mixed
     */
    public function send($phone, $message)
    {
        $response = $this->request(
            'messages',
            [
                'originator' => $this->configuration['from'],
                'body' => $message,
                'recipients' => $phone,
                'datacoding' => 'unicode'
            ],
            Client::POST
        );

        if ($response) {
            return new SmsResult($response->id);
        }

        return false;
    }
}
