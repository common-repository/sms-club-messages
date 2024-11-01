<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\SendResponseInterface;

/**
 * Class SendResponse
 * @package SmsclubApi\Classes
 */
class SendResponse implements SendResponseInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $number;

    /**
     * SendResponse constructor.
     * @param int $id
     * @param int $number
     */
    public function __construct($id, $number)
    {
        $this->id = $id;
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}
