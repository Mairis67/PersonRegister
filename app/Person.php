<?php

namespace App;

class Person
{
    private string $name;
    private string $surname;
    private string $insuranceNumber;


    public function __construct($name, $surname, $insuranceNumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->insuranceNumber = $insuranceNumber;
    }

    public function getPersonName(): string
    {
        return $this->name;
    }

    public function getPersonSurname(): string
    {
        return $this->surname;
    }

    public function getInsuranceNumber(): string
    {
        return $this->insuranceNumber;
    }
}