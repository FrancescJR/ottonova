<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Application\Employee;


use Cesc\Ottivio\Application\Employee\PlainObject\EmployeeVacationPO;
use Cesc\Ottivio\Domain\Employee\Employee;
use Cesc\Ottivio\Domain\Employee\EmployeeRepositoryInterface;
use PHPUnit\Framework\TestCase;

class GetEmployeeVacationDaysServiceTest extends TestCase
{
    public function testSuccess():void
    {
        $vacationDaysService = self::createMock(GetVacationDaysOnYearService::class);
        $vacationDaysService->method('execute')->willReturn(10);

        $employeeRepository = self::createMock(EmployeeRepositoryInterface::class);
        $employee = self::createMock(Employee::class);

        $employeeRepository->method('findAll')->willReturn([$employee]);

        $getListService = new GetEmployeeVacationDaysService(
            $employeeRepository,
            $vacationDaysService
        );

        $result = $getListService->execute(1);

        self::assertCount(1, $result);
        self::assertEquals(EmployeeVacationPO::class, get_class($result[0]));
    }

}
