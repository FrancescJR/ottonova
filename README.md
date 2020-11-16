Assumptions:

- `Employees >= 30 years get one additional vacation day every 5 years` 
I assume this "every 5 years" is from the start date of the contract (instead of
what could be thought 5 years of age of the employee).

- `Employees >= 30 years get one additional vacation day every 5 years`
The age calculated is at the beginning of the year. If the employee becomes
  30 during 2020, that means that for the holiday days she is still 29, so she won't 
  get additional leave days.
  

- `A special contract can overwrite the amount of minimum vacation days` I assume it is the
minimum, so, if the holidays calculated on the "regular way" is more than this clause, the value
  to return should be the "regular way" then.


Special contract is just a contract with a special clause.
To me it makes more sense to have a Domain this way than having a two types of contract.
It also makes the coding easier.


 Not setting the relationship with contract here on EMployee, TBD, 
 probably would be a one to one relationship, it could be an aggregate of employee
but  - when coding application I will decide.
