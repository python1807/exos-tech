<?php

namespace MyCampus\Factory;

use MyCampus\Model\Campus;
use MyCampus\Model\InternalTeacher;
use MyCampus\Model\ExternalTeacher;
use MyCampus\Model\Student;
use MyCampus\Observable\InternalTeacherSalary;

class CampusFactory implements CampusFactoryInterface
{
    private $internalTeacherSalary;

    public function __construct(InternalTeacherSalary $internalTeacherSalary)
    {
        $this->internalTeacherSalary = $internalTeacherSalary;
    }

    public function buildFromJson($jsonCampus):Campus
    {
        $campus = new Campus($jsonCampus->city, $jsonCampus->region, $jsonCampus->capacity);
        foreach ($jsonCampus->students as $student) {
            $student = new Student($student->id, $student->firstName, $student->lastName);
            $campus->addStudent($student);
        }

        foreach ($jsonCampus->teachers as $teacher) {
            if($teacher->type == 'external'){
                $teacher = new ExternalTeacher($teacher->id, $teacher->firstName, $teacher->lastName, $teacher->salary);
            } else {
                $teacher = new InternalTeacher($teacher->id, $teacher->firstName, $teacher->lastName);
                $this->internalTeacherSalary->attach($teacher);
            }
            $campus->addTeacher($teacher);
        }

        return $campus;
    }
}