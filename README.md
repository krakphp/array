# Array

The array library is just a simple collection of missing php array functions.

## Installation

Install with composer at `krak/array`

## Usage

```php
<?php

use Krak\Arr;

$data = [
    'a' => [
        'b' => 1,
    ],
];

$res = Arr\get($data, 'a.b');
assert($res == 1);

Arr\set($data, 'c.d', 2);
assert($data['c']['d'] == 2);

// or use the global aliases
array_get($data, 'a.b');
```

There also is a `Bag` class which provides an object oriented API for the arrays.

```php
<?php

use Krak\Arr;

$bag = new Arr\Bag();
$bag->set('a.b', 1);
var_dump($bag->raw());
/*
    array(1) {
      ["a"]=>
      array(1) {
        ["b"]=>
        int(1)
      }
    }
*/
```

## API

The following are defined in the namespace `Krak\Arr`:

    array expand(iterable $iterable, string $separator = '.')
    array index_by(iterable $iterable, string $key)
    array udiff_stable(iterable $a, iterable $b, callable $cmp)
    mixed get(array $data, string $key, mixed $else = null)
    mixed getIn(array $data, array $key, mixed $else = null);
    bool has(array $data, string $key, string $sep = '.')
    bool hasIn(array $data, array $key)
    void set(array &$data, string $key, mixed $value, string $sep = '.')
    void del(array &$data, string $key, string $sep = '.')

You can also use the globally defined aliases

    array_expand
    array_index_by
    array_udiff_stable
    array_get
    array_has
    array_set
    array_del

Or the `Krak\Arr\Bag` class:

```php
<?php

namespace Krak\Arr;

class Bag implements ArrayAccess {
    public function __construct(array $data = [])
    public function get($key, $else = null, $sep = '.')
    public function set($key, $value, $sep = '.')
    public function has($key, $sep = '.')
    public function del($key, $sep = '.')
    public function raw()
}
```

## Tests

Run tests with `phpunit`
