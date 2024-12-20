<?php

namespace TransferWise\Service;

class RecipientAccountService extends Service
{
    /**
     * Create a recipient account
     *
     * @param Array $params 
     *
     * @return Response
     */
    public function create($params)
    {
        return $this->client->request("POST", "v1/accounts", $this->validate($params));
    }

    /**
     * Create a recipient account
     *
     * @param Array $query Paging params 
     *
     * @return Response
     */
    public function all($query = [])
    {
        $path = $this->withQuery("v2/accounts", $query);
        return $this->client->request("GET", $path);
    }

    /**
     * Create a single recipient account by id
     *
     * @param Integer $id Account Id
     *
     * @return Response
     */
    public function retrieve($id)
    {
        return $this->client->request("GET", "v2/accounts/{$id}");
    }

    /**
     * Delete recipient account by id
     *
     * @param Integer $id Account Id
     *
     * @return Response
     */
    public function delete($id)
    {
        return $this->client->request("DELETE", "v2/accounts/{$id}");
    }

    /**
     * Retrieve recipient account requirements dynamically
     *
     * @param $quoteId the quote id
     *
     * @return mixed
     */
    public function getAccountRequirements($quoteId)
    {
        return $this->client->request("GET", "v1/quotes/{$quoteId}/account-requirements");
    }

    /**
     * Retrieve recipient account requirements dynamically
     *
     * @param int   $quoteId the quote id
     * @param array $params  the account parameters
     *
     * @return mixed
     */
    public function validateAccountRequirements($quoteId, $params)
    {
        return $this->client->request("POST", "v1/quotes/{$quoteId}/account-requirements", $this->validate($params));
    }
}