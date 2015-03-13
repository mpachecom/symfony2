<?php

namespace RubenBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\TestCaseWebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class HomeControllerTest extends TestCaseWebTestCase
{

    public function test_indexAction()
    {
        $client = self::createClient();
        $client->request('GET', '/');

        $crawler = new Crawler($client->getResponse()->getContent());

        $this->assertContains("welcome",$crawler->filterXPath('//body/div/a')->text());
        $this->assertContains("Load default reviews & criteria",$crawler->filterXPath('//body/div/div/a')->text());
        $this->assertContains("Load your own files and process them with PHP",$crawler->filterXPath('//body/div/div[2]/a')->text());
        $this->assertContains("Load your own files and process them with JS",$crawler->filterXPath('//body/div/div[3]/a')->text());
        $this->assertContains("↑↑↑ Please select one of the options. ↑↑↑",$crawler->filterXPath("//div[@id = 'content']/div")->text());
    }

    public function test_loadDefaultReviewsAction()
    {
        $client = self::createClient();
        $client->request('GET', '/load-default-reviews/');

        $crawler = new Crawler($client->getResponse()->getContent());

        $this->assertContains("Hotel Id",$crawler->filterXPath("//table[@id='reviews-container']/thead/tr/th[1]")->text());
        $this->assertContains("Id",$crawler->filterXPath("//table[@id='reviews-container']/thead/tr/th[2]")->text());
        $this->assertContains("Review",$crawler->filterXPath("//table[@id='reviews-container']/thead/tr/th[3]")->text());
        $this->assertContains("Positive",$crawler->filterXPath("//table[@id='reviews-container']/thead/tr/th[4]")->text());
        $this->assertContains("Negative",$crawler->filterXPath("//table[@id='reviews-container']/thead/tr/th[5]")->text());
        $this->assertContains("Score",$crawler->filterXPath("//table[@id='reviews-container']/thead/tr/th[6]")->text());
        $this->assertContains("I was excited to stay at this Hotel. It looked cute and was reasonable",$client->getResponse()->getContent());
    }

    public function test_uploadPhpAction()
    {
        $client = self::createClient();
        $client->request('GET', '/load-manual-php/');

        $crawler = new Crawler($client->getResponse()->getContent());
        $this->assertContains("Criteria",$crawler->filterXPath("//div[@id='form']/div[1]/label")->text());
        $this->assertContains("Reviews",$crawler->filterXPath("//div[@id='form']/div[2]/label")->text());
        $this->assertContains("Do it with ajax",$crawler->filterXPath("//div[@id='form']/div[3]/label")->text());
        $this->assertContains("Load",$crawler->filterXPath("//div[@id='form']/div[4]/button")->text());
    }

    public function test_uploadJsAction()
    {
        $client = self::createClient();
        $client->request('GET', '/load-manual-js/');

        $crawler = new Crawler($client->getResponse()->getContent());
        $this->assertContains("load reviews:",$crawler->filterXPath("//div[@id='content']/div/span[1]")->text());
        $this->assertContains("load criteria:",$crawler->filterXPath("//div[@id='content']/div/span[2]")->text());
    }

    public function test_liveReviewAction()
    {

        $client = self::createClient();
        $client->request('GET', '/live-review/');

        $crawler = new Crawler($client->getResponse()->getContent());
        $this->assertContains("Write your review and check if it's positive or not against your positive and negative words",$crawler->filterXPath("//div[@id='content']/div[1]")->text());
        $this->assertEmpty($crawler->filter("textarea")->text());
    }

}
