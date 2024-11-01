<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\OriginatorInterface;
use SmsclubApi\Interfaces\SmsInterface;

/**
 * Class Sms
 * @package SmsclubApi\Classes
 */
class Sms implements SmsInterface
{
    /**
     * @var array
     */
    protected $phones;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var string
     */
    protected $originator;
    /**
     * @var int
     */
    protected $integration;

    /**
     * @param array $phones
     * @return SmsInterface
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param $message
     * @return SmsInterface
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param OriginatorInterface $originator
     * @return SmsInterface
     */
    public function setOriginator($originator)
    {
        $this->originator = $originator;
        return $this;
    }

    /**
     * @return OriginatorInterface
     */
    public function getOriginator()
    {
        return $this->originator;
    }

    /**
     * @param int $id
     * @return SmsInterface
     */
    public function setIntegrationId($id)
    {
        $this->integration = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIntegrationId()
    {
        return $this->integration;
    }

}