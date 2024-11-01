<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface UserInfoInterface
 * @package SmsclubApi\Interfaces
 */
interface UserInfoInterface
{
    /**
     * @return double
     */
    public function getBalance();

    /**
     * @return bool
     */
    public function getCanSendViber();
}
