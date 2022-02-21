<?php

namespace App;

class Registry
{
    private array $list;

    public function addToList(Person $person): void
    {
        $this->list[] = $person;
    }

    public function getPerson(): array
    {
        return $this->list;
    }
}



