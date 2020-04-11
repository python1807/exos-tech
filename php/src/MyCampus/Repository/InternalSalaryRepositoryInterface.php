<?php
/**
 * Created by IntelliJ IDEA.
 * User: pflip
 * Date: 12/04/2020
 * Time: 01:13
 */

namespace MyCampus\Repository;


use MyCampus\Observable\InternalTeacherSalary;

/**
 * Class InternalSalaryRepository
 * @package MyCampus\Repository
 */
interface InternalSalaryRepositoryInterface
{
    /**
     * @return InternalTeacherSalary
     */
    public function getObservableObject(): InternalTeacherSalary;

    /**
     * @param $salary
     */
    public function updateInternalSalary($salary);
}