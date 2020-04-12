<?php
/**
 * Created by IntelliJ IDEA.
 * User: pflip
 * Date: 12/04/2020
 * Time: 01:12
 */
namespace MyCampus\Specification;

use MyCampus\Model\Student;

interface CanAddStudentRegardingStudentListInterface
{
    public function isSatisfiedBy(Student $student): bool;
}