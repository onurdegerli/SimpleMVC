<?php

namespace Core\Databases;

trait Helpers
{
    private static function getFields(array $data): string
    {
        $str = '';
        $keys = array_keys($data);
        foreach ($keys as $key) {
            $str .= " $key = :$key ";
        }

        return $str;
    }
}