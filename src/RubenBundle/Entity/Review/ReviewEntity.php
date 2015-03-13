<?php

namespace RubenBundle\Entity\Review;

class ReviewEntity
{

    /**
     * @var Int
     */
    private $id;

    /**
     * @var String
     */
    private $text;


    /**
     * @return String
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param String $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



}