<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

use RuntimeException;
use SocialConnect\Common\Http\Client\Client;
use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\HttpClient;
use SocialConnect\SMS\Entity\NexmoSmsResult;
use SocialConnect\SMS\Entity\SmsResult;
use SocialConnect\SMS\Exception\LogickException;
use SocialConnect\SMS\Exception\ResponseErrorException;

class Nexmo implements ProviderInterface
{
    use HttpClient;

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var string
     */
    private $baseUrl = 'https://rest.nexmo.com/';

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
     * @throws \SocialConnect\SMS\Exception\ResponseErrorException
     */
    public function request($uri, array $parameters = [], $method = Client::GET)
    {
        $baseParameters = array(
            'api_key' => $this->configuration['key'],
            'api_secret' => $this->configuration['secret']
        );

        $response = $this->httpClient->request(
            $this->baseUrl . $uri,
            array_merge($baseParameters, $parameters),
            $method,
            [],
            []
        );

        if ($response->isSuccess()) {
            return $response->json();
        }

        throw new ResponseErrorException($response->getBody(), $response->getStatusCode());
    }

    /**
     * @return float
     * @throws \SocialConnect\SMS\Exception\LogickException
     */
    public function getBalance()
    {
        $result = $this->request('account/get-balance');
        if (!$result) {
            throw new LogickException('Wrong response on account/get-balance');
        }

        return (float) $result->value;
    }

    /**
     * @param int|string $phone
     * @param string $message
     * @return bool|mixed
     * @throws \SocialConnect\SMS\Exception\ResponseErrorException
     * @throws \SocialConnect\SMS\Exception\LogickException
     */
    public function send($phone, $message)
    {
        $response = $this->request(
            'sms/json',
            [
                'from' => $this->configuration['from'],
                'text' => $message,
                'to' => $phone,
                'type' => 'unicode'
            ],
            Client::GET
        );

        if ($response) {
            $result = current($response->messages);

            $messageId = null;
            if (isset($result->{"message-id"})) {
                $messageId = $result->{"message-id"};
            }

            return new NexmoSmsResult(
                $messageId,
                $result->status
            );
        }

        throw new LogickException('Response is null');
    }
}
