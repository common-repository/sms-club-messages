<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface BalanceInterface
 * @package SmsclubApi\Interfaces
 */
interface BalanceInterface
{
    /**
     * @return string
     */
    public function getMoney();

    /**
     * @return string
     */
    public function getCurrency();
}
