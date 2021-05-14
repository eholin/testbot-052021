<?php


namespace botexample\LeadsData;

use botexample\LeadsApi;

/**
 * Class GetUserAPI
 * @package botexample\LeadsData
 */
class GetUserAPI extends LeadsApi
{

    private $user_data;

    public function __construct()
    {
        $this->user_data = $this->getData('account');
    }

    /**
     * @return mixed|null
     */
    public function getUserID()
    {
        return (isset($this->user_data['data']['id'])) ? $this->user_data['data']['id'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getUserName()
    {
        return (isset($this->user_data['data']['name'])) ? $this->user_data['data']['name'] : null;
    }

}
