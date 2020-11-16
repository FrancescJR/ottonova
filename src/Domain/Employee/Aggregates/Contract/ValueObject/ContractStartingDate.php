<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\Aggregates\Contract\ValueObject;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Exception\InvalidContractStartingDateException;
use DateTime;

class ContractStartingDate
{
    public const VALID_STARTING_DAYS = [1, 15];
    /**
     * @var DateTime
     */
    private $value;

    /**
     * EmployeeBirthdate constructor.
     *
     * @param DateTime $startingDate
     * @throws InvalidContractStartingDateException
     */
    public function __construct(DateTime $startingDate)
    {
        $this->setValue($startingDate);
    }

    /**
     * @return DateTime
     */
    public function value(): DateTime
    {
        return $this->value;
    }

    public function year(): int
    {
        return (int)$this->value->format('Y');
    }

    /**
     * @param DateTime $startingDate
     *
     * @throws InvalidContractStartingDateException
     */
    private function setValue(DateTime $startingDate): void
    {
        // check if it is 1 or 15 of month
        if ( ! in_array($startingDate->format('d'), self::VALID_STARTING_DAYS)) {
            throw new InvalidContractStartingDateException("Starting Date of contract can be only on 1st or 15th");
        }

        $this->value = $startingDate;
    }

}
