<?php

namespace CommandString\Env;

use CommandString\Env\Exceptions\EnvAlreadyCreated;
use CommandString\Env\Exceptions\FileDoesNotExist;
use CommandString\Env\Exceptions\InvalidJsonString;
use CommandString\Utils\ArrayUtils;
use stdClass;

class Env {
    /**
     * @var stdClass
     */
    private stdClass $env;

    /**
     * @var Env
     */
    private static self $instance;

    public function __construct()
    {
        if (isset(self::$instance)) {
            throw new EnvAlreadyCreated();
        }

        $this->env = new stdClass;

        self::$instance = $this;
    }

    /**
     * @param string $json_location
     * @throws FileDoesNotExist 
     * @return Env
     */
    public static function createFromJsonFile(string $json_location): self
    {
        if (!file_exists($json_location)) {
            throw new FileDoesNotExist("$json_location is not a real file!");
        }

        $json_string = file_get_contents($json_location);

        $json_array = json_decode($json_string, true);
        
        if (!is_array($json_array)) {
            throw new InvalidJsonString($json_string);
        }

        return self::createFromArray($json_array);
    }

    /**
     * @param array $array
     * @return Env
     */
    public static function createFromArray(array $array): self
    {
        $instance = new self();

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $instance->$key = ArrayUtils::toStdClass($value);
                continue;
            }

            $instance->$key = $value;
        }

        return $instance;
    }
    
    /**
     * @param string $name
     */
    public function __get($name) {
        return $this->env->$name ?? null;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value) {
        if (isset($this->env->$name)) {
            return;
        }

        $this->env->$name = $value;
    }

    /**
     * @return mixed
     */
    public static function get(string $property = ""): mixed
    {
        return (empty($property)) ? self::$instance : self::$instance->$property;
    }
}
