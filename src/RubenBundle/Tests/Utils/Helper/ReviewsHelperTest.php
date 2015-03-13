<?php

namespace RubenBundle\Tests\Utils\Helper;

use RubenBundle\Utils\Helper\ReviewsHelper;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class ReviewsHelperTest extends TestCase
{
    public function test_indexAction()
    {

        $reviewsHelper = new ReviewsHelper();
        fopen("app/Resources/Tmp/criteria.csv", "w");
        fopen("app/Resources/Tmp/reviews.csv", "w");

        $reviewsHelper->removeCsv("app/Resources/Tmp/");

        $folderContent = json_encode(scandir("app/Resources/Tmp/"));

        $this->assertFalse(false, $this->containsText($folderContent,"criteria"));
        $this->assertFalse(false, $this->containsText($folderContent,"reviews"));
    }


    private function containsText($text,$word){
        return (strpos($text,$word) !== false);
    }

}

