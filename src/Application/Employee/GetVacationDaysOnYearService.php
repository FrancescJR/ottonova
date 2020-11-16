<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Application\Employee;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Contract;
use Cesc\Ottivio\Domain\Employee\Employee;
use Cesc\Ottivio\Domain\Employee\EmployeeRepositoryInterface;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;
use DateTime;
use Exception;

class GetVacationDaysOnYearService
{
    public const MINIMUM_AGE_FOR_EXTRA_DAYS = 30;
    public const YEARS_NEEDED_FOR_AN_EXTRA_DAY = 5;


    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }


    /**
     * @param int $year
     * @param string $employeeName
     *
     * @return float
     * @throws Exception
     */
    public function execute(int $year, string $employeeName): float
    {
        $employee = $this->employeeRepository->getWithContract(new EmployeeName($employeeName));

        $vacationDays = Contract::MINIMUM_VACATION_DAYS;

        $vacationDays += $this->getSeniorityExtraDays($employee, $year);

        // Overwriting the calculated result by any special clause.
        if ($employee->getContract()->getMinimumVacationDays()->value()) {
            $vacationDays = max($vacationDays, $employee->getContract()->getMinimumVacationDays()->value());
        }

        // in this case there are of course no seniority extra days. And I am assuming
        // that even with an special clause, the holiday days will be proportional to the
        // time of the contract.
        if ($employee->getWorkAge($year) == 0) {
            $vacationDays = $vacationDays / $this->getFullMonthsWorked($employee->getContract());
        }


        return $vacationDays;
    }

    /**
     * @param Employee $employee
     * @param int $year
     *
     * @return int
     * @throws Exception
     */
    private function getSeniorityExtraDays(Employee $employee, int $year): int
    {
        if ($employee->getAge($year) >= self::MINIMUM_AGE_FOR_EXTRA_DAYS) {
            // get just the whole days.
            return $employee->getWorkAge($year) /
                   self::YEARS_NEEDED_FOR_AN_EXTRA_DAY;
        }

        return 0;
    }

    /**
     * @param Contract $contract
     *
     * @return int
     * @throws Exception
     */
    private function getFullMonthsWorked(Contract $contract): int
    {
        // check how many months will the employee have completed by the end of the year.
        return $contract->getStartingDate()->value()->diff(
            new DateTime('1-1-' . (string)($contract->getStartingDate()->year() + 1))
        )->m;
    }

}
