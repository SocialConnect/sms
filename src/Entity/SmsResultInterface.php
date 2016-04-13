<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Entity;

interface SmsResultInterface
{
    /**
     * @return int|string
     */
    public function getId();

    /**
     * @return bool
     */
    public function isSuccess();
}
