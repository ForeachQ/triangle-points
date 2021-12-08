<?php
class TriangleCalculations {
    public static function calculateSides($point1, $point2, $point3) {
        $sides[] = pow(($point1->x - $point2->x)**2 + ($point1->y - $point2->y)**2, 1/2);
        $sides[] = pow(($point3->x - $point2->x)**2 + ($point3->y - $point2->y)**2, 1/2);
        $sides[] = pow(($point3->x - $point1->x)**2 + ($point3->y - $point1->y)**2, 1/2);

        return $sides;
    }
}