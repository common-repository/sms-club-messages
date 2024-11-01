<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface SmsInterface
 *
 * @package SmsclubApi\Interfaces
 */
interface SmsInterface extends MessangerInterface
{
    /**
     * @param int $id
     * @return self
     */
    public function setIntegrationId($id);

    /**
     * @return int
     */
    public function getIntegrationId();
}
