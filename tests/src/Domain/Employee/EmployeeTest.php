<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Contract;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractStartingDate;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeBirthdate;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeBirthdateTest;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;
use DateTime;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{

    public function testConstruct(): void
    {
        $name      = self::createMock(EmployeeName::class);
        $birthdate = self::createMock(EmployeeBirthdate::class);
        $contract  = self::createMock(Contract::class);

        $employee = new Employee(
            $name,
            $birthdate,
            $contract
        );

        self::assertEquals($name, $employee->getName());
        self::assertEquals($birthdate, $employee->getBirthDate());
        self::assertEquals($contract, $employee->getContract());
    }

    public function testGetAge()
    {
        $name      = self::createMock(EmployeeName::class);
        $birthdate = self::createMock(EmployeeBirthdate::class);
        $birthdate->method("value")->willReturn(new DateTime(EmployeeBirthdateTest::TEST_BIRTHDATE));
        $contract = self::createMock(Contract::class);

        $employee = new Employee(
            $name,
            $birthdate,
            $contract
        );

        self::assertEquals(0, $employee->getAge(1000));
        self::assertEquals(0, $employee->getAge(1951));
        self::assertEquals(1, $employee->getAge(1952));
    }

    public function testGetWorkAge()
    {
        $name      = self::createMock(EmployeeName::class);
        $birthdate = self::createMock(EmployeeBirthdate::class);
        $contract = self::createMock(Contract::class);
        $contractStartingDate = self::createMock(ContractStartingDate::class);
        $contractStartingDate->method('year')->willReturn(2001);
        $contractStartingDate->method('value')->willReturn(new DateTime('01.05.2001'));
        $contract->method('getStartingDate')->willReturn($contractStartingDate);

        $employee = new Employee(
            $name,
            $birthdate,
            $contract
        );

        self::assertEquals(0, $employee->getWorkAge(1951));
        self::assertEquals(0, $employee->getWorkAge(1952));

        self::assertEquals(0, $employee->getWorkAge(2001));
        self::assertEquals(0, $employee->getWorkAge(2002));

        self::assertEquals(18, $employee->getWorkAge(2020));
    }

}
