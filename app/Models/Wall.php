<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Door;
use App\Models\Window;

class Wall extends Model
{
    use HasFactory;

    private static float $minWallArea = 1; // In square meters
    private static float $maxWallArea = 50; // In square meters
    private static float $minHeightWall = 0.3; // Minimun extra height of wall with doors in meters
    public array $invalidWallMsg = [];

    public function wallValidations(float $height, float $witdh, int $doors, int $windows): array
    {
        $this->validateWallArea($height, $witdh);
        $doors > 0 && $this->validateDoorWall($height);
        $doors > 0 || $windows > 0 && $this->validateNonWallArea($height, $witdh, $doors, $windows);

        return $this->invalidWallMsg;
    }

    public function validateWallArea(float $height, float $witdh)
    {
        if(($height * $witdh) < $this->minWallArea || ($height * $witdh) > $this->maxWallArea)
            array_push($this->invalidWallMsg, "Área da parede deve ter no mínimo 1 metro quadrado e no máximo 50.");
    }

    public function validateDoorWall(float $height)
    {
        if($height < $this->minHeightWall + Door::getHeight())
            array_push($this->invalidWallMsg, "A altura de paredes com porta deve ser, no mínimo, {$this->minHeightWall} metros maior que a altura da porta"); 
    }

    public function validateNonWallArea(float $height, float $witdh, int $doors, int $windows)
    {
        $doorsArea = Door::getArea($doors);
        $windowsArea = Window::getArea($windows);

        if($doorsArea + $windowsArea > $height * $witdh / 2)
            array_push($this->invalidWallMsg, "O total de área das portas e janelas deve ser no máximo 50% da área de parede");
    }
}
