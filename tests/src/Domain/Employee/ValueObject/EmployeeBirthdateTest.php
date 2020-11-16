<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\ValueObject;


use DateTime;
use PHPUnit\Framework\TestCase;

class EmployeeBirthdateTest extends TestCase
{
    public const TEST_BIRTHDATE = '30.12.1950';

    public function testSuccess(): void
    {
        $birthdate = new EmployeeBirthdate(new DateTime(self::TEST_BIRTHDATE));

        self::assertEquals('1950-12-30', $birthdate->value()->format('Y-m-d'));
    }
}
