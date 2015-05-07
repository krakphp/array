<?php

/**
 * recursivley expands a flattened array into a heirarchy of arrays
 * based on a key separator
 * @param mixed $iterable
 * @return array returns the same array
 */
function array_expand($iterable, $separator = '.')
{
    $array = [];
    $keys_to_recurse = [];
     foreach ($iterable as $key => $value) {
        $sep_position = strpos($key, $separator);

        if ($sep_position === false) {
            $array[$key] = $value; /* copy over the value verbatim */
            continue;
        }

        $prefix = substr($key, 0, $sep_position);
        $suffix = substr($key, $sep_position + 1);

        if (!array_key_exists($prefix, $array)) {
            $array[$prefix] = [];
            $keys_to_recurse[] = $prefix;
        }

        $array[$prefix][$suffix] = $value;
     }

     foreach ($keys_to_recurse as $key) {
        $array[$key] = array_expand($array[$key], $separator);
     }

     return $array;
}

/**
 * Creates a new indexed array same as the old array except the index/key of
 * the new array elements are the value of array column at $key
 * @param mixed $iterable the input array
 * @param string $key the column name to get the index
 * @return array
 */
function array_index_column($iterable, $key)
{
    $map = [];
    foreach ($iterable as $row) {
        $map[$row[$key]] = $row;
    }

    return $map;
}
