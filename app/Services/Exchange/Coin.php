<?php

namespace App\Services\Exchange;

use App\Services\Exchange\Interfaces\CoinInterface;
use DateTime;
use Illuminate\Database\DBAL\TimestampType;

class Coin implements CoinInterface
{
    private $dateTime;
    private $lastPrice;
    private $symbol;
    private $variation;
    private $variationPercent;
    private $maximum;
    private $minimum;
    private $volume;

    public function create(
        string $symbol,
        float $lastPrice,
        float $variation,
        float $variationPercent,
        float $maximum,
        float $minimum,
        float $volume
    ) {
        $this->dateTime = new DateTime('now');
        $this->symbol = $symbol;
        $this->lastPrice = $lastPrice;
        $this->variation = $variation;
        $this->variationPercent = $variationPercent;
        $this->maximum = $maximum;
        $this->minimum = $minimum;
        $this->volume = $volume;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getLastPrice()
    {
        return $this->lastPrice;
    }

    public function getVariation()
    {
        return $this->variation;
    }

    public function getVariationPercent()
    {
        return $this->variationPercent;
    }

    public function getMaximum()
    {
        return $this->maximum;
    }

    public function getMinimum()
    {
        return $this->minimum;
    }

    public function getVolume()
    {
        return $this->volume;
    }
}
