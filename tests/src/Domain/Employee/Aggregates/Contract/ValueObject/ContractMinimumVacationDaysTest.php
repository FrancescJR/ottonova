<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject;

use PHPUnit\Framework\TestCase;

class ContractMinimumVacationDaysTest extends TestCase
{
    public function testSuccess(): void
    {
        $minimumVacationDays = new ContractMinimumVacationDays(0);

        self::assertEquals(0, $minimumVacationDays->value());
    }

    public function testNull(): void
    {
        $minimumVacationDays = new ContractMinimumVacationDays();

        self::assertEquals(null, $minimumVacationDays->value());
    }


}
