<?php

namespace SmsclubApi\Statuses;

use SmsclubApi\Classes\SmsStatus;

/**
 * Class StatusHandler
 * @package SmsclubApi\Statuses
 */
class StatusHandler
{
    const SMS_REJECTED_STATUS = 'Message rejected.';
    const SMS_ENROUTE_STATUS = 'Message enroute.';
    const SMS_DELIVRD_STATUS = 'Message delivered.';
    const SMS_EXPIRED_STATUS = 'Message expired.';
    const SMS_UNDELIV_STATUS = 'Message undelivered.';

    /**
     * @param string $id
     * @return string
     */
    public static function getStatusById($id)
    {
        return self::getStatuses()[$id];
    }

    /**
     * @return array
     */
    private static function getStatuses()
    {
        return [
            'REJECTD'           => self::SMS_REJECTED_STATUS,
            'ENROUTE'           => self::SMS_ENROUTE_STATUS,
            'DELIVRD'           => self::SMS_DELIVRD_STATUS,
            'EXPIRED'           => self::SMS_EXPIRED_STATUS,
            'UNDELIV'           => self::SMS_UNDELIV_STATUS,
            'Ожидает отправки'  => self::SMS_ENROUTE_STATUS,
            'Отправлено'        => self::SMS_ENROUTE_STATUS,
            'Доставлено'        => self::SMS_DELIVRD_STATUS,
            'Просрочено'        => self::SMS_EXPIRED_STATUS,
            'Недоставляемое'    => self::SMS_UNDELIV_STATUS,
            'Отклонено'         => self::SMS_REJECTED_STATUS,
        ];
    }

}