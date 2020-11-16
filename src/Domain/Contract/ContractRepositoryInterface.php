<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Contract;


use Cesc\Ottivio\Domain\Employee\Employee;

interface ContractRepositoryInterface
{
    public function findByEmployee(Employee $employee);

}
