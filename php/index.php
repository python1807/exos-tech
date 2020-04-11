<?php
include 'autoloader.php';
use MyCampus\Repository\CampusRepository;

$campus = new MyCampus\Model\Campus('canet', 'hérault', 6);
$student = new MyCampus\Model\Student('1', 'Pierre', 'FLIPO');
$externalTeacher = new MyCampus\Model\ExternalTeacher('1', 'Pierre', 'FLIPO', '1000');
$internalTeacher = new MyCampus\Model\InternalTeacher('2', 'Claire', 'FLIPO');
$internalTeacher2 = new MyCampus\Model\InternalTeacher('3', 'Claire', 'FLIPO');
$internalTeacherSalary = new MyCampus\Observable\InternalTeacherSalary();
$internalTeacherSalary->updateInternalTeacherSalary(1000);
$campus->addStudent($student);
$campus->addTeacher($externalTeacher);
$campus->addTeacher($internalTeacher);
$campus->addTeacher($internalTeacher2);
$internalTeacherSalary->attach($internalTeacher);
$internalTeacherSalary->attach($internalTeacher2);
var_dump($internalTeacher->getSalary());
$internalTeacherSalary->updateInternalTeacherSalary(1500);
var_dump($internalTeacher->getSalary());
var_dump(json_encode($campus));
//CampusRepository::save($campus);
//CampusRepository::getAll();
$internalSalaryRepository = new \MyCampus\Repository\InternalSalaryRepository();
$campusRepository = new CampusRepository($internalSalaryRepository);
$allCampus = $campusRepository->getAll();
var_dump($allCampus);
$campusRepository->updateAllInternalTeachersSalary(1000);
var_dump($allCampus);

echo $campus->getCity();