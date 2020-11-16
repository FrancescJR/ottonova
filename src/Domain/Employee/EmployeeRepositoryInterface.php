<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee;


use Cesc\Ottivio\Domain\Employee\Exception\EmployeeNotFoundException;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;

interface EmployeeRepositoryInterface
{
    /**
     * @return Employee[]
     */
    public function findAll(): array;

    /**
     * @param EmployeeName $employeeName
     *
     * @return Employee
     * @throws EmployeeNotFoundException
     */
    public function getWithContract(EmployeeName $employeeName):Employee;

}
