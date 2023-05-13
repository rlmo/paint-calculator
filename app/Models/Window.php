<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Window extends Model
{
    use HasFactory;

    private float $height = 1.2; // In meters
    private float $width = 2.0; // In meters
    private array $rules = [];

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    private function getRules()
    {
        $this->setRules();
        return $this->rules;
    }

    private function setRules()
    {
        $rule1 = []; 
        !empty($rule1) && array_push($this->rules, $rule1);
    }

    public function getArea(int $quantity): float
    {
        return $quantity * $this->height * $this->width;
    }

    public function getInfo(): array
    {
        $area = $this->getArea(1);
        $rules = $this->getRules();

        return [
            "area" => $area,
            "width" => $this->width,
            "height" => $this->height,
            "rules" => $rules,
        ];
    }
}
