<?php
require_once "Point.php";
require_once "Triangle.php";

$file = fopen("tria-pt.txt", "r") or die("Unable to open file.");
$file_text = fread($file, filesize("tria-pt.txt"));
fclose($file);

function parsePointsFromString($string_data, $delimiter): array
{
    $stringPoints = explode($delimiter, $string_data);
    $points = array();
    for ($i = 0; $i < count($stringPoints); $i++) {
        $pointCoords = explode(",", $stringPoints[$i]);
        if (count($pointCoords) != 2) {
            continue;
        }
        $x = $pointCoords[0];
        $y = $pointCoords[1];

        // пропуск точек неудовлетворяющих ограничениям задания
        if (-10 <= $x && $x <= 10 && -10 <= $y && $y <= 10) {
            $points[] = new Point(round($x, 7), round($y, 7));
        }

    }
    return $points;
}

function isPointInTriangle($point, $triangle): bool
{
    $k1 = ($triangle->firstPoint->x - $point->x) * ($triangle->secondPoint->y - $triangle->firstPoint->y) -
        ($triangle->secondPoint->x - $triangle->firstPoint->x) * ($triangle->firstPoint->y - $point->y);

    $k2 = ($triangle->secondPoint->x - $point->x) * ($triangle->thirdPoint->y - $triangle->secondPoint->y) -
        ($triangle->thirdPoint->x - $triangle->secondPoint->x) * ($triangle->secondPoint->y - $point->y);

    $k3 = ($triangle->thirdPoint->x - $point->x) * ($triangle->firstPoint->y - $triangle->thirdPoint->y) -
        ($triangle->firstPoint->x - $triangle->thirdPoint->x) * ($triangle->thirdPoint->y - $point->y);

    if (($k1 >= 0 && $k2 >= 0 && $k3 >= 0) || ($k1 <= 0 && $k2 <= 0 && $k3 <= 0))
        return true;
    else
        return false;
}

$points = parsePointsFromString($file_text, "\n");

if (count($points) < 4) {
    exit("Wrong number of input points (must be >= 4).");
}


try {
    $triangle = new Triangle($points[0], $points[1], $points[2]);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
    return;
}

// проверям точки на вхождение в область треугольника
for ($i = 3; $i < count($points); $i++) {
    if (isPointInTriangle($points[$i], $triangle)) {
        echo $i - 2 . ": да.\n";
    } else {
        echo $i - 2 . ": нет.\n";
    }
}
