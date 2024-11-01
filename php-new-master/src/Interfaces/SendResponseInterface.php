<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface SendResponseInterface
 * @package SmsclubApi\Interfaces
 */
interface SendResponseInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getNumber();
}
