<?php
require_once "TriangleCalculations.php";

class Triangle {
    // points
    public $firstPoint;
    public $secondPoint;
    public $thirdPoint;
   
    public function __construct($firstPoint, $secondPoint, $thirdPoint) {
        if (!$this->ifExists($firstPoint, $secondPoint, $thirdPoint)) {
            throw new Exception('Triangle does not exist.');
        }
        $this->firstPoint = $firstPoint;
        $this->secondPoint = $secondPoint;
        $this->thirdPoint = $thirdPoint;
    }

    private function ifExists($firstPoint, $secondPoint, $thirdPoint) {
        $sides = TriangleCalculations::calculateSides($firstPoint, $secondPoint, $thirdPoint);
        if ($sides[0] + $sides[1] > $sides[2] && 
            $sides[1] + $sides[2] > $sides[0] && 
            $sides[2] + $sides[0] > $sides[1]) {
            return true;
        } else {
            return false;
        }
    }
}