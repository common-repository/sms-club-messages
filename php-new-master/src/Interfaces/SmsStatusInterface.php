<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface SmsStatusInterface
 * @package SmsclubApi\Interfaces
 */
interface SmsStatusInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getStatus();
}
