<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject;


use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Exception\InvalidContractStartingDateException;
use DateTime;
use PHPUnit\Framework\TestCase;

class ContractStartingDateTest extends TestCase
{

    public function testSuccess(): void
    {
        $startingDate = new ContractStartingDate(new DateTime('01.01.2001'));

        self::assertEquals('2001-01-01', $startingDate->value()->format('Y-m-d'));
    }

    public function testInvalid(): void
    {
        self::expectException(InvalidContractStartingDateException::class);
        new ContractStartingDate(new DateTime('16.01.2001'));
    }

    public function testYear(): void
    {
        $startingDate = new ContractStartingDate(new DateTime('01.01.2001'));
        self::assertEquals(2001, $startingDate->year());

        $startingDate = new ContractStartingDate(new DateTime('15.12.2015'));
        self::assertEquals(2015, $startingDate->year());

        $startingDate = new ContractStartingDate(new DateTime('01.01.2020'));
        self::assertEquals(2020, $startingDate->year());
    }

}
