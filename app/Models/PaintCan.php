<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaintCan extends Model
{
    use HasFactory;

    private array $sizes = [0.5, 2.5, 3.6, 18.0]; // In liters
    private float $metersPerLiter = 5;

    /**
    * Calculate the number of each paint can size given the total wall area to be painted
    * @param float  $totalArea  Total wall area
    * @return array $paintCansNeeded    Number of paint cans for each size
    */
    public function paintCansNeeded(float $area): array
    {
        $litersNeeded = $this->getLitersNeeded($area);
        $paintCanSizes = $this->sizes;
        rsort($paintCanSizes);
        $paintCansNeeded = [];

        foreach($paintCanSizes as $size)
        {
            $paintCansNeeded[(string)$size] = floor($litersNeeded / $size);
            $litersNeeded -= $paintCansNeeded[(string)$size] * $size;
        }

        if($litersNeeded > 0) $paintCansNeeded[(string)end($paintCanSizes)]++; // Workarround to not ignore < .5 liters needed

        return $paintCansNeeded;
    }

    public function getLitersNeeded($area): float
    {
        return round($area / $this->metersPerLiter, 2);
    }
}
