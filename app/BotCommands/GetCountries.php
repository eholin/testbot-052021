<?php

namespace botexample\BotCommands;

use botexample\BotApi;
use botexample\BotInterface;
use botexample\LeadsData\GetCountriesAPI;

/**
 * Class GetCountries
 * @package botexample\BotCommands
 */
class GetCountries extends BotApi implements BotInterface
{

    /**
     * @throws \Exception
     */
    public function sendAnswer()
    {
        $countries = new GetCountriesAPI();
        $names = $countries->getCountriesNames();
        if (count($names)) {
            arsort($names);
            $list = array_slice($names, 0, 10);
            $message = implode(PHP_EOL, $list);
        }

        if (isset($message)) {
            $this->sendMessage($message);
        }
    }
}
