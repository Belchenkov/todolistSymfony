<?php

namespace AppBundle/Entity;

use Doctrine\ORM\Mapping as ORM;

class Todo
{
    private $id;
    private $name;
    private $category;
    private $description;
    private $priority;
    private $dueDate;
    private $createDate;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getDueDate()
    {
        return $this->due_date;
    }

    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;

        return $this;
    }

    public function getCreateDate()
    {
        return $this->create_date;
    }
}