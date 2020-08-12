<?php

namespace App\Services\Contracts;

use App\Services\Dto\InnResponseDto;

interface InnChecker
{
    public function check(int $inn): InnResponseDto;
}
