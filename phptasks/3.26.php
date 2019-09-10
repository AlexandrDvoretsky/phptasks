<?php
//3.26 В массиве А(N,M) переместить нулевые строки в конец массива.

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
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [-5, 626, 7, 0, 1, 0, 345, 99, 0, 234],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [-19, 23, 139, 4, 22, 90, -343, 23, 0, 1],
    [1, 222, 0, 3, 444, 0, 0, -43, 6, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$newArray = array();
$arZeroElements = array();
$arElements = array();
$k = 0;

echo "Матрица: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    $rowCnt = countElem($array);
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        $columnCnt = countElem($array[$i]);
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}

for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        if ($array[$i][$j] == 0) $k++;
    }
    if ($k == $columnCnt) $arZeroElements[] = $array[$i];
    else $arElements[] = $array[$i];
    $k=0;
}

for ($i = 0; $i < countElem($arZeroElements); $i++) {
    $arElements[] = $arZeroElements[$i];
}

echo "<br>Результат: <br>";
for ($i = 0; $i < countElem($arElements); $i++) {
    for ($j = 0; $j < countElem($arElements[$i]); $j++) {
        echo $arElements[$i][$j] . " | ";
    }
    echo "<br>";
}
?>