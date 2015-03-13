<?php

namespace RubenBundle\Entity\Criteria;

class AdjectiveEntity
{

    /**
     * @var String
     */
    private $desc;

    /**
     * @var String [positive-negative]
     */
    private $type;

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
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param String $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }




}