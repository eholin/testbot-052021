<?php

namespace botexample\botcommands;

use botexample\BotApi;
use botexample\BotInterface;

/**
 * Class Start
 * @package botexample\botcommands
 */
class Start extends BotApi implements BotInterface
{

    /**
     * @throws \Exception
     */
    public function sendAnswer() {
        $this->sendMessage('Привет! Я еще совсем маленький бот и знаю только команды /getUser и /getCountries.');
    }
}
