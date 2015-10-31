<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;

class Nexmo implements ProviderInterface
{
    public function request($uri)
    {

    }

    public function getBalance()
    {
        $result = $this->request('account/get-balance/');

        return 0.0;
    }

    public function send($phone, $message)
    {
        // TODO: Implement send() method.
    }
}
