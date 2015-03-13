<?php

namespace RubenBundle\Utils\Helper;


use RubenBundle\Entity\Criteria\AdjectiveEntity;
use RubenBundle\Entity\Criteria\AlternateEntity;
use RubenBundle\Entity\Criteria\TopicEntity;
use RubenBundle\Entity\CriteriaEntity;
use RubenBundle\Entity\HotelReviewEntity;
use RubenBundle\Entity\Review\ReviewEntity;
use RubenBundle\Entity\Review\ReviewResultEntity;


class ReviewsHelper
{

    /**
     * @var array of strings
     */
    private $badWords;

    /**
     * @var array of strings
     */
    private $goodWords;

    /**
     * @return array
     */
    public function getBadWords()
    {
        return $this->badWords;
    }

    /**
     * @param array $badWords
     */
    public function setBadWords($badWords)
    {
        $this->badWords = $badWords;
    }

    /**
     * @return array
     */
    public function getGoodWords()
    {
        return $this->goodWords;
    }

    /**
     * @param array $goodWords
     */
    public function setGoodWords($goodWords)
    {
        $this->goodWords = $goodWords;
    }

    /**
     * @param $file
     * @return array
     */
    public function getReviews($file){


        $csv= file_get_contents($file);
        $arrayCsv = array_map("str_getcsv", explode("\n", $csv));

        $hotelIds = array();
        $key = key($arrayCsv);
        unset($arrayCsv[$key]);

        foreach ($arrayCsv as &$reviewItem) {

            if (!in_array($reviewItem[0], $hotelIds)) {
                array_push($hotelIds, $reviewItem[0]);
            }
        }

        $hotelsList = array();
        $reviewsList = array();
        $review = new ReviewEntity();
        $hotel = new HotelReviewEntity();
        foreach ($hotelIds as &$hotelId) {

            $hotel->setId($hotelId);
            foreach ($arrayCsv as &$reviewItem) {
                if ($reviewItem[0] == $hotelId){
                    $review->setId($reviewItem[1]);
                    $review->setText($reviewItem[2]);
                    array_push($reviewsList, $review);
                    $review = new ReviewEntity();
                }

            }

            $hotel->setReviews($reviewsList);
            array_push($hotelsList,$hotel);
            $hotel = new HotelReviewEntity();
            $reviewsList = array();
        }

        return $hotelsList;
    }

    public function getCriteria($file){

        $csv= file_get_contents($file);
        $arrayCsv = array_map("str_getcsv", explode("\n", $csv));


        //Entities
        $adjectiveEntity = new AdjectiveEntity();
        $alternateEntity = new AlternateEntity();

        $newTopic = new TopicEntity();

        //container arrays
        $arrayAdjectives = array();
        $arrayAlternates = array();


        //Final Topics list
        $newTopicList = array();

        //Final alternates list
        $newAlternateList = array();


        //list of all the bad words
        $badWordsList = array();

        //list of all the good words
        $goodWordsList = array();

        $first=false;
        foreach ($arrayCsv as &$arrayRows) {
            //The first row contains the header...
            if (!$first){
                $first = true;
            }else{

                //1 - Alternate
                //2 - Positive
                //3 - Negative

                //If there is a negative adjective
                if ($arrayRows[3] != ""){

                    //Add bad word to the bard words list
                    if (!in_array($arrayRows[3], $badWordsList)) {
                        array_push($badWordsList, $arrayRows[3]);
                    }

                    //set description
                    $adjectiveEntity->setDesc($arrayRows[3]);
                    //set type
                    $adjectiveEntity->setType('negative');
                    //added to adjectives list
                    array_push($arrayAdjectives,$adjectiveEntity);
                    //new AdjectiveEntity for the next one
                    $adjectiveEntity = new AdjectiveEntity();
                }

                //Same above but for positives adjectives
                if ($arrayRows[2] != ""){

                    //Add good word to the good words list
                    if (!in_array($arrayRows[2], $goodWordsList)) {
                        array_push($goodWordsList, $arrayRows[2]);
                    }

                    $adjectiveEntity->setDesc($arrayRows[2]);
                    $adjectiveEntity->setType('positive');
                    array_push($arrayAdjectives,$adjectiveEntity);
                    $adjectiveEntity = new AdjectiveEntity();
                }else{
                    array_push($arrayAdjectives,new AdjectiveEntity());
                }

                //Alternate
                if ($arrayRows[1] != ""){
                    //We set as a name of the alternate it's topic and the alternate desc ex: room-room
                    //Why? because we will need to know the topic for the final topic list
                    $alternateEntity->setDesc($arrayRows[0]. "-". $arrayRows[1]);
                    //Added adjectives to the alternate
                    $alternateEntity->setAdjectives($arrayAdjectives);
                    //Added alternate to the alternate list
                    array_push($arrayAlternates,$alternateEntity);
                    //We are done with this alternate, so new adjectives list and new alternate Entity
                    $arrayAdjectives = array();
                    $alternateEntity = new AlternateEntity();
                }
            }
        }



        foreach ($arrayAlternates as &$value) {


            $topicAlternate = explode("-", $value->getDesc());

            //If the first position is not blanck it's because we have the alternate that contains the topic as a part of the name
            if($topicAlternate[0] != ""){

                //Set the secon position as is the good one for the alternate
                $value->setDesc($topicAlternate[1]);

                //If the list is not empty means that the list is full of alternates and now we are ready for the next topic.
                if(!empty($newAlternateList)){
                    //Set alternates to the topic
                    $newTopic->setAlternates($newAlternateList);
                    //Save the topic to the final list of topics.
                    array_push($newTopicList,$newTopic);
                    //New topic obj
                    $newTopic = new TopicEntity();
                    //New alternate list
                    $newAlternateList = array();
                }

                //set description of topic
                $newTopic->setDesc($topicAlternate[0]);
                //Added to the new list of alternates
                array_push($newAlternateList,$value);

            }else{
                ////Just a normal alternate Hypehn removed
                $value->setDesc(ltrim ($value->getDesc(), '-'));
                //Added to the new list of alternates
                array_push($newAlternateList,$value);

            }

        }

        //Added final item
        $newTopic->setAlternates($newAlternateList);
        array_push($newTopicList,$newTopic);


        $this->setBadWords($badWordsList);
        $this->setGoodWords($goodWordsList);

        //Criteria object returned! yay!
        $criteria = new CriteriaEntity();
        $criteria->setTopics($newTopicList);

        return $criteria;
    }


