<?php

namespace  MyCampus\Model;

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

    public function addStudent(Student $s)
    {
        $this->students[] = $s;
    }

    public function removeStudent(Student $s)
    {
        if (($key = array_search($s, $this->students, true)) !== FALSE) {
            unset($this->students[$key]);
        }
        return $this->students;
    }

    public function getStudents()
    {
        return $this->students;
    }

    public function addTeacher(Teacher $t)
    {
        $this->teachers[] = $t;
    }

    public function removeTeacher(Teacher $t)
    {
        if (($key = array_search($t, $this->teachers, true)) !== FALSE) {
            unset($this->teachers[$key]);
        }
        return $this->teachers;
    }

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
}