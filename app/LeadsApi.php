<?php


namespace botexample;

/**
 * Class LeadsApi
 * @package botexample
 */
class LeadsApi
{

    const LEADS_URL_BASE = 'http://api.leads.su/webmaster/';
    const LEADS_TOKEN = '';

    /**
     * @param $method
     * @return int|mixed
     * @throws \Exception
     */
    public function getData($method)
    {
        if (!self::LEADS_TOKEN) {
            throw new \Exception('Отсутствует токен');
        }

        $url = self::LEADS_URL_BASE . $method . '?token=' . self::LEADS_TOKEN;

        try {
            $query = new RemoteQuery($url);
            $json_data = $query->getQuery();

            return $this->parseJson($json_data);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $json
     * @param bool $to_associative
     * @return int|mixed
     * @throws \Exception
     */
    public function parseJson($json, $to_associative = true)
    {
        if (!$json) {
            throw new \Exception('Отсутствует JSON');
        }

        $data = json_decode($json, $to_associative);
        $error = json_last_error();
        return ($error === JSON_ERROR_NONE) ? $data : $error;
    }
}
