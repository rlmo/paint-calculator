<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;

    private float $height = 1.9; // In meters
    private float $width = 0.8; // In meters

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
}
