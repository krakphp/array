<?php

/**
 * recursivley expands a flattened array into a heirarchy of arrays
 * based on a key separator
 */
function array_expand(&$array, $separator = '.')
{
    $keys_to_recurse = [];
     foreach ($array as $key => $value) {
        $sep_position = strpos($key, $separator);

        if ($sep_position === false) {
            continue;
        }

        $prefix = substr($key, 0, $sep_position);
        $suffix = substr($key, $sep_position + 1);

        if (!array_key_exists($prefix, $array)) {
            $array[$prefix] = [];
            $keys_to_recurse[] = $prefix;
        }

        $array[$prefix][$suffix] = $value;
        unset($array[$key]);
     }

     foreach ($keys_to_recurse as $key) {
        array_expand($array[$key], $separator);
     }
}
