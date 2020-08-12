<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\Http;
use App\Services\Dto\InnResponseDto;
use App\Services\Contracts\InnChecker;

class InnCheckerFNS implements InnChecker
{
    const BASE_URL = 'https://statusnpd.nalog.ru:443/api/v1/tracker/taxpayer_status';

    /**
     * @param int $inn
     * @return InnResponseDto
     */
    public function check(int $inn): InnResponseDto
    {
        $today = (new DateTime)->format('Y-m-d');

        $response = Http::post(self::BASE_URL, [
            'inn' => $inn,
            'requestDate' => $today,
        ]);

        $body = $response->json();

        if ($response->failed()) {
            return new InnResponseDto(false, $body['message'], $body['code']);
        }

        return new InnResponseDto((bool)$body['status'], $body['message']);
    }
}
