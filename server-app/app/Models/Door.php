<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    private float $height = 1.9; // In meters
    private float $width = 0.8; // In meters
    private float $minExtraHeight = 0.3;
    private array $rules = [];

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getMinExtraHeight(): float
    {
        return $this->minExtraHeight;
    }

    private function getRules()
    {
        $this->setRules();
        return $this->rules;
    }

    private function setRules()
    {
        $rule1 = [ // Todo: set rules from db
            "name" => "Altura mínima da parede",
            "description" => "Se uma parede tiver uma porta, esta precisa ter uma certa altura a mais que a porta: " 
                . str_replace('.', ',', $this->minExtraHeight) . "m.",
            "rule" => "wall.height >= door.height + {$this->minExtraHeight}",
        ]; 
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
