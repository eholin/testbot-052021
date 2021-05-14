<?php


namespace botexample;

/**
 * Class RemoteQuery
 * @package botexample
 */
class RemoteQuery
{

    private $url;

    public function __construct($url)
    {
        if (!$url) {
            throw new \Exception('Не задан URL');
        }

        $this->url = $url;
    }

    /**
     * @return bool|string
     */
    public function getQuery()
    {
        return $this->curl();
    }

    /**
     * @param $params
     * @return bool|string
     * @throws \Exception
     */
    public function postQuery($params)
    {
        if (!$params) {
            throw new \Exception('Не заданы параметры запроса');
        }

        return $this->curl('post', $params);
    }

    /**
     * @param null $method
     * @param null $params
     * @return bool|string
     */
    private function curl($method = null, $params = null)
    {
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_USERAGENT, 'BotExample/1.0');
            curl_setopt($curl, CURLOPT_URL, $this->url);

            if ($method == 'post') {
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_TIMEOUT, 10);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            }

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $out = curl_exec($curl);

            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $code = (int)$code;
            $errors = [
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            ];

            try {
                if ($code < 200 || $code > 204) {
                    throw new \Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
                }
            } catch (\Exception $e) {
                die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $out;
    }

}
