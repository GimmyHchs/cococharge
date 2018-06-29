<?php

namespace Tests\Unit\Helpers;

use App\Helpers\KeySignHelper;
use Tests\TestCase;

class KeySignHelperTest extends TestCase
{
    public function testHasKeySign()
    {
        $this->assertTrue(KeySignHelper::hasKeySign('asidhioqw*'));
        $this->assertFalse(KeySignHelper::hasKeySign('asidhioqw'));
    }

    public function testHasTriggerSign()
    {
        $this->assertTrue(KeySignHelper::hasTriggerSign('*asidhioqw*'));
        $this->assertFalse(KeySignHelper::hasTriggerSign('qwejohdsf*'));
    }

    public function testCutTriggerSign()
    {
        $this->assertEquals('abcdefg', KeySignHelper::cutTriggerSign('*abcdefg'));
    }

    public function testCutTriggerSignWontCutWhenNoSign()
    {
        $this->assertEquals('abcdefg', KeySignHelper::cutTriggerSign('abcdefg'));
    }
}
