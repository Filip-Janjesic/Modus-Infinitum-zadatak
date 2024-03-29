<?php

namespace App\Tests\Infrastructure;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\MainCommand;

class MainCommandTest extends TestCase
{
    public function testFilterByAge(): void
    {
        
        $mainCommand = new MainCommand();
        $data = [
            ['Nname' => 'John', 'Bbirthday' => '2000-01-01'], 
            ['Nname' => 'Jane', 'Bbirthday' => '1980-01-01'], 
            ['Nname' => 'Adam', 'Bbirthday' => '1960-01-01'], 
        ];
        $expectedResult = [
            ['Nname' => 'John', 'Bbirthday' => '2000-01-01'],
            ['Nname' => 'Jane', 'Bbirthday' => '1980-01-01'],
        ];
        $filteredData = $mainCommand->filterByAge($data);
        $this->assertEquals($expectedResult, $filteredData);
    }
}
