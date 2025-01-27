<?php
namespace App;

class URLHelper{

    public static function withParam(array $data, string $param, string $value): string
    {
        return http_build_query(array_merge($data, [$param => $value]));
    }

    public static function withParams(array $data, array $params): string{
        return http_build_query(array_merge($params, $data));
    }
}