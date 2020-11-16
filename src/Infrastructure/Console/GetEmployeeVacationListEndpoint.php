<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Infrastructure\Console;

use Cesc\Ottivio\Application\Employee\GetEmployeeVacationDaysService;
use Exception;

class GetEmployeeVacationListEndpoint
{
    public const MESSAGE_MISSING_INPUT = "The proper execution is with one parameter";
    public const MESSAGE_NOT_NUMERIC = "Input must be a number";
    public const MESSAGE_NOT_INTEGER = "Input must be an integer";
    private $getListService;

    public function __construct(GetEmployeeVacationDaysService $getListService)
    {
        $this->getListService = $getListService;
    }


    /**
     * @param null $userInput
     *
     * @return string
     */
    public function execute($userInput = null): string
    {
        try {
            $this->validateInput($userInput);

            $list = $this->getListService->execute($userInput);

            $listFormatted = "";

            foreach ($list as $eventVacationPO) {
                $listFormatted .= $eventVacationPO->consoleOutput();
            }

            return $listFormatted;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $input
     *
     * @throws Exception
     */
    private function validateInput($input = null): void
    {
        if ( ! $input) {
            throw new Exception(self::MESSAGE_MISSING_INPUT);
        }

        if ( ! is_numeric($input)) {
            throw new Exception(self::MESSAGE_NOT_NUMERIC);
        }

        if ( ! is_int($input)) {
            throw new Exception(self::MESSAGE_NOT_INTEGER);
        }
    }

}
