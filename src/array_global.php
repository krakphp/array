<?php

/**
 * recursivley expands a flattened array into a heirarchy of arrays
 * based on a key separator
 * @param mixed $iterable
 * @return array returns the same array
 */
function array_expand($iterable, $separator = '.')
{
    return krak\arr\expand($iterable, $separator);
}

/**
 * @see array_index_by
 * @deprecated
 */
function array_index_column($iterable, $key)
{
    return array_index_by($iterable, $key);
}

/**
 * Creates a new indexed array same as the old array except the index/key of
 * the new array elements are the value of array column at $key
 * @param mixed $iterable the input array
 * @param string $key the column name to get the index
 * @return array
 */
function array_index_by($iterable, $key)
{
    return krak\arr\index_by($iterable, $key);
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
function array_udiff_stable($a, $b, $cmp)
{
    return krak\arr\udiff_stable($a, $b, $cmp);
}

/**
 * Get an element from the array or return $else
 * @param array $data
 * @param string $key
 * @param mixed $else
 * @return mixed
 */
 function array_get(array $data, $key, $else = null)
 {
    return krak\arr\get($data, $key, $else);
 }
