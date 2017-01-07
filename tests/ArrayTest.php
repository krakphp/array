<?php

namespace Krak\Arr\Tests;

use Krak\Arr;

class ArrayTest extends \PHPUnit_Framework_TestCase
{
    private function arrayExpandGen()
    {
        yield 'a' => 1;
        yield 'b.a' => 2;
        yield 'b.b' => 3;
        yield 'c.a.a' => 4;
        yield 'c.a.b' => 5;
        yield 'c.b' => 6;
        yield 'd' => 7;
    }

    private function arrayIndexColumnGen()
    {
        yield [
            'id' => 'a',
            'data' => 1,
        ];
        yield [
            'id' => 'c',
            'data' => 2,
        ];
        yield [
            'id' => 'b',
            'data' => 3,
        ];
        yield [
            'id' => 'd',
            'data' => 4,
        ];
    }

    public function testArrayExpand()
    {
        $expected = [
            'a' => 1,
            'b' => [
                'a' => 2,
                'b' => 3,
            ],
            'c' => [
                'a' => [
                    'a' => 4,
                    'b' => 5,
                ],
                'b' => 6,
            ],
            'd' => 7,
        ];

        $this->assertEquals($expected, arr\expand($this->arrayExpandGen()));
    }

    public function testArrayIndexColumn()
    {
        $expected = [
            'a' => ['id' => 'a', 'data' => 1],
            'b' => ['id' => 'b', 'data' => 3],
            'c' => ['id' => 'c', 'data' => 2],
            'd' => ['id' => 'd', 'data' => 4],
        ];

        $this->assertEquals(
            $expected,
            arr\index_by($this->arrayIndexColumnGen(), 'id')
        );
    }

    public function testArrayUdiffStable()
    {
        $expected = [1,2];

        $this->assertEquals(
            $expected,
            arr\udiff_stable([1,2,3,4], [3,4], function($a, $b){return $a != $b;})
        );
    }

    public function testGetElse()
    {
        $this->assertTrue(arr\get(['a' => false], 'b', true));
    }
    public function testGet()
    {
        $this->assertFalse(arr\get(['a' => false], 'a', true));
    }
    public function testGetNested() {
        $this->assertTrue(arr\get(['a' => ['b' => 1]], 'a.b') === 1);
    }
    public function testSet() {
        $data = [];
        Arr\set($data, 'key', 'value');
        $this->assertTrue($data['key'] === 'value');
    }
    public function testSetNested() {
        $data = [];
        Arr\set($data, 'a.b', 'value');
        $this->assertTrue($data['a']['b'] === 'value');
    }
    public function testSetNestedException() {
        $data = ['a' => 1];
        try {
            Arr\set($data, 'a.b', 'value');
            $this->assertTrue(false);
        } catch (\LogicException $e) {
            $this->assertTrue(true);
        }
    }
    public function testDel() {
        $data = ['a' => ['b' => 1, 'c' => 2]];
        Arr\del($data, 'a.b');
        $this->assertTrue($data['a'] == ['c' => 2]);
    }

    public function testBag() {
        $bag = new Arr\Bag();

        $bag->set('a.b', 1);
        $bag->set('a.c', 2);
        $bag->del('a.c');

        $valid = $bag->get('a.c', 5) === 5 &&
            $bag->get('a.b', 5) === 1 &&
            $bag['a']['b'] == 1;
        $this->assertTrue($valid);
    }
}
