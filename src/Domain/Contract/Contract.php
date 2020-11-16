<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Contract;

use Cesc\Ottivio\Domain\Contract\ValueObject\ContractStartingDate;
use Cesc\Ottivio\Domain\Contract\ValueObject\ContractMinimumVacationDays;

class Contract
{

    /**
     * @var ContractStartingDate
     */
    private $startingDate;

    /**
     * @var ContractMinimumVacationDays
     */
    private $minimumVacationDays;

    private $employee;

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

}
