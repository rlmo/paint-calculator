<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Door;
use App\Models\Window;

class Wall extends Model
{
    use HasFactory;

    private float $minWallArea = 1; // In square meters
    private float $maxWallArea = 50; // In square meters
    private float $minHeightWall = 0.3; // Minimun extra height of wall with doors in meters
    public array $validationErros = [];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function wallValidations(string $key, array $wall): array
    {
        $wallArea = $this->getWallArea($wall['height'], $wall['width']);
        $nonWallArea = $this->getNonWallArea($wall['doors'], $wall['windows']);

        $this->validateWallArea($wallArea);
        $wall['doors'] > 0 && $this->validateDoorWall($wall['height']);
        ($wall['doors'] > 0 || $wall['windows'] > 0) && $this->validateNonWallArea($wallArea, $nonWallArea);

        return $this->validationErros;
    }

    public function wallArea(array $wall): float
    {
        $wallArea = $this->getWallArea($wall['height'], $wall['width']);
        $nonWallArea = $this->getNonWallArea($wall['doors'], $wall['windows']);

        return $this->getPaintArea($wallArea, $nonWallArea);
    }

    private function validateWallArea(float $area)
    {
        if($area < $this->minWallArea || $area > $this->maxWallArea)
            array_push($this->validationErros, "Área da parede deve ter no mínimo 1 metro quadrado e no máximo 50.");
    }

    private function validateDoorWall(float $height)
    {
        if($height < $this->minHeightWall + (new Door)->getHeight())
            array_push($this->validationErros, "A altura de paredes com porta deve ser, no mínimo, {$this->minHeightWall} metros maior que a altura da porta"); 
    }

    private function validateNonWallArea(float $wallArea, float $nonWallArea)
    {
        if($nonWallArea > $wallArea / 2)
            array_push($this->validationErros, "O total de área das portas e janelas deve ser no máximo 50% da área de parede");
    }

    private function getWallArea(float $height, float $witdh): float
    {
        return  $height * $witdh;
    }

    private function getNonWallArea(int $doors, int $windows): float
    {
        $doorsArea = (new Door)->getArea($doors);
        $windowsArea = (new Window)->getArea($windows);

        return $doorsArea + $windowsArea;
    }

    private function getPaintArea(float $wallArea, float $nonWallArea): float
    {
        return $wallArea - $nonWallArea;
    }

}
