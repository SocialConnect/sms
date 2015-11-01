<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\HttpClient;

class ProviderFactory
{
    use HttpClient;

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var array
     */
    protected $map = array(
        'smsru' => 'SMSRU',
        'nexmo' => 'Nexmo'
    );

    public function __construct(array $configuration, ClientInterface $httpClient = null)
    {
        $this->configuration = $configuration;
        $this->httpClient = $httpClient;
    }

    public function factory($name)
    {
        $className = $this->map[strtolower($name)];
        return new $className;
    }
}
