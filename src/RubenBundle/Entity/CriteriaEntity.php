<?php

namespace RubenBundle\Entity;

use RubenBundle\Entity\Criteria\TopicEntity;

class CriteriaEntity
{

    /**
     * @var TopicEntity array
     */
    private $topics;


    /**
     * @return array
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param array $topics
     */
    public function setTopics($topics)
    {
        $this->topics = $topics;
    }


}