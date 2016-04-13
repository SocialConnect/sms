<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace SocialConnect\SMS\Entity;

use socialconnect\sms\src\Provider\NexmoSmsStatusCode;

class NexmoSmsResult extends SmsResult
{
    public function __construct($id, $status)
    {
        $this->status = $status;
        parent::__construct($id);
    }

    /**
     * @var int
     */
    protected $status;

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->status == NexmoSmsStatusCode::STATUS_SUCCESS;
    }
}
