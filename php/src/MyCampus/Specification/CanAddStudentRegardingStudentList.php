<?php
namespace MyCampus\Specification;

class CanAddStudentRegardingStudentList implements CanAddStudentRegardingStudentListInterface
{
    private $studentList;

    public function __construct(array $studentList)
    {
        $this->$studentList = $studentList;
    }

    public function isSatisfiedBy(Student $student): bool
    {
        $return = true;
        //Si les deux étudiants ont un ID, et que leurs ID sont identiques, alors ils sont égaux
        if($student->getId() != 0){
            foreach($this->studentList as $studentFromList){
                if($studentFromList->getId() == $student->getId()){
                    $return = false;
                }
            }
        } else {
            //Si deux étudiants n’ont pas dʼID, ils seront égaux si et seulement si leurs noms et prénoms sont égaux.
            foreach($this->studentList as $studentFromList) {
                if($studentFromList == $student){
                    return false;
                }
            }
        }

        return $return;

    }
}