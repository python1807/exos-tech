<?php
/**
 * Created by IntelliJ IDEA.
 * User: pflip
 * Date: 12/04/2020
 * Time: 01:13
 */

namespace MyCampus\Repository;


use MyCampus\Model\Campus;

/**
 * Class CampusRepository
 * @package MyCampus\Repository
 */
interface CampusRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param $salary
     */
    public function updateAllInternalTeachersSalary(int $salary);

    /**
     * @param string $city
     * @param string $region
     * @return Campus||null
     */
    public function getOne(string $city, string $region): ?Campus;

    /**
     * @param Campus $campus
     */
    public function save(Campus $campus);
}