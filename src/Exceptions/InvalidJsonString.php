<?php

namespace CommandString\Env\Exceptions;

class InvalidJsonString extends \Exception {
    public function __construct(private string $json_string) {
        parent::__construct("$json_string is an invalid json string");
    }

    public function getJsonString(): string
    {
        return $this->json_string;
    }
}