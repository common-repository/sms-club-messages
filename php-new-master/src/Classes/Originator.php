<?php

namespace SmsclubApi\Classes;

use SmsclubApi\Interfaces\OriginatorInterface;

/**
 * Class Originator
 * @package SmsclubApi\Classes
 */
class Originator implements OriginatorInterface
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;

    /**
     * Originator constructor.
     * @param string $name
     * @param int $id
     */
    public function __construct($name, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
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
    public function getName()
    {
        return $this->name;
    }
}
