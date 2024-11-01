<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface MessengerInterface
 *
 * @package SmsclubApi\Interfaces
 */
interface MessangerInterface
{
    /**
     * @param $phones
     * @return self
     */
    public function setPhones($phones);

    /**
     * @return mixed
     */
    public function getPhones();

    /**
     * @param $message
     * @return mixed
     */
    public function setMessage($message);

    /**
     * @return mixed
     */
    public function getMessage();

    /**
     * @param OriginatorInterface $originator
     * @return mixed
     */
    public function setOriginator($originator);

    /**
     * @return OriginatorInterface
     */
    public function getOriginator();
}
