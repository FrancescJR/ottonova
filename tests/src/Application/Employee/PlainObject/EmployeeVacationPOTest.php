<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Application\Employee\ValueObject;


use Cesc\Ottivio\Application\Employee\PlainObject\EmployeeVacationPO;
use Cesc\Ottivio\Domain\Employee\Employee;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeNameTest;
use PHPUnit\Framework\TestCase;

class EmployeeVacationPOTest extends TestCase
{
    public const VACATION_DAYS = 10;

    public function testConsoleText()
    {
        $employee     = self::createMock(Employee::class);
        $employeeName = self::createMock(EmployeeName::class);
        $employeeName->method('value')->willReturn(EmployeeNameTest::TEST_NAME);
        $employee->method('getName')->willReturn($employeeName);

        $employeeVacationPO = new EmployeeVacationPO($employee, self::VACATION_DAYS);

        self::assertEquals(EmployeeNameTest::TEST_NAME . ": " . self::VACATION_DAYS ."\n",
            $employeeVacationPO->consoleOutput());

    }

}
