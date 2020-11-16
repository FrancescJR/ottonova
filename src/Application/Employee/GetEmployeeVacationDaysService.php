<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Application\Employee;


use Cesc\Ottivio\Application\Employee\PlainObject\EmployeeVacationPO;
use Cesc\Ottivio\Domain\Employee\EmployeeRepositoryInterface;
use Exception;

class GetEmployeeVacationDaysService
{
    private $employeeRepository;
    private $getVacationDaysOnYearService;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        GetVacationDaysOnYearService $getVacationDaysOnYearService
    ) {
        $this->employeeRepository           = $employeeRepository;
        $this->getVacationDaysOnYearService = $getVacationDaysOnYearService;
    }


    /**
     * @param int $year
     *
     * @return EmployeeVacationPO[]
     * @throws Exception
     */
    public function execute(int $year): array
    {
        $employeesPO = [];

        foreach ($this->employeeRepository->findAll() as $employee) {
            $employeesPO[] = new EmployeeVacationPO(
                $employee,
                $this->getVacationDaysOnYearService->execute($year, $employee->getName()->value())
            );
        }

        return $employeesPO;
    }

}
