<?php

declare(strict_types = 1);

namespace Tests;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Abstract testcase class with useful assert methods
 *
 * @see https://gist.github.com/anthonyaxenov/3c0d56b8884856a58c75a6f787006546
 */
abstract class BasicTest extends TestCase
{
    /**
     * Asserts that $actual object or class is same as $expected one
     *
     * @param object|string $expected Object of any class or class name to check against to
     * @param object|string $actual Object of any class or class name to check
     */
    public function assertIsSameClass(object|string $expected, object|string $actual): void
    {
        $this->assertTrue($this->checkIsSameClass($expected, $actual));
    }

    /**
     * Checks that $actual object or class is same as $expected one
     *
     * @param object|string $class1 Object of any class or class name to check against to
     * @param object|string $class2 Object of any class or class name to check
     * @return bool
     */
    protected function checkIsSameClass(object|string $class1, object|string $class2): bool
    {
        return (is_object($class1) ? $class1::class : $class1) === (is_object($class2) ? $class2::class : $class2);
    }

    /**
     * Asserts that $actual object or class extends $expected one
     *
     * @param array $expected Array of classes to check against to
     * @param object|string $actual Object of any class or class name to check
     */
    public function assertExtendsClasses(array $expected, object|string $actual): void
    {
        $this->assertTrue($this->checkExtendsClasses($expected, $actual));
    }

    /**
     * Checks that $actual object or class extends $expected one
     *
     * @param string[] $parents Array of parent classes to check against to
     * @param object|string $class Object of any class or class name to check
     * @see https://www.php.net/manual/en/function.class-parents.php
     */
    protected function checkExtendsClasses(array $parents, object|string $class): bool
    {
        return !empty(array_intersect($parents, is_object($class) ? class_parents($class) : [$class]));
    }

    /**
     * Asserts that $actual object or class implements $expected interfaces
     *
     * @param string[] $expected Array of interface classes to check against to
     * @param object|string $actual Object of any class or class name to check
     * @see https://www.php.net/manual/en/function.class-implements.php
     */
    public function assertImplementsInterfaces(array $expected, object|string $actual): void
    {
        $this->assertNotEmpty(array_intersect($expected, is_object($actual) ? class_implements($actual) : [$actual]));
    }

    /**
     * Asserts that $actual object or class uses $expected traits
     *
     * @param string[] $expected Array of trait classes to check against to
     * @param object|string $actual Object of any class or class name to check
     * @see https://www.php.net/manual/en/function.class-uses.php#110752
     */
    public function assertUsesTraits(array $expected, object|string $actual): void
    {
        $found_traits = [];
        $check_class = is_object($actual) ? $actual::class : $actual;
        do {
            $found_traits = array_merge(class_uses($check_class), $found_traits);
        } while ($check_class = get_parent_class($check_class));
        foreach ($found_traits as $trait => $same) {
            $found_traits = array_merge(class_uses($trait), $found_traits);
        }
        $this->assertNotEmpty(array_intersect(array_unique($found_traits), $expected));
    }

    /**
     * Asserts that $value is instance Laravel Collection
     *
     * @param mixed $value
     */
    public function assertIsCollection(mixed $value): void
    {
        $this->assertIsObject($value);
        $this->assertIsIterable($value);
        $this->assertTrue(
            $this->checkIsSameClass(Collection::class, $value)
            || $this->checkExtendsClasses([Collection::class], $value)
        );
    }

    /**
     * Asserts that $array has all the $keys
     *
     * @param array $keys Keys to check
     * @param array|ArrayAccess|Arrayable $array Array in which to check keys presence
     * @return void
     */
    public function assertArrayHasKeys(array $keys, array|ArrayAccess|Arrayable $array): void
    {
        $array instanceof Arrayable && $array = $array->toArray();
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $array);
        }
    }

    /**
     * Asserts that $array has not all the $keys
     *
     * @param array $keys Keys to check
     * @param array|ArrayAccess|Arrayable $array Array in which to check keys absence
     * @return void
     */
    public function assertArrayHasNotKeys(array $keys, array|ArrayAccess|Arrayable $array): void
    {
        $array instanceof Arrayable && $array = $array->toArray();
        foreach ($keys as $key) {
            $this->assertArrayNotHasKey($key, $array);
        }
    }
}