    function getReviewsResult($hotels)
    {

        $expressionNegativeWords = "/\b" . join("|", $this->getBadWords()) . "\b/";
        $expressionPositiveWords = "/\b" . join("|", $this->getGoodWords()) . "\b/";

        $reviewsResult = new ReviewResultEntity();
        $reviewsResultList = array();
        $id = 1;

        foreach ($hotels as &$hotel) {

            //For each hotel
            foreach ($hotel->getReviews() as &$review) {

                $reviewText = $review->getText();

                $output_array_bad = array();
                preg_match_all($expressionNegativeWords, $reviewText, $output_array_bad);

                $arrayBadMatchDesc = array();
                foreach ($output_array_bad as &$element) {

                    foreach ($element as &$bad) {
                        array_push($arrayBadMatchDesc,$bad. " - 1");
                    }

                }

                $output_array_good = array();
                preg_match_all($expressionPositiveWords, $reviewText, $output_array_good);


                $arrayGoodMatchDesc = array();
                foreach ($output_array_good as &$element) {

                    foreach ($element as &$good) {
                        array_push($arrayGoodMatchDesc,$good. " + 1");
                    }

                }

                $reviewsResult->setId($id);
                $reviewsResult->setHotelId($hotel->getId());
                $reviewsResult->setReview($reviewText);
                $reviewsResult->setNegativesFound(count($output_array_bad[0]));
                $reviewsResult->setPositivesFound(count($output_array_good[0]));
                $reviewsResult->setNegatives($arrayBadMatchDesc);
                $reviewsResult->setPositives($arrayGoodMatchDesc);

                $score = $reviewsResult->getPositivesFound() - $reviewsResult->getNegativesFound();

                $reviewsResult->setScore($score);

                array_push($reviewsResultList,$reviewsResult);
                $reviewsResult = new ReviewResultEntity();
                $id++;

            }

        }



        return $reviewsResultList;

    }


    /**
     * @param $path
     */
    public function removeCsv($path){

        unlink($path. 'criteria.csv');
        unlink($path. 'reviews.csv');

    }

    /**
     * @param $rootDir
     * @param $request
     */
    public function processRequestFile($rootDir, $request){
        foreach ($request->files  as $uploadedFiles) {
            foreach ($uploadedFiles  as $file) {
                 $file->move($rootDir, $file->getClientOriginalName());

            }
        }
    }


}

