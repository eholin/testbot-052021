<?php


namespace botexample\LeadsData;

use botexample\LeadsApi;

/**
 * Class GetCountriesAPI
 * @package botexample\LeadsData
 */
class GetCountriesAPI extends LeadsApi
{

    private $countries_data;

    public function __construct()
    {
        $this->countries_data = $this->getData('geo/getCountries');
    }

    /**
     * @return array
     */
    public function getCountriesNames()
    {
        if (isset($this->countries_data['data'])) {
            $countries = $this->countries_data['data'];
            if (is_array($countries) && count($countries)) {
                $names = array_column($countries, 'name');
            }
        }

        return (isset($names)) ? $names : array();
    }

}
