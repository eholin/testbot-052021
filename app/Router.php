<?php


namespace botexample;

/**
 * Class Router
 * @package botexample
 */
class Router
{

    private $data;

    public function __construct()
    {
        $data_json = file_get_contents('php://input');
        $data = json_decode($data_json, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $this->data = $data;
        }
    }

    public function run()
    {
        $chat_id = $this->getChatID();
        $command = $this->getCommandFromText();
        if (!$command || !$chat_id) {
            $this->shutdown();
        }

        $classname = 'botexample\\BotCommands\\' . $command;

        if (class_exists($classname)) {
            $api = new $classname($chat_id);
            $api->sendAnswer();
        }

        $this->shutdown();
    }

    /**
     * @return string|null
     */
    private function getCommandFromText()
    {
        $text = $this->parseQueryToText();
        return ($text && mb_substr($text, 0, 1, 'UTF-8') == '/') ? ucfirst(trim($text, '/')) : null;
    }

    /**
     * @return mixed|null
     */
    private function getChatID()
    {
        return (!empty($this->data) && isset($this->data['message']['chat']['id'])) ? $this->data['message']['chat']['id'] : null;
    }

    /**
     * @return mixed|null
     */
    private function parseQueryToText()
    {
        return (!empty($this->data) && isset($this->data['message']['text'])) ? $this->data['message']['text'] : null;
    }

    private function shutdown()
    {
        http_response_code(200);
        die;
    }
}
