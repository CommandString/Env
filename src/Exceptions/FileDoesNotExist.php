<?php

namespace CommandString\Env\Exceptions;

class FileDoesNotExist extends \Exception {
    public function __construct(string $file_path) {
        parent::__construct("$file_path does not exist");
    }
}