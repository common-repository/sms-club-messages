<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\BalanceInterface;

/**
 * Class Balance
 * @package SmsclubApi\Classes
 */
class Balance implements BalanceInterface
{
    /**
     * @var string
     */
    private $money;
    /**
     * @var string
     */
    private $currency;

    /**
     * Balance constructor.
     * @param string $money
     * @param string $currency
     */
    public function __construct($money, $currency)
    {
        $this->money = $money;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
