<?php

namespace Helpers;

class HTTP
{
    static $baseUrl = "http://localhost/project";

    static function redirect($path, $query = "")
    {
        $url = static::$baseUrl . $path;

        if ($query) $url .= "?$query";

        header("location: $url");
        exit();
    }
}