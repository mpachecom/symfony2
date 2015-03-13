<?php

namespace RubenBundle\Entity\Review;

class ReviewResultEntity
{
    /**
     * @var Int
     */
    private $id;

    /**
     * @var Int
     */
    private $hotelId;

    /**
     * @var String
     */
    private $review;

    /**
     * @var Int
     */
    private $positivesFound;

    /**
     * @var array String
     */
    private $positives;

    /**
     * @var Int
     */
    private $negativesFound;

    /**
     * @var array String
     */
    private $negatives;

    /**
     * @var Int
     */
    private $score;


    /**
     * @return Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param String $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * @return Int
     */
    public function getNegativesFound()
    {
        return $this->negativesFound;
    }

    /**
     * @param Int $negativesFound
     */
    public function setNegativesFound($negativesFound)
    {
        $this->negativesFound = $negativesFound;
    }

    /**
     * @return Int
     */
    public function getPositivesFound()
    {
        return $this->positivesFound;
    }

    /**
     * @param Int $positivesFound
     */
    public function setPositivesFound($positivesFound)
    {
        $this->positivesFound = $positivesFound;
    }

    /**
     * @return Int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param Int $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return String
     */
    public function getNegatives()
    {
        return $this->negatives;
    }

    /**
     * @param String $negatives
     */
    public function setNegatives($negatives)
    {
        $this->negatives = $negatives;
    }

    /**
     * @return String
     */
    public function getPositives()
    {
        return $this->positives;
    }

    /**
     * @param String $positives
     */
    public function setPositives($positives)
    {
        $this->positives = $positives;
    }

    /**
     * @return Int
     */
    public function getHotelId()
    {
        return $this->hotelId;
    }

    /**
     * @param Int $hotelId
     */
    public function setHotelId($hotelId)
    {
        $this->hotelId = $hotelId;
    }




}
