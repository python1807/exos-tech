<?php
namespace MyCampus\Repository;
use MyCampus\Observable\InternalTeacherSalary;


/**
 * Class InternalSalaryRepository
 * @package MyCampus\Repository
 */
class InternalSalaryRepository implements InternalSalaryRepositoryInterface
{
    const SAVE_FILE_PATH = './files/internalSalary/internalSalary.json';

    public function __construct()
    {
    }


    /**
     * @return InternalTeacherSalary
     */
    public function getObservableObject():InternalTeacherSalary
    {
        $internalSalaryJson =  file_get_contents(self::SAVE_FILE_PATH);
        $internalSalaryObservable = new InternalTeacherSalary();
        if(isset($internalSalaryJson->salary)){
            $internalSalaryObservable->updateInternalTeacherSalary($internalSalaryJson->salary);
        }

        return $internalSalaryObservable;
    }

    /**
     * @param $salary
     */
    public function updateInternalSalary($salary){
        $salary = ['salary'=>$salary];
        file_put_contents(self::SAVE_FILE_PATH, json_encode($salary));
    }


}