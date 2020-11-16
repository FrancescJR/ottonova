<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Contract\ValueObject;

class ContractMinimumVacationDays
{

    /**
     * @var int
     */
    private $value;

    /**
     * ContractSpecialClause constructor.
     *
     * @param int $minimumVacationDays
     */
    public function __construct(int $minimumVacationDays)
    {
        $this->value = $minimumVacationDays;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }


}
