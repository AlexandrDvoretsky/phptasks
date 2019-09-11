<?php
//3.34 В массиве А(N,M) переставить строки так, чтобы строка с максимальной  суммой  элементов  стала
//  первой  строкой, а  остальные  строки  расположить в порядке возрастания элементов первого столбца.


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

function checkElement($element, $array)
{
    for ($i = 0; $i <= countElem($array); $i++) {
        if ($array[$i] == $element) $res = $element;
    }
    if ($res) return false;
    else return $element;
}

function orderByASC($array)
{
    for ($j = 1; $j < countElem($array); $j++) {
        for ($r = 0; $r < countElem($array) - 1; $r++) {
            if ($array[$r] > $array[$r + 1]) {
                $hold = $array[$r];
                $array[$r] = $array[$r + 1];
                $array[$r + 1] = $hold;
            }
        }
    }
    return $array;
}

$array = [
    [5, 6, 7, 8, 345, 99, 234],
    [9, 10, -14, 12, 43, 782, 77],
    [92, 130, 1114, 12, 43, 200, 77],
    [129, 19, 14, 2, -43, 3, 7],
    [1, 222, 3, 444, -43, 6, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$newArray = array();
$arColumn = array();
$arElements = array();
$max = 0;
$rowSum = 0;

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
        $rowSum += $array[$i][$j];
    }
    if ($max < $rowSum) {
        $max = $rowSum;
        $row = $i;
        $rowSum = 0;
    }
}
$newArray[] = $array[$row];

echo "<br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        if ($i == $row) continue;
        $arElements[$i][] = $array[$i][$j];
        $arColumn[$j][]=$array[$i][$j];
        $arColumn[$j]=orderByASC($arColumn[$j]);
    }
}

for ($i = 0; $i < countElem($array); $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        if($arElements[$j][0]==$arColumn[0][$i])
            $newArray[] = $arElements[$j];
    }
}

echo "<br>Результат: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        echo $newArray[$i][$j] . " | ";
    }
    echo "<br>";
}
?>