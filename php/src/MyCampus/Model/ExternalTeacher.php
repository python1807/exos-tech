<?php

namespace MyCampus\Model;


/**
 * Class ExternalTeacher
 * @package Model
 */
class ExternalTeacher extends Teacher implements \JsonSerializable
{
    private $salary;

    public function __construct($id, $firstName, $lastName, int $salary)
    {
        parent::__construct($id, $firstName, $lastName);
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param int $salary
     * @return ExternalTeacher
     */
    public function setSalary(int $salary):ExternalTeacher
    {
        $this->salary = $salary;
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
                'lastName' => $this->lastName,
                'salary' => $this->salary,
                'type' => 'external'
            ];
    }

    public function getCliArrray(){
        return
            [
                'Id'   => $this->id,
                'Prénom' => $this->firstName,
                'Nom' => $this->lastName,
                'Type' => 'externe',
                'Salaire' => $this->salary
            ];
    }

}