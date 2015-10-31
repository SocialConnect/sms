<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

class SMSRU implements ProviderInterface
{
    public function request($uri)
    {

    }

    public function getBalance()
    {
        $result = $this->request('my/balance');

        return 0.0;
    }
}
