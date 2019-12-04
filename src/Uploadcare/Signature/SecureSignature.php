<?php

namespace Uploadcare\Signature;

use Exception;
use DateTime;

/**
 * Class SecureSignature
 * @package Uploadcare
 */
class SecureSignature implements SignatureInterface
{
    /**
     * @var string
     */
    private $signature;

    /**
     * @var int
     */
    private $expire;

    /**
     * SecureSignature constructor.
     *
     * @param string $secretKey
     * @param int $lifeTime
     *
     * @throws Exception
     */
    public function __construct($secretKey, $lifeTime)
    {
        $now = new DateTime();
        $dateTimeTimestamp = $dateTime->getTimestamp();
        $expireTimestamp = $dateTimeTimestamp + $lifeTime;

        $toSign = $secretKey . $expireTimestamp;

        $this->signature = md5($toSign);
        $this->expire = $expireTimestamp;
    }

    /**
     * The signature is an MD5 hex-encoded hash from a concatenation
     * of your `secret_key` and `expire`.
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Expire sets the time until your signature is valid.
     * It is a Unix timestamp.
     *
     * @return int
     */
    public function getExpire()
    {
        return $this->expire;
    }
}
