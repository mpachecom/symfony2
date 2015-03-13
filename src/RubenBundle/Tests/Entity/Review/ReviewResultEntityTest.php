<?php

namespace RubenBundle\Tests\Entity\Review;

use RubenBundle\Entity\Review\ReviewResultEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ReviewResultEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new ReviewResultEntity();
    }

    public function test_getSetId(){

        $id = 1;
        $this->underTest->setId($id);
        $this->assertSame(
            $id,
            $this->underTest->getId()
        );
    }

    public function test_getSeHotelId(){

        $hotelId = 1;
        $this->underTest->setHotelId($hotelId);
        $this->assertSame(
            $hotelId,
            $this->underTest->getHotelId()
        );

    }

    public function test_getReview(){

        $text = "foo foo";
        $this->underTest->setReview($text);
        $this->assertSame(
            $text,
            $this->underTest->getReview()
        );

    }

    public function test_getGetSetPositivesFound(){

        $pos = "foo,foo,foo";
        $this->underTest->setPositivesFound($pos);
        $this->assertSame(
            $pos,
            $this->underTest->getPositivesFound()
        );

    }

    public function test_getSetPositives(){

        $text = "foo foo";
        $this->underTest->setPositives($text);
        $this->assertSame(
            $text,
            $this->underTest->getPositives()
        );

    }

    public function test_getNegativesFound(){

        $neg = "foo,foo,foo";
        $this->underTest->setNegativesFound($neg);
        $this->assertSame(
            $neg,
            $this->underTest->getNegativesFound()
        );

    }

    public function test_getSetNegatives(){

        $text = "foo foo";
        $this->underTest->setNegatives($text);
        $this->assertSame(
            $text,
            $this->underTest->getNegatives()
        );

    }

    public function test_getSetScore(){

        $score = 5;
        $this->underTest->setScore($score);
        $this->assertSame(
            $score,
            $this->underTest->getScore()
        );

    }

}