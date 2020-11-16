<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\Aggregates\Contract;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractStartingDate;
use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject\ContractMinimumVacationDays;
use DateTime;
use Exception;

class Contract
{
    public const MINIMUM_VACATION_DAYS = 26;

    /**
     * @var ContractStartingDate
     */
    private $startingDate;

    /**
     * @var ContractMinimumVacationDays
     */
    private $minimumVacationDays;

    /**
     * Contract constructor.
     *
     * @param ContractStartingDate $startingDate
     * @param ContractMinimumVacationDays $minimumVacationDays
     */
    public function __construct(
        ContractStartingDate $startingDate,
        ContractMinimumVacationDays $minimumVacationDays
    ) {
        $this->minimumVacationDays = $minimumVacationDays;
        $this->startingDate        = $startingDate;
    }

    /**
     * @return ContractStartingDate
     */
    public function getStartingDate(): ContractStartingDate
    {
        return $this->startingDate;
    }

    public function getMinimumVacationDays(): ContractMinimumVacationDays
    {
        return $this->minimumVacationDays;
    }

}
