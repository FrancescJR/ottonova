<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Application\Employee\PlainObject;

use Cesc\Ottivio\Domain\Employee\Employee;

class EmployeeVacationPO
{
    public $employeeName;
    public $vacationDays;

    public function __construct(Employee $employee, $vacationDays)
    {
        $this->employeeName = $employee->getName()->value();
        $this->vacationDays = $vacationDays;
    }

    public function consoleOutput(): string
    {
        return $this->employeeName.": ".(string)$this->vacationDays;
    }

}
