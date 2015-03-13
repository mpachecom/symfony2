<?php

namespace RubenBundle\Tests\Entity;

use RubenBundle\Entity\Criteria\AlternateEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class AlternateEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new AlternateEntity();
    }

    public function test_getSetDesc(){

        $desc = "foo foo foo";
        $this->underTest->setDesc($desc);
        $this->assertSame(
            $desc,
            $this->underTest->getDesc()
        );

    }

    public function test_getSetAdjectives(){

        $adjectives = array();
        $this->underTest->setAdjectives($adjectives);
        $this->assertSame(
            $adjectives,
            $this->underTest->getAdjectives()
        );

    }

}