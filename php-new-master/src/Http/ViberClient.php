<?php

namespace SmsclubApi\Http;

/**
 * Class ViberClient
 * @package SmsclubApi\Http
 */
class ViberClient extends Client
{
    /**
     * @param string $data
     * @return bool|string
     */
    public function sendMessage($data)
    {
        return $this->request->url(VIBER_API_URL . '/send')
            ->post()
            ->postFields($data)
            ->returnTransfer()
            ->execute();
    }

    /**
     * @param string $data
     * @return bool|string
     */
    public function getStatus($data)
    {
        return $this->request->url(VIBER_API_URL . '/status')
            ->post()
            ->postFields($data)
            ->returnTransfer()
            ->execute();
    }

    /**
     * @return bool|string
     */
    public function getOriginators()
    {
        return $this->request->url(VIBER_API_URL . '/originator')
            ->returnTransfer()
            ->execute();
    }
}

