<?php

namespace MyCampus\Model;

/**
 * Class Teacher
 * @package Model
 */
abstract class Teacher
{
    protected $id;
    protected $firstName;
    protected $lastName;

    /**
     * Teacher constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(int $id, string $firstName, string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Teacher
     */
    public function setId(int $id):Teacher
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName():string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Teacher
     */
    public function setFirstName(string $firstName):Teacher
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName():string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Teacher
     */
    public function setLastName(string $lastName):Teacher
    {
        $this->lastName = $lastName;
        return $this;
    }


}