<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\ValueObject;

use PHPUnit\Framework\TestCase;

class EmployeeNameTest extends TestCase
{
    public const TEST_NAME = 'Hans Müller';

    public function testSuccess(): void
    {
        $name = new EmployeeName(self::TEST_NAME);

        self::assertEquals(self::TEST_NAME, $name->value());
    }

}
