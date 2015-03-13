<?php

namespace RubenBundle\Entity\Criteria;

class TopicEntity
{

    /**
     * @var String
     */
    private $desc;

    /**
     * @var array
     */
    private $alternates;

    /**
     * @return array
     */
    public function getAlternates()
    {
        return $this->alternates;
    }

    /**
     * @param array $alternates
     */
    public function setAlternates($alternates)
    {
        $this->alternates = $alternates;
    }

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

}