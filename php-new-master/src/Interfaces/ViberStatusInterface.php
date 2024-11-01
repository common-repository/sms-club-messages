<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface ViberStatusInterface
 * @package SmsclubApi\Interfaces
 */
interface ViberStatusInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return string
     */
    public function getAdditionalStatus();
}
