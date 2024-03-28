<?php

namespace App\Infrastructure;

trait Filter
{
    public function filterByAge($data)
    {
        // Filter persons older than 20 and younger than 60
        return array_filter($data, function($person) {
            $age = (new \DateTime())->diff(new \DateTime($person['birthday']))->y;
            return $age > 20 && $age < 60;
        });
    }

}
