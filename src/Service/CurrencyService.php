<?php

namespace TransferWise\Service;

class CurrencyService extends Service
{

    /**
     * Get all currencies allowed for transfers
     *
     * @return Response
     */
    public function all()
    {
        return $this->client->request("GET", "v1/currencies");
    }
}