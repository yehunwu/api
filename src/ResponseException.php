<?php
namespace Yehunwu\api;

class ResponseException extends \Exception
{
    private $data;

    function __construct(int $code, array $data, string $message = ''){
        $this->data = $data;
        parent::__construct($message, $code);
    }

    function response()
    {
        return $this->data;
    }
}
