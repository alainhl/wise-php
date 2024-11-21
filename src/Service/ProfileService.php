<?php

namespace TransferWise\Service;

class ProfileService extends Service
{
    /**
     * Create a Personal Profile
     *
     * @param Array $params parameters needed to create a profile
     *
     * @return Response
     */
    public function createPersonalProfile($params)
    {
        return $this->client->request("POST", "v2/profiles/personal-profile", $params);
    }

    /**
     * Create a business profile
     *
     * @param Array $params parameters needed to create a profile
     *
     * @return Response
     */
    public function createBusinessProfile($params)
    {
        return $this->client->request("POST", "v2/profiles/business-profile", $params);
    }

    /**
     * Update Profile
     *
     * @param Array $params Profile fields
     *
     * @return Response
     */
    public function update($params)
    {
        return $this->client->request("PUT", "v1/profiles", $params);
    }

    /**
     * Get all profiles
     *
     * @return Response
     */
    public function all()
    {
        return $this->client->request("GET", "v2/profiles");
    }

    /**
     * Retrieve profile by Id
     *
     * @param Int $id Profile Id
     *
     * @return Response
     */
    public function retrieve($id)
    {
        return $this->client->request("GET", "v2/profiles/{$id}");
    }

    /**
     * List business directors for a profile
     *
     * @param Int $id Business Profile Id
     *
     * @return Response
     */
    public function directors($id)
    {
        return $this->client->request("GET", "v1/profiles/{$id}/directors");
    }

    /**
     * Create a business director for a profile 
     *
     * @param Int   $id     Profile Id
     * @param Array $params Parameters needed to create a business director
     *
     * @return Response
     */
    public function addDirector($id, $params)
    {
        return $this->client->request("POST", "v1/profiles/{$id}/directors", $params);
    }

    /**
     * Add identification document details to user profilz
     *
     * @param Int   $id     Profile Id
     * @param Array $params Parameters needed to create identification document
     *
     * @return Response
     */
    public function addIdentificationDocument($id, $params)
    {
        return $this->client->request(
            "POST",
            "v1/profiles/{$id}/verification-documents",
            $params
        );
    }

}