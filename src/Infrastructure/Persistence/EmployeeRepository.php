<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Infrastructure\Persistence;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Contract;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Exception\InvalidContractStartingDateException;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractMinimumVacationDays;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractStartingDate;
use Cesc\Ottivio\Domain\Employee\Employee;
use Cesc\Ottivio\Domain\Employee\EmployeeRepositoryInterface;
use Cesc\Ottivio\Domain\Employee\Exception\EmployeeNotFoundException;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeBirthdate;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;
use DateTime;
use Exception;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private const DATA = [
        'Hans Müller'     => [
            'Hans Müller',
            '30.12.1950',
            '01.01.2001',
            null
        ],
        'Angelika Fringe' => [
            'Angelika Fringe',
            '09.06.1966',
            '15.01.2001',
            null
        ],
        'Peter Klever'    => [
            'Peter Klever',
            '12.07.1991',
            '15.05.2016',
            27
        ],
        'Marina Helter'   => [
            'Marina Helter',
            '26.01.1970',
            '15.01.2018',
            null
        ],
        'Sepp Meier'      => [
            'Sepp Meier',
            '23.05.1980',
            '01.12.2017',
            null
        ],
    ];

    /**
     * @return array
     * @throws InvalidContractStartingDateException
     */
    public function findAll(): array
    {
        $employees = [];
        foreach (self::DATA as $employeePlain) {

            $employees[] = $this->buildEmployee($employeePlain);
        }
        return $employees;
    }

    /**
     * @param EmployeeName $employeeName
     *
     * @return Employee
     * @throws EmployeeNotFoundException
     * @throws InvalidContractStartingDateException
     */
    public function getWithContract(EmployeeName $employeeName): Employee
    {
        if (! array_key_exists($employeeName->value(), self::DATA)) {
            throw new EmployeeNotFoundException("Employee with name {$employeeName->value()} not found");
        }
        return $this->buildEmployee(self::DATA[$employeeName->value()]);
    }

    /**
     * @param array $employeeData
     *
     * @return Employee
     * @throws InvalidContractStartingDateException
     * @throws Exception
     */
    private function buildEmployee(array $employeeData): Employee
    {
        $contract = new Contract(
            new ContractStartingDate(new DateTime($employeeData[2])),
            new ContractMinimumVacationDays($employeeData[3])
        );

        return new Employee(
            new EmployeeName($employeeData[0]),
            new EmployeeBirthdate(new DateTime($employeeData[1])),
            $contract
        );
    }
}
