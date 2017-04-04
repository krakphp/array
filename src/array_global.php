<?php

use Krak\Arr;

if (!function_exists("array_expand")) {
    function array_expand($iterable, $separator = '.') {
        return Arr\expand($iterable, $separator);
    }
}

if (!function_exists("array_index_by")) {
    function array_index_by($iterable, $key) {
        return Arr\index_by($iterable, $key);
    }
}

if (!function_exists("array_udiff_stable")) {
    function array_udiff_stable($a, $b, $cmp) {
        return Arr\udiff_stable($a, $b, $cmp);
    }
}

if (!function_exists("array_get")) {
    function array_get(array $data, $key, $else = null, $sep = '.') {
        return Arr\get($data, $key, $else, $sep);
    }
}

if (!function_exists("array_has")) {
    function array_has(array $data, $key, $sep = '.') {
        return Arr\has($data, $key, $sep);
    }
}

if (!function_exists("array_set")) {
    function array_set(array &$data, $key, $value, $sep = '.') {
        return Arr\set($data, $key, $sep);
    }
}

if (!function_exists("array_del")) {
    function array_del(array &$data, $key, $sep = '.') {
        return Arr\del($data, $key, $sep);
    }
}
