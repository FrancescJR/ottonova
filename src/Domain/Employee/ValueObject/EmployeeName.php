<?php
declare(strict_types=1);

namespace Cesc\Ottivio\Domain\Employee\ValueObject;

class EmployeeName
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
