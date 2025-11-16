<?php

namespace App\Services;

class YandexMapService
{
    public function getPoints(): array
    {
        return [
            ['name' => 'Москва', 'lat' => 55.7558, 'lng' => 37.6176],
            ['name' => 'Санкт-Петербург', 'lat' => 59.9343, 'lng' => 30.3351],
            ['name' => 'Казань', 'lat' => 55.7887, 'lng' => 49.1221],
        ];
    }
}
