<?php
/**
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace socialconnect\sms\src\Provider;

final class NexmoSmsStatusCode
{
    /**
     * The message was successfully accepted for delivery by Nexmo.
     * @var int
     */
    const STATUS_SUCCESS = 0;

    /**
     * You have exceeded the submission capacity allowed on this account. Please wait and retry
     * @var int
     */
    const STATUS_THROTTLED = 1;

    /**
     * Your request is incomplete and missing some mandatory parameters.
     * @var int
     */
    const STATUS_MISSING_PARAMS = 2;

    /**
     * The value of one or more parameters is invalid.
     * @var int
     */
    const STATUS_INVALID_PARAMS = 3;

    /**
     * The api_key / api_secret you supplied is either invalid or disabled.
     * @var int
     */
    const STATUS_INVALID_CREDENTIALS = 4;

    /**
     * @var int
     */
    const STATUS_INTERNAL_ERROR = 5;

    /**
     * @var int
     */
    const STATUS_INVALID_MESSAGE = 6;

    /**
     * @var int
     */
    const STATUS_NUMBER_BARRED = 6;

    /**
     * @var int
     */
    const STATUS_PARTNER_ACCOUNT_BARRED = 7;

    /**
     * @var int
     */
    const STATUS_PARTNER_QUOTA_EXCEEDED = 8;

    /**
     * @var int
     */
    const STATUS_ACCOUNT_NOT_ENABLED_FOR_REST = 9;

    /**
     * @var int
     */
    const STATUS_MESSAGE_TOO_LONG = 11;

    /**
     * @var int
     */
    const STATUS_COMMUNICATION_FAILED = 13;

    /**
     * @var int
     */
    const STATUS_INVALID_SIGNATURE = 14;

    /**
     * @var int
     */
    const STATUS_INVALID_SENDER_ADDRESS = 15;

    /**
     * @var int
     */
    const STATUS_INVALID_TTL = 16;

    /**
     * @var int
     */
    const STATUS_FACILITY_NOT_ALLOWED = 19;

    /**
     * @var int
     */
    const STATUS_INVALID_MESSAGE_CLASS = 20;

    /**
     * @var int
     */
    const STATUS_BAD_CALLBACK_URL = 23;

    /**
     * The phone number you set in to is not in your pre-approved destination list. To send messages to this phone number, add it using Nexmo Dashboard.
     * @var int
     */
    const STATUS_NON_WHITE_LISTED_DESTINATION = 29;
}
