<?php

namespace Krak\Tests;

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

        $this->assertEquals($expected, array_expand($this->arrayExpandGen()));
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
            array_index_column($this->arrayIndexColumnGen(), 'id')
        );
    }
}
