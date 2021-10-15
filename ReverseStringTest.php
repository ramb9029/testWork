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
        $string->reverseString = 'Привет не мир!';
        $this->assertSame('Тевирп ен рим!', $string->getReverseWordsString());

        $string->reverseString = 'ПриВет мир!!! HEllo World!';
        $this->assertSame('ТевИрп рим!!! OLleh Dlrow!', $string->getReverseWordsString());

        $string->reverseString = 'При-вет! - ДавНо не ви-деЛись.';
        $this->assertSame('Тев-ирп! - ОнвАд ен ьсилеД-ив.', $string->getReverseWordsString());


        $string->reverseString = 'вконтакте.ру!!';
        $this->assertSame('ур.еткатнокв!!', $string->getReverseWordsString());
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

        $result = $reverseWordMethod->invoke($string, '4pda.ru');
        $this->assertSame('ur.adp4', $result);

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
