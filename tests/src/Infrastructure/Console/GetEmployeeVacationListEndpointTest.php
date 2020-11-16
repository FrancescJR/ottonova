<?php
declare(strict_types=1);


namespace Cesc\Ottivio\Infrastructure\Console;

use Cesc\Ottivio\Application\Employee\GetEmployeeVacationDaysService;
use Cesc\Ottivio\Application\Employee\PlainObject\EmployeeVacationPO;
use PHPUnit\Framework\TestCase;

class GetEmployeeVacationListEndpointTest extends TestCase
{
    public function testSuccess():void
    {
        $service = self::createMock(GetEmployeeVacationDaysService::class);
        $po = self::createMock(EmployeeVacationPO::class);
        $po->method('consoleOutput')->willReturn('string');
        $service->method('execute')->willReturn([$po]);

        $endpoint = new GetEmployeeVacationListEndpoint($service);
        $result = $endpoint->execute(2020);

        self::assertEquals('string', $result);
    }

    public function testExceptions():void
    {
        $service = self::createMock(GetEmployeeVacationDaysService::class);
        $endpoint = new GetEmployeeVacationListEndpoint($service);
        $result = $endpoint->execute();
        self::assertEquals(GetEmployeeVacationListEndpoint::MESSAGE_MISSING_INPUT, $result);

        $result = $endpoint->execute("string");
        self::assertEquals(GetEmployeeVacationListEndpoint::MESSAGE_NOT_NUMERIC, $result);

        $result = $endpoint->execute(100.8);
        self::assertEquals(GetEmployeeVacationListEndpoint::MESSAGE_NOT_INTEGER, $result);
    }

}
