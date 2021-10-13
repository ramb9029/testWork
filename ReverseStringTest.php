<?php
namespace Test;

require_once 'ReverseString.php';
//use App\ReverseString;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReverseString;

class ReverseStringTest extends TestCase
{
    public function testGetReverseWordsString()
    {
        $string = new ReverseString();
        $string->reverseString = 'Привет мир!';
        $this->assertSame('Тевирп рим!', $string->getReverseWordsString());

        $string->reverseString = 'ПриВет мир!!! HEllo World!';
        $this->assertSame('ТевИрп рим!!! OLleh Dlrow!', $string->getReverseWordsString());
    }

    public function testFailGetReverseWordsString()
    {
        $string = new ReverseString();
        $this->assertEquals('fail', $string->getReverseWordsString());
    }

    public function testPrivateGetReverseWord()
    {
        $class = new ReflectionClass('ReverseString');
        $reverseWordMethod = $class->getMethod('getReverseWord');
        $reverseWordMethod->setAccessible(true);
        $string = new ReverseString();


        $result = $reverseWordMethod->invoke($string, 'Word!');
        $this->assertSame('Drow!', $result);

        $result = $reverseWordMethod->invoke($string, 'WhatIts2More');
        $this->assertSame('EromSti2Tahw', $result);
    }

    public function testPrivateGetReverseCharOnArray()
    {
        $class = new ReflectionClass('ReverseString');
        $reverseCharMethod = $class->getMethod('getReverseCharOnArray');
        $reverseCharMethod->setAccessible(true);
        $string = new ReverseString();

        $testArray = mb_str_split('Hello');
        $result = $reverseCharMethod->invoke($string, $testArray, 1, 3);
        $resultSuccess = mb_str_split('Hlleo');
        $this->assertSame($resultSuccess, $result);

        $testArray = mb_str_split('World!');
        $result = $reverseCharMethod->invoke($string, $testArray, 4, 0, true);
        $resultSuccess = mb_str_split('Dorlw!');
        $this->assertSame($resultSuccess, $result);
    }

}