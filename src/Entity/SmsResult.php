<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Entity;

class SmsResult implements SmsResultInterface
{
    /**
     * @var string|integer
     */
    protected $id;

    /**
     * @param string|integer $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return (bool) $this->id;
    }
}
