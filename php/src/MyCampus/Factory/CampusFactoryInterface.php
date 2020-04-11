<?php
/**
 * Created by IntelliJ IDEA.
 * User: pflip
 * Date: 12/04/2020
 * Time: 01:15
 */

namespace MyCampus\Factory;

use MyCampus\Model\Campus;

interface CampusFactoryInterface
{
    public function buildFromJson($jsonCampus): Campus;
}