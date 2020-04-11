<?php
namespace MyCampus\Exception;

use MyCampus\Model\Campus;

class FullCampusException extends \RuntimeException
{

    public function __construct(
        Campus $campus,
        $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                "Campus '%s' maximum capacity reached",
                $campus->getCity()
            ),
            $code,
            $previous
        );

    }
}