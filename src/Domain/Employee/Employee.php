<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee;

use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeBirthdate;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;

class Employee
{
    /**
     * @var EmployeeName
     */
    private $name;

    /**
     * @var EmployeeBirthdate
     */
    private $birthdate;

    // Not setting the relationship with contract here, TBD, probably would be a one to one relationship


    /**
     * Employee constructor.
     *
     * @param EmployeeName $name
     * @param EmployeeBirthdate $birthdate
     */
    public function __construct(EmployeeName $name, EmployeeBirthdate $birthdate)
    {
        $this->name      = $name;
        $this->birthdate = $birthdate;
    }


}
