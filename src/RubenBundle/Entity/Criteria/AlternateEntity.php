<?php

namespace RubenBundle\Entity\Criteria;

class AlternateEntity
{

    /**
     * @var String
     */
    private $desc;

    /**
     * @var array
     */
    private $adjectives;

    /**
     * @return String
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param String $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return array
     */
    public function getAdjectives()
    {
        return $this->adjectives;
    }

    /**
     * @param array $adjectives
     */
    public function setAdjectives($adjectives)
    {
        $this->adjectives = $adjectives;
    }



}