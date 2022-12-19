<?php

namespace CommandString\Env\Exceptions;

class EnvAlreadyCreated extends \Exception {
    public function __construct() {
        parent::__construct("Env has already been initialized");
    }
}