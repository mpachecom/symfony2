<?php

namespace RubenBundle\Tests\Entity;

use RubenBundle\Entity\Criteria\TopicEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class TopicEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new TopicEntity();
    }

    public function test_getSetDesc(){

        $desc = "foo foo foo";
        $this->underTest->setDesc($desc);
        $this->assertSame(
            $desc,
            $this->underTest->getDesc()
        );

    }

    public function test_getSetAlternates(){

        $alternates = array();
        $this->underTest->setAlternates($alternates);
        $this->assertSame(
            $alternates,
            $this->underTest->getAlternates()
        );

    }

}