<?php


namespace Vasqo\Rest\Api\Core\View;


use Vasqo\Rest\Api\Core\View\Interfaces\ViewInterface;

class JsonView implements ViewInterface
{
    /**
     * @param array $data
     * @param string $message
     * @return string
     */
    public function success(array $data, string $message = "") : string
    {
        return json_encode($this->createAnswer(true, $data, $message));
    }

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @return string
     */
    public function error(array $data, string $message = "", int $code = 200) : string
    {
        return json_encode($this->createAnswer(false, $data, $message, $code));
    }

    /**
     * @param bool $status
     * @param array $data
     * @param string $message
     * @param int $code
     * @return array
     */
    protected function createAnswer(bool $status, array $data = [], string $message = "", int $code = 200) : array
    {
        header("Content-Type: application/json");
        http_response_code($code);

        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}