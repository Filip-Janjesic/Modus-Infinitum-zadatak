<?php

namespace App\Infrastructure;

trait Filter
{
    public function filterByAge($data)
    {
        return array_filter($data, function($person) {
            $age = (new \DateTime())->diff(new \DateTime($person['birthday']))->y;
            return $age > 20 && $age < 60;
        });
    }

}
