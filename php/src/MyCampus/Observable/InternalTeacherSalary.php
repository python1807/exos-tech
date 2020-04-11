<?php

namespace  MyCampus\Observable;

class InternalTeacherSalary implements \SplSubject
{

    private $salary = 0;

    /**
     * @var SplObjectStorage
     */
    protected $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    /**
     * @inheritdoc
     */
    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
        $observer->update($this);
    }

    /**
     * @inheritdoc
     */
    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * @inheritdoc
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Update salary of InternalTeachers and notify all InternaTeachers object instances
     *
     * @param int $salary
     */
    public function updateInternalTeacherSalary(int $salary)
    {
        $this->salary = $salary;
        $this->notify();
    }

    /**
     * @return int $salary
     */
    public function getInternalTeacherSalary()
    {
        return $this->salary;
    }
}