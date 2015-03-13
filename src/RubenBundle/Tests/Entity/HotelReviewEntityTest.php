<?php

namespace RubenBundle\Tests\Entity;

use RubenBundle\Entity\HotelReviewEntity;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HotelReviewEntityTest extends TestCase
{

    private $underTest;
    public function setUp()
    {
        $this->underTest = new HotelReviewEntity();
    }

    public function test_getSetId(){

        $id = 1;
        $this->underTest->setId($id);
        $this->assertSame(
            $id,
            $this->underTest->getId()
        );
    }

    public function test_getSetReviews(){

        $reviews = array();
        $this->underTest->setReviews($reviews);
        $this->assertSame(
            $reviews,
            $this->underTest->getReviews()
        );
    }

}