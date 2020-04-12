<?php

namespace MyCampus\Util;


class ArgumentUtil
{
    /**
     * @param $climate
     */
    public static function getCampusArguments($climate)
    {
        $climate->arguments->add([
            'city' => [
                'prefix'       => 'c',
                'longPrefix'   => 'city',
                'description'  => 'City where campus is implanted',
                'required'    => true,
            ],
            'region' => [
                'prefix'       => 'r',
                'longPrefix'   => 'region',
                'description'  => 'Region where campus is implanted',
                'required'    => true,
            ]
        ]);
    }

    /**
     * @param $climate
     */
    public static function addCampusArguments($climate)
    {
        $climate->arguments->add([
            'city' => [
                'prefix'       => 'c',
                'longPrefix'   => 'city',
                'description'  => 'City where campus is implanted',
                'required'    => true,
            ],
            'region' => [
                'prefix'       => 'r',
                'longPrefix'   => 'region',
                'description'  => 'Region where campus is implanted',
                'required'    => true,
            ],
            'capacity' => [
                'prefix'       => 'ca',
                'longPrefix'   => 'capacity',
                'description'  => 'capacity campus can offer',
                'required'    => true,
            ]
        ]);
    }

    /**
     * @param $climate
     */
    public static function addStudentArguments($climate)
    {
        $climate->arguments->add([
            'city' => [
                'prefix'       => 'c',
                'longPrefix'   => 'city',
                'description'  => 'City where campus is implanted',
                'required'    => true,
            ],
            'region' => [
                'prefix'       => 'r',
                'longPrefix'   => 'region',
                'description'  => 'Region where campus is implanted',
                'required'    => true,
            ],
            'id' => [
                'prefix'       => 'id',
                'longPrefix'   => 'id',
                'description'  => 'id of student',
                'required'    => true,
            ],
            'firstname' => [
                'prefix'       => 'fn',
                'longPrefix'   => 'firstname',
                'description'  => 'firstname of student',
                'required'    => true,
            ],
            'lastname' => [
                'prefix'       => 'ln',
                'longPrefix'   => 'lastname',
                'description'  => 'lastname of student',
                'required'    => true,
            ]
        ]);
    }

    /**
     * @param $climate
     */
    public static function addTeacherArguments($climate)
    {
        $climate->arguments->add([
            'city' => [
                'prefix'       => 'c',
                'longPrefix'   => 'city',
                'description'  => 'City where campus is implanted',
                'required'    => true,
            ],
            'region' => [
                'prefix'       => 'r',
                'longPrefix'   => 'region',
                'description'  => 'Region where campus is implanted',
                'required'    => true,
            ],
            'id' => [
                'prefix'       => 'id',
                'longPrefix'   => 'id',
                'description'  => 'id of teache',
                'required'    => true,
            ],
            'firstname' => [
                'prefix'       => 'fn',
                'longPrefix'   => 'firstname',
                'description'  => 'firstname of teache',
                'required'    => true,
            ],
            'lastname' => [
                'prefix'       => 'ln',
                'longPrefix'   => 'lastname',
                'description'  => 'lastname of teache',
                'required'    => true,
            ],
            'type' => [
                'prefix'       => 't',
                'longPrefix'   => 'type',
                'description'  => 'type of teacher',
                'required'    => true,
            ],
            'salary' => [
                'prefix'       => 's',
                'longPrefix'   => 'salary',
                'description'  => 'salary of teacher',
            ]
        ]);
    }

    /**
     * @param $climate
     */
    public static function addInternalSalaryArgument($climate)
    {
        $climate->arguments->add([
            'salary' => [
                'prefix'       => 's',
                'longPrefix'   => 'salary',
                'description'  => 'salary of internal teachers',
                'required'    => true,
            ]
        ]);
    }
}