<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee;


use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;

interface EmployeeRepositoryInterface
{

    public function getWithContract(EmployeeName $employeeName):Employee;

}
