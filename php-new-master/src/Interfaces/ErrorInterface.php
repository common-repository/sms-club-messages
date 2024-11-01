<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface ErrorInterface
 * @package SmsclubApi\Interfaces
 */
interface ErrorInterface
{
    /**
     * @return int
     */
    public function getCode();

    /**
     * @return string
     */
    public function getMessage();
}
