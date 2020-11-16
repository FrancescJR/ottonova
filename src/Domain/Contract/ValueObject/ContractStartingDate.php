<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Contract\ValueObject;

use Cesc\Ottivio\Domain\Contract\Exception\InvalidContractStartingDateException;
use DateTime;

class ContractStartingDate
{
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

    /**
     * @param DateTime $startingDate
     *
     * @throws InvalidContractStartingDateException
     */
    private function setValue(DateTime $startingDate): void
    {
        // check if it is 1 or 15 of month
        if ($startingDate == "a") {
            throw new InvalidContractStartingDateException("Starting Date of contract can be only on 1st or 15th");
        }

        $this->value = $startingDate;
    }

}
