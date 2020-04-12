<?php
namespace MyCampus\Repository;

use  MyCampus\Model\Campus;
use  MyCampus\Factory\CampusFactory;


/**
 * Class CampusRepository
 * @package MyCampus\Repository
 */
class CampusRepository implements CampusRepositoryInterface
{

    const SAVE_PATH = './files/campus';

    /**
     * @var InternalSalaryRepository
     */
    private $internalSalaryRepository;
    /**
     * @var \MyCampus\Observable\InternalTeacherSalary
     */
    private $internalSalaryObservableObject;

    /**
     * CampusRepository constructor.
     * @param InternalSalaryRepositoryInterface $internalSalaryRepository
     */
    public function __construct(InternalSalaryRepositoryInterface $internalSalaryRepository)
    {
        $this->internalSalaryRepository = $internalSalaryRepository;
        $this->internalSalaryObservableObject = $this->internalSalaryRepository->getObservableObject();
    }


    /**
     * @return array
     */
    public function getAll():array
    {
        $campusCollection = [];
        $filesCampus =  array_diff(scandir(self::SAVE_PATH), array('..', '.', '.keep'));
        foreach($filesCampus as $fileCampus){
            $campusJson = file_get_contents(self::SAVE_PATH.DIRECTORY_SEPARATOR.$fileCampus);
            $campusFactory = new CampusFactory($this->internalSalaryObservableObject);
            $campusCollection[] = $campusFactory->buildFromJson(json_decode($campusJson));
        }

        return $campusCollection;
    }

    /**
     * @param $salary
     */
    public function updateAllInternalTeachersSalary(int $salary)
    {
        //trigger event in order to update
        $this->internalSalaryObservableObject->updateInternalTeacherSalary($salary);
        $this->internalSalaryRepository->updateInternalSalary($salary);
    }

    /**
     * @param string $city
     * @param string $region
     * @return Campus||null
     */
    public function getOne(string $city, string $region):?Campus
    {
        $fileHash =  hash( 'sha256' , strtolower($city.$region));

        if(file_exists(self::SAVE_PATH.DIRECTORY_SEPARATOR.$fileHash.'.json')){
            $campusJson = file_get_contents(self::SAVE_PATH.DIRECTORY_SEPARATOR.$fileHash.'.json');
            $campusFactory = new CampusFactory($this->internalSalaryObservableObject);
            return $campusFactory->buildFromJson(json_decode($campusJson));
        }

        return null;
    }



    /**
     * @param Campus $campus
     */
    public function save(Campus $campus, $isUpdate = false)
    {
        $campusId = $campus->getCampusId();

        //if campus does not exist or if its update. We save it
        if(!file_exists(self::SAVE_PATH.DIRECTORY_SEPARATOR.$campusId.'.json') || $isUpdate == true){
            $fp = fopen(self::SAVE_PATH.DIRECTORY_SEPARATOR.$campusId.'.json', 'w');
            fwrite($fp, json_encode($campus));
            fclose($fp);
            return true;
        } else {
            // else we do nothing to preserve current data
            return false;
        }

    }


    /**
     * @param Campus $campus
     */
    public function delete(Campus $campus)
    {
        $campusId = $campus->getCampusId();
        if(file_exists(self::SAVE_PATH.DIRECTORY_SEPARATOR.$campusId.'.json')){
            unlink(self::SAVE_PATH.DIRECTORY_SEPARATOR.$campusId.'.json');
        }
    }
}