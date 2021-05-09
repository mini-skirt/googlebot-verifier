Googlebot Verifier
==================

`mini-skirt/googlebot-verifier`

A simple library to verify if a web client / visitor is Googlebot.


# Requirements

PHP version > 8.0


# Usage Demo

```php
<?php
use MiniSkirt\Googlebot\Verifier;

// $ipAddress = $_SERVER['REMOTE_ADDR'];
Verifier::verifyDNS($ipAddress);       //-> true | false

// $userAgent = $_SERVER['HTTP_USER_AGENT'];
Verifier::verifyUserAgent($userAgent); //-> true | false
```