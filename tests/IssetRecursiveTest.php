<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class IssetRecursiveTest extends TestCase
{
    public function testOneKey()
    {
        $data = ['test' => true];
        $result = isset_recursive('test', $data);

        $this->assertTrue($result);
    }

    public function testOneKeyAsArray()
    {
        $data = ['test' => true];
        $result = isset_recursive(['test'], $data);

        $this->assertTrue($result);
    }

    public function testMultipleKey()
    {
        $data = ['test' => true, 'check' => false];
        $result = isset_recursive('test', $data);

        $this->assertTrue($result);
    }

    public function testNestedArray()
    {
        $data = ['test' => ['check' => true]];
        $result = isset_recursive('test', $data);

        $this->assertTrue($result);
    }

    public function testNestedKey()
    {
        $data = ['test' => ['check' => true]];
        $result = isset_recursive(['test','check'], $data);

        $this->assertTrue($result);
    }

    public function testMultipleNesting()
    {
        $data = ['test' => ['check' => ['ok' => true]]];
        $result = isset_recursive(['test','check', 'ok'], $data);

        $this->assertTrue($result);
    }

    public function testNotExistingKey()
    {
        $data = ['test' => true];
        $result = isset_recursive('check', $data);

        $this->assertFalse($result);
    }

    public function testNotExistingNestedKey()
    {
        $data = ['test' => ['check' => true]];
        $result = isset_recursive(['test', 'ok'], $data);

        $this->assertFalse($result);
    }
}
