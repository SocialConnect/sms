<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Provider;


interface ProviderInterface
{
    /**
     * @return float
     */
    public function getBalance();

    /**
     * @param string|integer $phone
     * @param string $message
     * @return mixed
     */
    public function send($phone, $message);

}
