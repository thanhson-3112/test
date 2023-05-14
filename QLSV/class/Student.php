<?php

class Student
{
    private $id;
    private $name;
    private $score;
    private $group;

    public function __construct($id, $name, $score, $group)
    {
        $this->id = $id;
        $this->name = $name;
        $this->score = $score;
        $this->group = $group;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }
}