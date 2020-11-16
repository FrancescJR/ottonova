<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Infrastructure\Console;

use Cesc\Ottivio\Application\Employee\GetEmployeeVacationDaysService;
use Exception;

class GetEmployeeVacationListEndpoint
{
    private $getListService;

    public function __construct(GetEmployeeVacationDaysService $getListService)
    {
        $this->getListService = $getListService;
    }

    /**
     * @param int|null $userInput
     *
     * @return string
     */
    public function execute(?int $userInput = null)
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
     * @param int|null $input
     *
     * @throws Exception
     */
    private function validateInput(?int $input = null):void
    {
        if (!$input) {
            throw new Exception("The proper execution is with one parameter");
        }

        if (!is_numeric($input)) {
            throw new Exception("Input must be a number");
        }

        if (!is_int($input)) {
            throw new Exception("Input must be an integer");
        }
    }

}
