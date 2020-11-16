<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Infrastructure\Console;

use Cesc\Ottivio\Application\Employee\GetEmployeeVacationDaysService;
use Exception;

class GetEmployeeVacationListEndpoint
{
    public const MESSAGE_MISSING_INPUT = "The proper execution is with one parameter";
    public const MESSAGE_NOT_NUMERIC = "Input must be a number";

    /**
     * @var GetEmployeeVacationDaysService
     */
    private $getListService;

    public function __construct(GetEmployeeVacationDaysService $getListService)
    {
        $this->getListService = $getListService;
    }


    /**
     * @param string|null $userInput
     *
     * @return string
     */
    public function execute(string $userInput = null): string
    {
        try {
            $userInput = $this->validateInput($userInput);

            $list = $this->getListService->execute((int)$userInput);

            $listFormatted = "";

            foreach ($list as $eventVacationPO) {
                $listFormatted .= $eventVacationPO->consoleOutput();
            }

            return $listFormatted;
        } catch (Exception $e) {
            return $e->getMessage() . "\n";
        }
    }

    /**
     * @param null $input
     *
     * @return int
     * @throws Exception
     */
    private function validateInput($input = null): int
    {
        if ( ! $input) {
            throw new Exception(self::MESSAGE_MISSING_INPUT);
        }

        if ( ! is_numeric($input)) {
            throw new Exception(self::MESSAGE_NOT_NUMERIC);
        }

        return (int)$input;
    }

}
