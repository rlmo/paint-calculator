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
    private float $maxNonWallRatio = 0.5;
    private array $rules = [];
    public array $validationErrors = [
        "errors" => 0,
        "errorMessages" => []
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function getRules()
    {
        $this->setRules();
        return $this->rules;
    }

    private function setRules()
    {
        $rule1 = [ // Todo: set rules from db
            "name" => "Área mínima e máxima da parede",
            "description" => "Uma parede não pode ter menos de {$this->minWallArea} metro quadrado nem mais de {$this->maxWallArea} metros qudrados.",
            "rule" => "wall.height * wall.width >= {$this->minWallArea} && wall.height * wall.width <= {$this->maxWallArea}",
        ]; 
        !empty($rule1) && array_push($this->rules, $rule1);
        $rule2 = [ // Todo: set rules from db
            "name" => "Área máxima de portas e janelas",
            "description" => "O total de área de portas e janelas deve ser no máximo " . $this->maxNonWallRatio * 100 . "% da área da parede.",
            "rule" => "doors.area + windows.area <= wall.area * {$this->maxNonWallArea}",
        ]; 
        !empty($rule2) && array_push($this->rules, $rule2);
    }

    public function wallValidations(array $wall): array
    {
        $wallArea = $this->getWallArea($wall['height'], $wall['width']);
        $nonWallArea = $this->getNonWallArea($wall['doors'], $wall['windows']);

        $this->validateWallArea($wallArea);
        $wall['doors'] > 0 && $this->validateDoorWall($wall['height']);
        ($wall['doors'] > 0 || $wall['windows'] > 0) && $this->validateNonWallArea($wallArea, $nonWallArea);

        return $this->validationErrors;
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
        {
            $this->validationErrors["errors"]++;
            array_push($this->validationErrors["errorMessages"], "Área da parede deve ter no mínimo 1 metro quadrado e no máximo 50.");
        }
    }

    private function validateDoorWall(float $height)
    {
        if($height < $this->minHeightWall + (new Door)->getHeight())
        {
            $this->validationErrors["errors"]++;
            array_push($this->validationErrors["errorMessages"], "A altura de paredes com porta deve ser, no mínimo, {$this->minHeightWall} metros maior que a altura da porta."); 
        }
    }

    private function validateNonWallArea(float $wallArea, float $nonWallArea)
    {
        if($nonWallArea > $wallArea * $this->maxNonWallRatio)
        {
            $this->validationErrors["errors"]++;
            array_push($this->validationErrors["errorMessages"], "O total de área das portas e janelas deve ser no máximo 50% da área de parede.");
        }
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
        return round($wallArea - $nonWallArea, 2);
    }

}
