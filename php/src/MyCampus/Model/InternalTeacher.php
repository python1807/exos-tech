<?php
/**
 * Created by IntelliJ IDEA.
 * User: pflip
 * Date: 11/04/2020
 * Time: 13:00
 */

namespace MyCampus\Model;


use SplSubject;

/**
 * Class InternalTeacher
 * @package MyCampus\Model
 */
class InternalTeacher extends Teacher implements \SplObserver, \JsonSerializable
{

    /**
     * @var int
     */
    private $salary = 0;

    /**
     * InternalTeacher constructor.
     * @param $id
     * @param $firstName
     * @param $lastName
     */
    public function __construct($id, $firstName, $lastName)
    {
        parent::__construct($id, $firstName, $lastName);
    }

    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Receive update from subject InternalTeacherSalary
     * @link https://php.net/manual/en/splobserver.update.php
     * @param SplSubject $internalTeacherSalary <p>
     * The <b>SplSubject</b> notifying the observer of an update of internal teacher salary change.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function update(SplSubject $internalTeacherSalary)
    {
        $this->salary = $internalTeacherSalary->getInternalTeacherSalary();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return
        [
            'id'   => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'type' => 'internal'
        ];
    }

    public function getCliArrray(){
        return
        [
            'Id'   => $this->id,
            'Prénom' => $this->firstName,
            'Nom' => $this->lastName,
            'Type' => 'interne',
            'Salaire' => $this->salary
        ];
    }
}