<?php

namespace  MyCampus\Model;

use MyCampus\Specification\CanAddStudentRegardingStudentList;
use MyCampus\Exception\FullCampusException;
/**
 * Class Campus
 * @package Model
 */
class Campus implements \JsonSerializable
{
    private $city;
    private $region;
    private $capacity;
    private $students = [];
    private $teachers = [];

    /**
     * Campus constructor.
     * @param string $city
     * @param string $region
     * @param int $capacity
     */
    public function __construct(string $city, string $region, int $capacity)
    {
        $this->city = $city;
        $this->region = $region;
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getCampusId(){
        return hash ( 'sha256' , strtolower($this->city.$this->region));
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Campus
     */
    public function setCity(string $city): Campus
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return Campus
     */
    public function setRegion(string $region): Campus
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     * @return Campus
     */
    public function setCapacity(int $capacity): Campus
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @param Student $s
     */
    public function addStudent(Student $s)
    {
        // throw exception if capacity is reached
        if(count($this->students) == $this->capacity){
            throw new FullCampusException($this);
        }

        $canAddStudentRegardingStudentList = new CanAddStudentRegardingStudentList($this->students);
        if($canAddStudentRegardingStudentList->isSatisfiedBy($s)){
            $this->students[] = $s;
        }
    }

    /**
     * @param Student $s
     * @return array
     */
    public function removeStudent(Student $s)
    {
        if (($key = array_search($s, $this->students)) !== FALSE) {
            unset($this->students[$key]);
        }

        return $this->students;
    }

    /**
     * @return array
     */
    public function getStudents()
    {
        // Sort students by id asc
        usort( $this->students, function($a, $b) {return strcmp($a->getId(), $b->getId());});
        return $this->students;
    }

    /**
     * @param Teacher $t
     */
    public function addTeacher(Teacher $t)
    {
        $this->teachers[] = $t;
    }

    /**
     * @param Teacher $t
     * @return array
     */
    public function removeTeacher(Teacher $t)
    {
        if (($key = array_search($t, $this->teachers)) !== FALSE) {
            unset($this->teachers[$key]);
        }
        return $this->teachers;
    }

    /**
     * @return array
     */
    public function getTeachers()
    {
        return $this->teachers;
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
            'city'   => $this->city,
            'region' => $this->region,
            'capacity' => $this->capacity,
            'teachers' => $this->teachers,
            'students' => $this->students
        ];
    }

    public function getCliArrray(){
        return
        [
            'Ville'   => $this->city,
            'Région' => $this->region,
            'Capacité' => $this->capacity
        ];
    }
}