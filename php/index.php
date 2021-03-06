<?php
//include 'autoloader.php';
require_once __DIR__ . '/vendor/autoload.php';

use MyCampus\Repository\CampusRepository;
use MyCampus\Repository\InternalSalaryRepository;
use MyCampus\Model\Campus;
use MyCampus\Model\Student;
use MyCampus\Model\ExternalTeacher;
use MyCampus\Model\InternalTeacher;
use MyCampus\Util\DisplayUtil;
use MyCampus\Util\ArgumentUtil;


$internalSalaryRepository = new InternalSalaryRepository();
$internalTeacherSalary = $internalSalaryRepository->getObservableObject();

$campusRepository = new CampusRepository($internalSalaryRepository);
$climate = new League\CLImate\CLImate;
$climate->addArt('./art');

$climate->animation('infomaniak')->enterFrom('top');

$climate->arguments->add([
    'action' => [
        'prefix'       => 'a',
        'longPrefix'   => 'action',
        'description'  => 'Action to do',
        'required'    => true,
    ]
]);
$climate->arguments->parse();
$action = $climate->arguments->get('action');

switch ($action){
    case 'list_campus':
        //return a console display of all campus
        $allCampus = $campusRepository->getAll();
        DisplayUtil::displayListOfCampus($allCampus, $climate);
        break;
    case 'get_campus':
        //return a console display of one campus with students, teachers details
        ArgumentUtil::getCampusArguments($climate);
        $climate->arguments->parse();
        $city = $climate->arguments->get('city');
        $region = $climate->arguments->get('region');
        $campus = $campusRepository->getOne(trim($city), trim($region));
        DisplayUtil::displayOneCampus($campus, $climate);
        break;
    case 'add_campus':
        //add a new campus to collection, save it and display list of all campus
        ArgumentUtil::addCampusArguments($climate);
        $climate->arguments->parse();
        $city = $climate->arguments->get('city');
        $region = $climate->arguments->get('region');
        $capacity = $climate->arguments->get('capacity');
        $campus = new Campus($city, $region, $capacity);
        $isSaved = $campusRepository->save($campus);
        if($isSaved){
            $allCampus = $campusRepository->getAll();
            DisplayUtil::displayListOfCampus($allCampus, $climate);
            $climate->bold()->green('Enregistrement réussi.');
        } else {
            $climate->bold()->red('Le campus existe déjà.');
        }
        break;
    case 'add_student':
    case 'remove_student':
        //add or remove a student from a campus, save it and display the campus details
        ArgumentUtil::addStudentArguments($climate);
        $climate->arguments->parse();
        $city = $climate->arguments->get('city');
        $region = $climate->arguments->get('region');
        $id = $climate->arguments->get('id');
        $firstname = $climate->arguments->get('firstname');
        $lastname = $climate->arguments->get('lastname');
        $campus = $campusRepository->getOne(trim($city), trim($region));
        if(!empty($campus)){
            $student = new Student($id, $firstname, $lastname);
            if($action == 'add_student'){
                $campus->addStudent($student);
            } else {
                $campus->removeStudent($student);
            }
            $campusRepository->save($campus, true);
            DisplayUtil::displayOneCampus($campus, $climate);
            $climate->bold()->green('Ajout/Suppression de l\'étudiant réussi.');
        } else {
            $climate->bold()->red('Impossible de trouver le campus.');
        }
        break;
    case 'add_teacher':
    case 'remove_teacher':
        //add or remove a teacher from a campus, save it and display the campus details
        ArgumentUtil::addTeacherArguments($climate);
        $climate->arguments->parse();
        $city = $climate->arguments->get('city');
        $region = $climate->arguments->get('region');
        $id = $climate->arguments->get('id');
        $firstname = $climate->arguments->get('firstname');
        $lastname = $climate->arguments->get('lastname');
        $type = $climate->arguments->get('type');
        $salary = $climate->arguments->get('salary') ?? 0;
        $campus = $campusRepository->getOne(trim($city), trim($region));
        if(!empty($campus)){
            if($type == 'interne'){
                $teacher = new InternalTeacher($id, $firstname, $lastname);
                $internalTeacherSalary->attach($teacher);
            } else {
                $teacher = new ExternalTeacher($id, $firstname, $lastname, $salary);
            }
            if($action == 'add_teacher') {
                $campus->addTeacher($teacher);
            } else {
                $campus->removeTeacher($teacher);
            }
            $campusRepository->save($campus, true);
            DisplayUtil::displayOneCampus($campus, $climate);
            $climate->bold()->green('Ajout/Suppression du professeur réussi.');
        } else {
            $climate->bold()->red('Impossible de trouver le campus.');
        }
        break;
    case 'delete_campus':
        //delete a campus, save change, display list of all campus
        ArgumentUtil::getCampusArguments($climate);
        $climate->arguments->parse();
        $city = $climate->arguments->get('city');
        $region = $climate->arguments->get('region');
        $campus = $campusRepository->getOne(trim($city), trim($region));
        if(!empty($campus)) {
            $campusRepository->delete($campus);
            $allCampus = $campusRepository->getAll();
            DisplayUtil::displayListOfCampus($allCampus, $climate);
        } else {
            $climate->bold()->red('Impossible de trouver le campus.');
        }
        break;
    case 'update_internal_salary':
        // update all teachers internal salary
        ArgumentUtil::addInternalSalaryArgument($climate);
        $climate->arguments->parse();
        $salary = $climate->arguments->get('salary') ?? 0;
        $internalSalaryRepository->updateInternalSalary($salary);
        $climate->bold()->green('Salaire des internes modifiés.');
        break;
    default:
        $climate->bold()->red('Commande inconnue.');
}

