<?php

namespace TransferWise\Service;

class QuoteService extends Service
{

    /**
     * Create Quote
     *
     * @param Array $params parameters needed to create a quote
     *
     * @return Response
     */
    public function create($params)
    {
        $profileId = $this->mustHaveProfileId();
        return $this->client->request("POST", "v3/profiles/{$profileId}/quotes", $params);
    }

    /**
     * Create temporary quote
     *
     * @param Array $params parameters needed to create a temporary quote
     *
     * @return Response
     */
    public function temporary($params)
    {
        return $this->client->request("POST", "v3/quotes", $params);
    }

    /**
     * Update Quote
     *
     * @param Int   $id     Quote Id
     * @param Array $params parameters needed to update a quote
     *
     * @return Response
     */
    public function update($id, $params)
    {
        $profileId = $this->mustHaveProfileId();
        return $this->client->request("PATCH", "v3/profiles/{$profileId}/quotes/{$id}", $params);
    }

    /**
     * Retrieve quote by id
     *
     * @param Int $id Quote Id
     *
     * @return Response
     */
    public function retrieve($id)
    {
        $profileId = $this->mustHaveProfileId();
        return $this->client->request("GET", "v3/profiles/{$profileId}/quotes/{$id}");
    }

}