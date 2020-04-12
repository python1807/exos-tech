<?php

namespace MyCampus\Model;

/**
 * Class Student
 * @package Model
 */
class Student implements \JsonSerializable
{
    private $id;
    private $firstName;
    private $lastName;

    /**
     * Student constructor.
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
    public function getId():string
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Campus
     */
    public function setId(int $id):Student
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
     * @return Student
     */
    public function setFirstName(string $firstName):Student
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
     * @return Student
     */
    public function setLastName(string $lastName):Student
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return
        [
            'id'   => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName
        ];
    }

    public function getCliArrray(){
        return
            [
                'Id'   => $this->id,
                'Prénom' => $this->firstName,
                'Nom' => $this->lastName
            ];
    }
}