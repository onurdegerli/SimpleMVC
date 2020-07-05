<?php declare(strict_types=1);

if (!function_exists('dd'))
{
    function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        exit;
    }
}

if (!function_exists('array_flatten'))
{
    function array_flatten($array)
    {
        if (!is_array($array)) {
            return false;
        }

        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return
            $result;
    }
}

if (!function_exists('random_hexadecimal_color'))
{
    function random_hexadecimal_color()
    {
        return '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    }
}