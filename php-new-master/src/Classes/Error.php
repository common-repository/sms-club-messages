<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\ErrorInterface;

/**
 * Class Error
 * @package SmsclubApi\Classes
 */
class Error implements ErrorInterface
{
    /**
     * @var int
     */
    private $code;
    /**
     * @var string
     */
    private $message;

    /**
     * Error constructor.
     * @param int $code
     * @param string $message
     */
    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
