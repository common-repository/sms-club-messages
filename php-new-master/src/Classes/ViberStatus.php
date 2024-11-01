<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\ViberStatusInterface;

/**
 * Class ViberStatus
 * @package SmsclubApi\Classes
 */
class ViberStatus implements ViberStatusInterface
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
     * @var string
     */
    private $additional;
    /**
     * @var string
     */
    private $smsStatus;

    /**
     * ViberStatus constructor.
     * @param int $id
     * @param string $status
     * @param string $additional
     * @param string $smsStatus
     */
    public function __construct($id, $status, $additional, $smsStatus)
    {
        $this->id = $id;
        $this->status = $status;
        $this->additional = $additional;
        $this->smsStatus = $smsStatus;
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

    /**
     * @return string
     */
    public function getAdditionalStatus()
    {
        return $this->additional;
    }

    /**
     * @return string
     */
    public function getSmsStatus()
    {
        return $this->smsStatus;
    }
}