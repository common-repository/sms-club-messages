<?php

namespace SmsclubApi\Errors;

use SmsclubApi\Classes\Error;
use SmsclubApi\Interfaces\ErrorInterface;

/**
 * Class ErrorHandler
 * @package SmsclubApi\Errors
 */
class ErrorHandler
{
    /**
     * SMS API error codes
     */
    const SMS_PHONE_EMPTY = 101;
    const SMS_MESSAGE_EMPTY = 102;
    const SMS_SRC_ADDR_EMPTY = 103;
    const SMS_INVALID_PHONE = 104;
    const SMS_INVALID_ID_SMS = 105;
    const SMS_UNAUTHORIZED = 106;
    const SMS_VALIDATION = 107;
    const SMS_TOO_MANY_QUERIES = 108;
    const SMS_SERVICE_UNAVAILABLE = 109;

    /**
     * Viber API error codes
     */
    const VIBER_ACCOUNT = 110;
    const VIBER_SYSTEM_ERROR = 111;
    const VIBER_NO_MONEY = 112;
    const VIBER_ANY_CORRECT_PHONES = 113;
    const VIBER_TEXT = 114;
    const VIBER_UPLOAD_IMG = 115;
    const VIBER_SENDER = 116;
    const VIBER_SMS = 117;
    const VIBER_INCORRECT_PHONES = 118;

    /**
     * @param array $data
     * @return ErrorInterface
     */
    public static function throwError($data)
    {
        if (isset($data['successfulRequest']) || isset($data['errorRequest'])) {
            return self::throwViberError($data);
        }

        return self::throwSmsError($data);
    }

    /**
     * @param array $data
     * @return ErrorInterface
     */
    private static function throwSmsError($data)
    {
        $errors = self::smsErrors();

        if (isset($data['success_request']['add_info'])) {
            $data = $data['success_request']['add_info'];

            foreach ($errors as $attribute => $code) {
                if (isset($data[$attribute])) {
                    return new Error($code, $data[$attribute]);
                }
            }

            if (!is_array($data)) {
                return new Error($errors['invalid_id_sms'], $data);
            }

            return new Error($errors['invalid_phone'], end($data));
        }

        if (isset($data['status'])) {
            return new Error($errors[$data['status']], $data['message']);
        }
    }

    /**
     * @param array $data
     * @return ErrorInterface
     */
    private static function throwViberError($data)
    {
        $errors = self::viberErrors();

        if (isset($data['errorRequest']['errors'])) {
            $data = $data['errorRequest']['errors'];

            foreach ($errors as $attribute => $code) {
                if (isset($data[$attribute])) {
                    return new Error($code, $data[$attribute]);
                }
            }
        }

        if (isset($data['successfulRequest']['requestData']['additionalInfo'])) {
            $data = $data['successfulRequest']['requestData']['additionalInfo'];

            foreach ($errors as $attribute => $code) {
                if (isset($data[$attribute])) {
                    return new Error($code, implode(',', $data[$attribute]));
                }
            }
        }
    }

    /**
     * @return array
     */
    private static function smsErrors()
    {
        return [
            'phone'          => self::SMS_PHONE_EMPTY,
            'message'        => self::SMS_MESSAGE_EMPTY,
            'src_addr'       => self::SMS_SRC_ADDR_EMPTY,
            'invalid_phone'  => self::SMS_INVALID_PHONE,
            'invalid_id_sms' => self::SMS_INVALID_ID_SMS,
            400              => self::SMS_VALIDATION,
            401              => self::SMS_UNAUTHORIZED,
            429              => self::SMS_TOO_MANY_QUERIES,
            500              => self::SMS_SERVICE_UNAVAILABLE,
        ];
    }

    /**
     * @return array
     */
    private static function viberErrors()
    {
        return [
            'account'           => self::VIBER_ACCOUNT,
            'systemError'       => self::VIBER_SYSTEM_ERROR,
            'noMoney'           => self::VIBER_NO_MONEY,
            'anyCorrectPhones'  => self::VIBER_ANY_CORRECT_PHONES,
            'text'              => self::VIBER_TEXT,
            'upload_img'        => self::VIBER_UPLOAD_IMG,
            'sender'            => self::VIBER_SENDER,
            'SMS'               => self::VIBER_SMS,
            'incorrectPhones'   => self::VIBER_INCORRECT_PHONES,
        ];
    }
}
