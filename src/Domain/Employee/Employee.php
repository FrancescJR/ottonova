<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee;

use Cesc\Ottivio\Domain\Employee\Aggregates\Contract\Contract;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeBirthdate;
use Cesc\Ottivio\Domain\Employee\ValueObject\EmployeeName;
use DateTime;
use Exception;

class Employee
{
    public const DAY_FOR_AGE_COUNTER = '01-01-';
    public const DAY_FOR_WORK_AGE_COUNTER = '01-01-';
    /**
     * @var EmployeeName
     */
    private $name;

    /**
     * @var EmployeeBirthdate
     */
    private $birthdate;

    /**
     * @var Contract
     */
    private $contract;


    /**
     * Employee constructor.
     *
     * @param EmployeeName $name
     * @param EmployeeBirthdate $birthdate
     * @param Contract $contract
     */
    public function __construct(EmployeeName $name, EmployeeBirthdate $birthdate, Contract $contract)
    {
        $this->name      = $name;
        $this->birthdate = $birthdate;
        $this->contract  = $contract;
    }

    /**
     * @return EmployeeName
     */
    public function getName(): EmployeeName
    {
        return $this->name;
    }

    /**
     * @return EmployeeBirthdate
     */
    public function getBirthDate(): EmployeeBirthdate
    {
        return $this->birthdate;
    }

    /**
     * @return Contract
     */
    public function getContract(): Contract
    {
        return $this->contract;
    }

    /**
     * @param int $onYear
     *
     * @return int
     * @throws Exception
     */
    public function getAge(int $onYear): int
    {
        $age = $this->birthdate->value()->diff(
            new DateTime(self::DAY_FOR_AGE_COUNTER . $onYear)
        );
        return  $age->invert ? 0: $age->y;
    }


    /**
     * @param $onYear
     *
     * @return int
     * @throws Exception
     */
    public function getWorkAge($onYear): int
    {
        //return max (0, $onYear - $this->contract->getStartingDate()->year());
        $workAge = $this->contract->getStartingDate()->value()->diff(
            new DateTime(self::DAY_FOR_WORK_AGE_COUNTER . $onYear)
        );

        return  $workAge->invert ? 0: $workAge->y;
    }


}
