<?php

namespace RubenBundle\Tests\Entity;

use RubenBundle\Entity\CriteriaEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class CriteriaEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new CriteriaEntity();
    }

    public function test_getSetTopics(){

        $topics = array();
        $this->underTest->setTopics($topics);
        $this->assertSame(
            $topics,
            $this->underTest->getTopics()
        );

    }

}