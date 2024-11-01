<?php

namespace SmsclubApi\Interfaces;

/**
 * Interface ApiServiceInterface
 * @package SmsclubApi\Interfaces
 */
interface ApiServiceInterface
{
    /**
     * @return OriginatorInterface[]|false
     */
    public function getSmsOriginators();

    /**
     * @param SmsInterface $sms
     * @return SendResponseInterface[]|false
     */
    public function sendSms($sms);

    /**
     * @return OriginatorInterface[]|false
     */
    public function getViberOriginators();

    /**
     * @param ViberMessageInterface $viber
     * @return SendResponseInterface[]|false
     */
    public function sendViber($viber);

    /**
     * @param array $idList
     * @return SmsStatusInterface[]|false
     */
    public function getSmsStatuses($idList);

    /**
     * @param array $idList
     * @return ViberStatusInterface[]|false
     */
    public function getViberStatuses($idList);

    /**
     * @return UserInfoInterface|false
     */
    public function getUserInfo();

    /**
     * @return ErrorInterface[]
     */
    public function getErrors();

    /**
     * @return bool
     */
    public function hasErrors();

    /**
     * @return BalanceInterface|false
     */
    public function getBalance();
}
