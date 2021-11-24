<?php

class ApiError
{
    function __construct(
        public $errorMessage,
    ) {
    }

    function getErrorMessage()
    {
        return $this->errorMessage;
    }
}