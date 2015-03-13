<?php

namespace RubenBundle\Tests\Entity;

use RubenBundle\Entity\Criteria\AdjectiveEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class AdjectiveEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new AdjectiveEntity();
    }

    public function test_getSetDesc(){

        $desc = "foo foo foo";
        $this->underTest->setDesc($desc);
        $this->assertSame(
            $desc,
            $this->underTest->getDesc()
        );

    }

    public function test_getSetType(){

        $type = "positive";
        $this->underTest->setType($type);
        $this->assertSame(
            $type,
            $this->underTest->getType()
        );

    }

}