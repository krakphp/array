<?php

namespace Krak\Arr;

/**
 * recursivley expands a flattened array into a heirarchy of arrays
 * based on a key separator
 * @param mixed $iterable
 * @return array returns the same array
 */
function expand($iterable, $separator = '.')
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
function index_by($iterable, $key)
{
    $map = [];
    foreach ($iterable as $row) {
        $map[$row[$key]] = $row;
    }

    return $map;
}

/**
 * Simple function for finding the difference of two arrays based off of a
 * comparison function. It supposedly does the same as array_udiff, however,
 * array_udiff does special optimizations create incorrect results if you're comparison
 * function doesn't return 0, 1, or -1. array_udiff sorts the values to be more efficient
 * and make less comparisons, but it doesn't work on values that can't really be sorted
 * @param array $a
 * @param array $b
 * @param callable $cmp returns 0 on match, anything else on different
 */
function udiff_stable($a, $b, $cmp)
{
    $ret = [];

    foreach ($a as $a_val) {
        $ok = true;

        foreach ($b as $b_val) {
            if ($cmp($a_val, $b_val) == 0) {
                $ok = false;
                break; /* b was in a, so it's excluded in the difference */
            }
        }

        if ($ok) {
            $ret[] = $a_val;
        }
    }

    return $ret;
}

/**
 * Get an element from the array or return $else
 * @param array $data
 * @param string $key
 * @param mixed $else
 * @return mixed
 */
function get(array $data, $key, $else = null)
{
    if (array_key_exists($key, $data)) {
        return $data[$key];
    }
    else {
        return $else;
    }
}
