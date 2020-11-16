<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\Aggregates\Contract;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractMinimumVacationDays;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractStartingDate;
use PHPUnit\Framework\TestCase;

class ContractTest extends TestCase
{

    public function testConstruct(): void
    {
        $startingDate = self::createMock(ContractStartingDate::class);
        $minimumHolidayDays = self::createMock(ContractMinimumVacationDays::class);

        $contract = new Contract(
            $startingDate,
            $minimumHolidayDays
        );

        self::assertEquals($startingDate, $contract->getStartingDate());
        self::assertEquals($minimumHolidayDays, $contract->getMinimumVacationDays());
    }

}
