<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface OriginatorInterface
 * @package SmsclubApi\Interfaces
 */
interface OriginatorInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();
}
