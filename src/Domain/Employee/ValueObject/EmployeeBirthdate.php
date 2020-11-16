<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\ValueObject;


use DateTime;

class EmployeeBirthdate
{
    /**
     * @var DateTime
     */
    private $value;

    /**
     * EmployeeBirthdate constructor.
     *
     * @param DateTime $birthdate
     */
    public function __construct(DateTime $birthdate)
    {
        $this->value = $birthdate;
    }

    /**
     * @return DateTime
     */
    public function value(): DateTime
    {
        return $this->value;
    }

}
