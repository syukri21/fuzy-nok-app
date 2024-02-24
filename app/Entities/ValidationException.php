<?php

class ValidationException extends \Exception
{
    protected $code = 422;
    protected $message = 'Validation failed';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code, $previous);
    }
}