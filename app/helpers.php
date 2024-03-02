<?php

if (!function_exists('pureify')) {
    function pureify($string)
    {
        return preg_replace('/[^A-Za-z0-9]/', '', $string);
    }
}
