<?php
class Company {
    private string $title;
    private array $offices;

    public function __construct(string $title) {
        $this->title = $title;
    }

    public function addOffice(Office $office) {
        $this->offices[] = $office;
    }

    public function generateOffice(string $title) {
        $office = new Office($title);
        $this->offices[] = $office;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getOffices(): array {
        return $this->offices;
    }

    public function getOfficesSortedByTotalSalary(): array {
        $sortedOffices = $this->offices;
        usort($sortedOffices, function($office1, $office2) {
            $salary1 = array_reduce($office1->getEmployees(), function($acc, $employee) {
                return $acc + $employee->getSalary();
            }, 0);
            $salary2 = array_reduce($office2->getEmployees(), function($acc, $employee) {
                return $acc + $employee->getSalary();
            }, 0);
            return $salary2 - $salary1;
        });

        $sortedOfficesData = [];
        foreach ($sortedOffices as $office) {
            $salaryTotal = 0;
            $employees = $office->getEmployees();
            array_walk($employees, function($value) use (&$salaryTotal) {
                $salaryTotal += $value->getSalary();
            });

            $sortedOfficesData[$office->getTitle()] = $salaryTotal;
        }

        return $sortedOfficesData;
    }

    public function getOfficesByRangeOfEmployees(int $from, int $to): array {
        $offices = [];
        foreach ($this->offices as $office) {
            $count = count($office->getEmployees());
            if($count > $from && $count < $to) {
                $offices[$office->getTitle()] = $count;
            }
        }

        return $offices;
    }
}
class Office {
    private string $title;
    private array $employees;

    public function __construct(string $title) {
        $this->title = $title;
    }

    public function addEmployee(string $name, float $salary): void {
        $employee = new Employee($name, $salary);
        $this->employees[] = $employee;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getEmployees(): array {
        return $this->employees;
    }
}
class Employee {
    private string $name;
    private float $salary;

    public function __construct(string $name, float $salary) {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSalary(): float {
        return $this->salary;
    }
}

/*
 * Generate Company, offices and employees
 */
$company = new Company("Axisbits");
for ($index=0; $index < 5; $index++) {
    $office  = new Office("Office_" . ($index + 1) );
    $office->addEmployee("Employee_1", round((1000.0 + mt_rand() / mt_getrandmax() * (5000.0 - 1000.0)), 2));
    $office->addEmployee("Employee_2", round((1000.0 + mt_rand() / mt_getrandmax() * (5000.0 - 1000.0)), 2));
    $office->addEmployee("Employee_3", round((1000.0 + mt_rand() / mt_getrandmax() * (5000.0 - 1000.0)), 2));
    $company->addOffice($office);
}

/*
 * Testing all
 */
echo print_r($company);
echo "\n";
echo print_r($company->getOfficesSortedByTotalSalary());
echo "\n";
echo print_r($company->getOfficesByRangeOfEmployees(2, 5));
echo "\n";
