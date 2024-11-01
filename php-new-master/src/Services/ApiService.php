<?php

namespace SmsclubApi\Services;

use SmsclubApi\Http\SmsClient;
use SmsclubApi\Http\ViberClient;
use SmsclubApi\Classes\Originator;
use SmsclubApi\Classes\SendResponse;
use SmsclubApi\Classes\ViberStatus;
use SmsclubApi\Classes\SmsStatus;
use SmsclubApi\Classes\Balance;
use SmsclubApi\Errors\ErrorHandler;
use SmsclubApi\Interfaces\ApiServiceInterface;
use SmsclubApi\Interfaces\BalanceInterface;
use SmsclubApi\Interfaces\ErrorInterface;
use SmsclubApi\Interfaces\OriginatorInterface;
use SmsclubApi\Interfaces\SendResponseInterface;
use SmsclubApi\Interfaces\SmsInterface;
use SmsclubApi\Interfaces\UserInfoInterface;
use SmsclubApi\Interfaces\ViberMessageInterface;
use SmsclubApi\Interfaces\ViberStatusInterface;
use SmsclubApi\Statuses\StatusHandler;

/**
 * Class ApiService
 * @package SmsclubApi\Services
 */
class ApiService implements ApiServiceInterface
{
    /**
     * @var array
     */
    private $credentials;

    /**
     * @var ErrorInterface[]
     */
    private $errors;

    /**
     * @param array $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return OriginatorInterface[]|bool
     * @throws \Exception
     */
    public function getSmsOriginators()
    {
        $client = new SmsClient($this->credentials);
        $response = $client->getOriginators();

        if (!isset($response['success_request'])) {
            $this->setErrors($response);
            return false;
        }

        $result = [];
        foreach ($response['success_request']['info'] as $originator) {
            $result[] = new Originator($originator);
        }

        return $result;
    }

    /**
     * @param SmsInterface $sms
     * @return SendResponseInterface[]|bool
     * @throws \Exception
     */
    public function sendSms($sms)
    {
        $data = [
            'src_addr'  => $sms->getOriginator()->getName(),
            'phone'     => $sms->getPhones(),
            'message'   => $sms->getMessage()
        ];

        if ($sms->getIntegrationId()) {
            $data['integration_id'] = $sms->getIntegrationId();
        }

        $client = new SmsClient($this->credentials);
        $response = $client->sendSms(json_encode($data));

        if (isset($response['success_request'])) {
            $successRequest = $response['success_request'];

            if (isset($successRequest['add_info']) && isset($successRequest['info'])) {
                $this->setErrors($response);
            }

            if (isset($successRequest['add_info']) && !isset($successRequest['info'])) {
                $this->setErrors($response);
                return false;
            }
        } else {
            $this->setErrors($response);
            return false;
        }

        $result = [];
        foreach ($response['success_request']['info'] as $id => $number) {
            $result[] = new SendResponse($id, $number);
        }

        return $result;
    }

    /**
     * @return OriginatorInterface[]
     */
    public function getViberOriginators()
    {
        $client = new ViberClient($this->credentials);
        $response = $client->getOriginators();

        if (isset($response['errorRequest'])) {
            $this->setErrors($response);
            return false;
        }

        $result = [];
        foreach ($response['successfulRequest']['requestData'] as $originator) {
            $result[] = new Originator($originator);
        }

        return $result;
    }

    /**
     * @param ViberMessageInterface $viber
     * @return array|bool|false|\SmsclubApi\Interfaces\SendResponseInterface[]
     * @throws \Exception
     */
    public function sendViber($viber)
    {
        $data = [
            'sender'  => $viber->getOriginator()->getName(),
            'phones'  => $viber->getPhones(),
            'message' => $viber->getMessage()
        ];

        $data = array_merge($data, $this->setViberOptionalParams($viber));

        $client = new ViberClient($this->credentials);
        $response = $client->sendMessage(json_encode($data));

        if (isset($response['errorRequest'])) {
            $this->setErrors($response);
            return false;
        }

        if (!empty($response['successfulRequest']['requestData']['additionalInfo'])) {
            $this->setErrors($response);
        }

        $result = [];
        $messages = $response['successfulRequest']['requestData']['messages'];

        foreach ($messages as $message) {
            $result[] = new SendResponse($message['id'], $message['number']);
        }

        return $result;
    }

    /**
     * @param array $idList
     * @return array|bool|false|\SmsclubApi\Interfaces\SmsStatusInterface[]
     * @throws \Exception
     */
    public function getSmsStatuses($idList)
    {
        $data = json_encode([
            'id_sms' => $idList
        ]);

        $client = new SmsClient($this->credentials);
        $response = $client->getStatus($data);

        if (isset($response['success_request']['add_info']) || !isset($response['success_request'])) {
            $this->setErrors($response);
            return false;
        }

        $result = [];
        foreach ($response['success_request']['info'] as $id => $status_id) {
            $result[] = new SmsStatus($id, StatusHandler::getStatusById($status_id));
        }

        return $result;
    }

    /**
     * @param array $idList
     * @return array|bool|false|ViberStatusInterface[]
     * @throws \Exception
     */
    public function getViberStatuses($idList)
    {
        $data = json_encode([
            'messageIds' => $idList
        ]);

        $client = new ViberClient($this->credentials);
        $response = $client->getStatus($data);

        if (isset($response['errorRequest'])) {
            $this->setErrors($response);
            return false;
        }

        $result = [];
        foreach ($response['successfulRequest']['requestData'] as $id => $data) {
            $result[] = new ViberStatus(
                $id,
                StatusHandler::getStatusById($data['status']),
                $data['additionStatus'],
                $data['smsStatus']
            );
        }

        return $result;
    }

    /**
     * @return UserInfoInterface
     */
    public function getUserInfo()
    {

    }

    /**
     * @return ErrorInterface[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        if (!empty($this->errors))
            return true;

        return false;
    }

    /**
     * @return bool|false|Balance|BalanceInterface
     * @throws \Exception
     */
    public function getBalance()
    {
        $client = new SmsClient($this->credentials);
        $response = $client->getBalance();

        if (!isset($response['success_request'])) {
            $this->setErrors($response);
            return false;
        }

        $info = $response['success_request']['info'];

        return new Balance($info['money'], $info['currency']);
    }

    /**
     * @param array $error
     */
    private function setErrors($error)
    {
        $this->errors[] = ErrorHandler::throwError($error);
    }

    /**
     * @param ViberMessageInterface $viber
     * @return array
     */
    private function setViberOptionalParams($viber)
    {
        $data = [];
        $optional = [
            'picture_url' => $viber->getPictureUrl(),
            'button_txt'  => $viber->getButtonText(),
            'button_url'  => $viber->getButtonUrl(),
            'messageSms'  => $viber->getSmsMessage(),
        ];

        if ($viber->getSmsOriginator()) {
            $optional['senderSms'] = $viber->getSmsOriginator()->getName();
        }

        foreach ($optional as $param => $value) {
            if ($value) {
                $data[$param] = $value;
            }
        }

        return $data;
    }
}
