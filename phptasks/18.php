<?php
//3.18 В массиве А(N,М) столбец с минимальным количеством нечетных элементов переставить на последнее место.

function countElem($array)
{
    $count = 0;
    $i = 0;
    while ($array[$i] > 0 || $array[$i] < 0 || $array[$i] === 0) {
        $count++;
        $i++;
    }
    return $count;
}

$array = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 14, 12]
];

$rowCnt = 0;
$columnCnt = 0;
$negElemCnt = 0;
$negElemCntLast = 1;
$numColumn = 0;

echo "Матрица: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    $rowCnt = countElem($array);
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        $columnCnt = countElem($array[$i]);
        echo $array[$i][$j] . " | ";
    }
        echo "<br>";
}

for ($j = 0; $j < $columnCnt; $j++) {
    for ($i = 0; $i < $rowCnt; $i++) {
        if ($array[$i][$j] < 0)
            $negElemCnt++;
        $elements[] = $array[$i][$j];
    }
    if ($negElemCnt %2!=0 && $negElemCnt <= $negElemCntLast) {
        $negElemCntLast = $negElemCnt;
        $numColumn = $j;
    }
    $negElemCnt = 0;
    $newArray[] = $elements;
    $elements = array();
    echo "<br>";
}

$newArray[] = $newArray[$numColumn];
$array = array();

for ($j = 0; $j < countElem($newArray); $j++) {
    for ($i = 0; $i < countElem($newArray[$i]); $i++) {
        if($j == $numColumn)
            continue;
        else
            $elements[] = $newArray[$j][$i];
    }
    if(countElem($elements)){
        $array[] = $elements;
        $elements = array();
    }
}

echo "Результат : <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $array[$j][$i] . " | ";
    }
    echo "<br>";
}


?>