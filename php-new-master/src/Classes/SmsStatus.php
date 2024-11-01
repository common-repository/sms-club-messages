<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\SmsStatusInterface;

/**
 * Class SmsStatus
 * @package SmsclubApi\Classes
 */
class SmsStatus implements SmsStatusInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $status;

    /**
     * SmsStatus constructor.
     * @param int $id
     * @param string $status
     */
    public function __construct($id, $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
