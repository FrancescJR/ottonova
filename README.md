# Ottonova coding challenge

Hello, this is my attempt at your coding challenge.

## Requirements

To execute it you will need to have installed both PHP and the composer. For PHP check how to install
in your current OS. For the composer do this:

```curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer ```

## Installation

On the root of the project execute:
`composer install`

## Execution

On the roof of the project execute:
`php Challenge.php 2020` where 2020 is the year that you want to compute.

## Tests

At doing composer install, phpunit should have been installed. Execute the tests via phpunit of the
vendor doing this:
`vendor/phpunit/phpunit/phpunit `

## Comments

### Assumptions

- `Employees >= 30 years get one additional vacation day every 5 years` 
I assume this "every 5 years" is from the start date of the contract (instead of
what could be thought 5 years of age of the employee).

- `Employees >= 30 years get one additional vacation day every 5 years`
The age calculated is at the beginning of the year. If the employee becomes
  30 during 2020, that means that for the holiday days she is still 29, so she won't 
  get additional leave days.

- `Employees >= 30 years get one additional vacation day every 5 years` The same
for the "work anniversary". The years worked count until the 1st of january of the
  year you input.
  

- `A special contract can overwrite the amount of minimum vacation days` I assume it is the
minimum, so, if the holidays calculated on the "regular way" is more than this clause, the value
  to return should be the "regular way" then.

- `Contracts starting in the course of the year get 1/12 of the yearly vacation days for each full
  month` That overwrites the special contract clause. Even if the contract has a special clause, if
  the year you want to calculate is the same as the starting year of this person, the person
  gets the holiday days proportional to its worked months.

### Others

I believe the code is quite explicative itself.

I used symfony components for the dependency injection container (and the yml and config packages, 
so I could write the configuration in files).

The rest is following DDD. Maybe I could have added stubs for easier testing (I did partly that).
For the domain there might be details or different approaches, but I am quite happy overall.

Cheers!
