<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;

    private static float $height = 1.9; // In meters
    private static float $width = 0.8; // In meters

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getArea(int $quantity): float
    {
        return $quantity * $this->height * $this->width;
    }

    public function calculateAllDoorsArea(int $doors): float
    {
        $totalArea = $doors * $this->height * $this->width;
        return $totalArea;
    }
}
