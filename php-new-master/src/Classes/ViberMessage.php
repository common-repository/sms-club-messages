<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\OriginatorInterface;
use SmsclubApi\Interfaces\ViberMessageInterface;

/**
 * Class ViberMessage
 * @package SmsclubApi\Classes
 */
class ViberMessage implements ViberMessageInterface
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
    protected $messageSms;
    /**
     * @var OriginatorInterface
     */
    protected $originator;
    /**
     * @var OriginatorInterface
     */
    protected $originatorSms;
    /**
     * @var int
     */
    protected $lifetime;
    /**
     * @var string
     */
    protected $pictureUrl;
    /**
     * @var string
     */
    protected $buttonUrl;
    /**
     * @var string
     */
    protected $buttonText;

    /**
     * @param array $phones
     * @return ViberMessageInterface
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
        return $this;
    }

    /**
     * @return array
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param string $message
     * @return ViberMessageInterface
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param OriginatorInterface $originator
     * @return ViberMessageInterface
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
     * @param int $time
     * @return ViberMessageInterface
     */
    public function setLifeTime($time)
    {
        $this->lifetime = $time;
        return $this;
    }

    /**
     * @return int
     */
    public function getLifeTime()
    {
        return $this->lifetime;
    }

    /**
     * @param string $url
     * @return ViberMessageInterface
     */
    public function setPictureUrl($url)
    {
        $this->pictureUrl = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * @param string $text
     * @return ViberMessageInterface
     */
    public function setButtonText($text)
    {
        $this->buttonText = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getButtonText()
    {
        return $this->buttonText;
    }

    /**
     * @param string $url
     * @return ViberMessageInterface
     */
    public function setButtonUrl($url)
    {
        $this->buttonUrl = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getButtonUrl()
    {
        return $this->buttonUrl;
    }

    /**
     * @param OriginatorInterface $smsOriginator
     * @return ViberMessageInterface
     */
    public function setSmsOriginator($smsOriginator)
    {
        $this->originatorSms = $smsOriginator;
        return $this;
    }

    /**
     * @return OriginatorInterface
     */
    public function getSmsOriginator()
    {
        return $this->originatorSms;
    }

    /**
     * @param string $message
     * @return ViberMessageInterface
     */
    public function setSmsMessage($message)
    {
        $this->messageSms = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmsMessage()
    {
        return $this->messageSms;
    }

}
