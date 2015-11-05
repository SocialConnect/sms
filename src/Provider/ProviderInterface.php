<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;


use SocialConnect\Common\Http\Client\ClientInterface;

interface ProviderInterface
{
    /**
     * @param array $configuration Configuration for provider
     * @param ClientInterface $httpClient Http client for requesting data
     */
    public function __construct(array $configuration, ClientInterface $httpClient);

    /**
     * @return float
     */
    public function getBalance();

    /**
     * @param string|integer $phone
     * @param string $message
     * @return \Socialconnect\SMS\Entity\SmsResult|boolean
     */
    public function send($phone, $message);
}
