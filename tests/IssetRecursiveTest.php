<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IssetRecursiveTest extends TestCase
{
    public static function positiveDataProvider(): array
    {
        return [
            [['test' => true], 'test'],
            [['test' => true], ['test']],
            [['test' => true, 'check' => false], 'test'],
            [['test' => ['check' => true]], 'test'],
            [['test' => ['check' => true]], ['test','check']],
            [['test' => ['check' => ['ok' => true]]], ['test','check', 'ok']],
        ];
    }

    public static function negativeDataProvider(): array
    {
        return [
            [['test' => true], 'check'],
            [['test' => ['check' => true]], ['test', 'ok']],
        ];
    }

    #[DataProvider('positiveDataProvider')]
    public function testExisting(array $data, string|array $key): void
    {
        $this->assertTrue(isset_recursive($key, $data));
    }

    #[DataProvider('negativeDataProvider')]
    public function testNonExisting(array $data, string|array $key): void
    {
        $this->assertFalse(isset_recursive($key, $data));
    }
}
