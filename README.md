# Array

The array library is just a simple collection of missing php array functions.

## API

    function expand($iterable, $separator = '.') -> array
    function index_by($iterable, $key) -> array
    function udiff_stable($a, $b, $cmp) -> array
    function get(array $data, $key, $else = null) -> mixed
