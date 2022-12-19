# commandstring/env #
A singleton class used for storing environment variables

# Requirements

* PHP 8.1
* Composer

# Creating with JSON file

## /env.json
```json
{
    "mysql": {
        "username": "root",
        "password": "password",
        "host": "127.0.0.1",
        "port": 3306
    }
}
```

## /index.php
```php
Env::createWithJsonFile(__DIR__."/env.json");
```

# Creating with an array

```php
Env::createFromArray(["hello" => "world"]);
```
### Note that nested arrays will be converted into an stdClass

# Getting / Setting variables

```php
Env::get("property");
Env::get()->property;

Env::get()->property = "value";
```