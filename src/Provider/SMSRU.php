<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

use SocialConnect\Common\Http\Client\Client;
use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\HttpClient;
use SocialConnect\SMS\Entity\SmsResult;
use SocialConnect\SMS\Exception\InvalidConfigParameter;

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

        if (empty($this->configuration['appId'])) {
            throw new InvalidConfigParameter('appId cannot be empty!');
        }
    }

    /**
     * @param string $uri
     * @param array $parameters
     * @return bool|string
     */
    public function request($uri, array $parameters = [])
    {
        $baseParameters = [
            'api_id' => $this->configuration['appId']
        ];

        $response = $this->httpClient->request($this->baseUrl . $uri, array_merge($baseParameters, $parameters), Client::GET, [], []);
        if ($response->isSuccess()) {
            $parts = explode("\n", $response->getBody());

            if ($parts[0] == '100') {
                return $parts[1];
            }

            return false;
        }

        return false;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        $response = $this->request('my/balance');
        return (float) $response;
    }

    /**
     * @param int|string $phone
     * @param string $message
     * @return bool|SmsResult
     */
    public function send($phone, $message)
    {
        $response = $this->request(
            'sms/send',
            [
                'to' => $phone,
                'text' => $message
            ]
        );

        if ($response) {
            return new SmsResult($response);
        }

        return false;
    }
}
