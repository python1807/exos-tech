<?php
namespace MyCampus\Util;

use MyCampus\Model\Campus;

class DisplayUtil
{
    /**
     * @param array $listCampus
     * @param $climate
     */
    public static function displayListOfCampus(array $listCampus, $climate)
    {
        $listOfCampus = [];
        foreach ($listCampus as $campus) {
            $listOfCampus[] = $campus->getCliArrray();
        }

        if(!empty($listOfCampus)){
            $climate->redTable($listOfCampus);
        } else {
            $climate->bold()->red('Aucun campus disponible.');
        }
    }


    /**
     * @param Campus $campus
     * @param $climate
     */
    public static function displayOneCampus(Campus $campus, $climate)
    {
        if(!empty($campus)) {
            $climate->bold('Infos campus ' . $campus->getCity() . '/' . $campus->getRegion());
            $climate->redTable([$campus->getCliArrray()]);
            $listOfStudents = [];
            foreach($campus->getStudents() as $student){
                $listOfStudents[] = $student->getCliArrray();
            }

            $climate->bold('Liste des étudiants ');
            if(!empty($listOfStudents)){
                $climate->redTable($listOfStudents);
            } else {
                $climate->bold()->red('Aucun étudiant dans le campus.');
            }

            $listOfTeachers = [];
            foreach($campus->getTeachers() as $teacher){
                $listOfTeachers[] = $teacher->getCliArrray();
            }

            $climate->bold('Liste des professeurs ');
            if(!empty($listOfTeachers)){
                $climate->redTable($listOfTeachers);
            } else {
                $climate->bold()->red('Aucun professeur dans le campus.');
            }
        } else {
            $climate->bold('Aucun campus ne correspond à votre recherche');
        }
    }
}