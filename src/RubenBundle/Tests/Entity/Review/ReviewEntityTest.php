<?php

namespace RubenBundle\Tests\Entity\Review;

use RubenBundle\Entity\Review\ReviewEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ReviewEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new ReviewEntity();
    }

    public function test_getSetId(){

        $id = 1;
        $this->underTest->setId($id);
        $this->assertSame(
            $id,
            $this->underTest->getId()
        );
    }

    public function test_getSetText(){

        $text = "foo foo";
        $this->underTest->setText($text);
        $this->assertSame(
            $text,
            $this->underTest->getText()
        );

    }

}