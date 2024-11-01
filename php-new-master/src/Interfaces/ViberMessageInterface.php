<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface ViberMessageInterface
 *
 * @package SmsclubApi\Interfaces
 */
interface ViberMessageInterface extends MessangerInterface
{
    /**
     * @param int $time
     * @return self
     */
    public function setLifeTime($time);

    /**
     * @return int
     */
    public function getLifeTime();

    /**
     * @param string $url
     * @return self
     */
    public function setPictureUrl($url);

    /**
     * @return string
     */
    public function getPictureUrl();

    /**
     * @param string $text
     * @return self
     */
    public function setButtonText($text);

    /**
     * @return string
     */
    public function getButtonText();

    /**
     * @param string $url
     * @return self
     */
    public function setButtonUrl($url);

    /**
     * @return string
     */
    public function getButtonUrl();

    /**
     * @param OriginatorInterface $smsOriginator
     * @return self
     */
    public function setSmsOriginator($smsOriginator);

    /**
     * @return OriginatorInterface
     */
    public function getSmsOriginator();

    /**
     * @param string $message
     * @return self
     */
    public function setSmsMessage($message);

    /**
     * @return string
     */
    public function getSmsMessage();
}
