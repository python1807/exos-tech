<?php
namespace MyCampus\Repository;
use  MyCampus\Model\Campus;


class CampusRepository
{
    const SAVE_PATH = './files/campus';
    public function getAll(){

    }

    public function getOne(string $ville,string $region){

    }

    public static function save(Campus $campus){
        $campusId = $campus->getCampusId();
        $fp = fopen(self::SAVE_PATH.DIRECTORY_SEPARATOR.$campusId.'.json', 'w+');
        echo 'on save';
        fwrite($fp, json_encode($campus));
        fclose($fp);
    }
}