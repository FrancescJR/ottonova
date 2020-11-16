<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Application\Employee;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Contract;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Exception\InvalidContractStartingDateException;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractMinimumVacationDays;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractStartingDate;
use Cesc\Ottivio\Domain\Employee\Employee;
use Cesc\Ottivio\Domain\Employee\EmployeeRepositoryInterface;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeBirthdate;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;
use DateTime;
use PHPUnit\Framework\TestCase;

class GetVacationDaysOnYearServiceTest extends TestCase
{
    public function testRegular(): void
    {
        $employeeRepository = $this->prepare(
            new DateTime('30.12.1980'),
            new DateTime('01.01.2001')
        );

        $service = new GetVacationDaysOnYearService(
            $employeeRepository
        );

        self::assertEquals(Contract::MINIMUM_VACATION_DAYS, $service->execute(2005, 'test'));
    }

    public function testSeniority(): void
    {
        $employeeRepository = $this->prepare(
            new DateTime('30.12.1950'),
            new DateTime('01.01.2001')
        );

        $service = new GetVacationDaysOnYearService(
            $employeeRepository
        );

        self::assertEquals(Contract::MINIMUM_VACATION_DAYS + 1, $service->execute(2006, 'test'));
        self::assertEquals(Contract::MINIMUM_VACATION_DAYS + 1, $service->execute(2007, 'test'));
        self::assertEquals(Contract::MINIMUM_VACATION_DAYS + 1, $service->execute(2008, 'test'));
        self::assertEquals(Contract::MINIMUM_VACATION_DAYS + 1, $service->execute(2009, 'test'));
        self::assertEquals(Contract::MINIMUM_VACATION_DAYS + 1, $service->execute(2010, 'test'));
        self::assertEquals(Contract::MINIMUM_VACATION_DAYS + 2, $service->execute(2011, 'test'));
    }

    public function testSpecialClause(): void
    {
        $employeeRepository = $this->prepare(
            new DateTime('30.12.1950'),
            new DateTime('01.01.2001'),
            40
        );

        $service = new GetVacationDaysOnYearService(
            $employeeRepository
        );

        self::assertEquals(40, $service->execute(2006, 'test'));

    }

    public function testCurrentYear(): void
    {
        $employeeRepository = $this->prepare(
            new DateTime('30.12.1950'),
            new DateTime('01.02.2001'),
            40
        );

        $service = new GetVacationDaysOnYearService(
            $employeeRepository
        );

        self::assertEquals((int)floor(40 * 11 / 12), $service->execute(2001, 'test'));

        $employeeRepository = $this->prepare(
            new DateTime('30.12.1950'),
            new DateTime('01.01.2001'),
        );

        $service = new GetVacationDaysOnYearService(
            $employeeRepository
        );

        self::assertEquals(Contract::MINIMUM_VACATION_DAYS, $service->execute(2001, 'test'));

        $employeeRepository = $this->prepare(
            new DateTime('30.12.1950'),
            new DateTime('15.12.2001'),
        );

        $service = new GetVacationDaysOnYearService(
            $employeeRepository
        );

        self::assertEquals(0, $service->execute(2001, 'test'));
    }

    /**
     * @param DateTime $birthdate
     * @param DateTime $contractDate
     * @param int|null $minVacationDays
     *
     * @return EmployeeRepositoryInterface
     * @throws InvalidContractStartingDateException
     */
    private function prepare(
        DateTime $birthdate,
        DateTime $contractDate,
        ?int $minVacationDays = null
    ): EmployeeRepositoryInterface {

        // should create dir structure, I am just going fast.
        $contractDateStub    = new ContractStartingDate($contractDate);
        $minVacationDaysStub = new ContractMinimumVacationDays($minVacationDays);

        $contract = self::createMock(Contract::class);
        $contract->method('getStartingDate')->willReturn($contractDateStub);
        $contract->method('getMinimumVacationDays')->willReturn($minVacationDaysStub);

        $employeeBirthdateStub = new EmployeeBirthdate($birthdate);

        //also should be in its own dir.
        $employeeStub = new Employee(
            self::createMock(EmployeeName::class),
            $employeeBirthdateStub,
            $contract
        );

        $employeeRepository = self::createMock(EmployeeRepositoryInterface::class);
        $employeeRepository->method('getWithContract')->willReturn($employeeStub);

        return $employeeRepository;
    }

}
