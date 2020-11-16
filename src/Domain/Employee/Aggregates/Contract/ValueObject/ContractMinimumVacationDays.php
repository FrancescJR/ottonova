<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject;

class ContractMinimumVacationDays
{

    /**
     * @var int
     */
    private $value;

    /**
     * ContractSpecialClause constructor.
     *
     * @param int|null $minimumVacationDays
     */
    public function __construct(?int $minimumVacationDays = null)
    {
        $this->value = $minimumVacationDays;
    }

    /**
     * @return int|null
     */
    public function value(): ?int
    {
        return $this->value;
    }


}
