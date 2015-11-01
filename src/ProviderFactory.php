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

    /**
     * @param array $configuration
     * @param ClientInterface|null $httpClient
     */
    public function __construct(array $configuration, ClientInterface $httpClient = null)
    {
        $this->configuration = $configuration;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getProviderConfig($name)
    {
        $name = strtolower($name);

        if (isset($this->configuration['provider'][$name])) {
            return $this->configuration['provider'][$name];
        }

        throw new \RuntimeException('No config for provider ' . $name);
    }

    /**
     * @param string $name
     * @return ProviderInterface
     */
    public function factory($name)
    {
        $className = 'SocialConnect\\SMS\\Provider\\' . $this->map[strtolower($name)];

        return new $className($this->getProviderConfig($name), $this->httpClient);
    }
}
