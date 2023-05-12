<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    use HasFactory;

    private float $height = 1.2; // In meters
    private float $width = 2.0; // In meters

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
