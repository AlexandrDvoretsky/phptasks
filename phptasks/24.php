<?php
//3.24 В массиве А(N,M) в каждой строке нулевые элементы переставить  в конец строки, а остальные
// элементы расположить в порядке убывания.


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

function orderByDESC($array)
{
    for ($j = 1; $j < countElem($array); $j++) {
        for ($i = 0; $i < countElem($array)-1; $i++) {
            if ($array[$i] < $array[$i + 1]) {
                $hold = $array[$i];
                $array[$i] = $array[$i + 1];
                $array[$i + 1] = $hold;
            }
        }
    }
    return $array;
}

$array = [
    [0, 12, 2, 13, 0, 4, 87, 0, 7, 133],
    [-5, 626, 7, 0, 1, 0, 345, 99, 0, 234],
    [-129, 0, 19, 14, 2, 0, -43, 3, 0, 7],
    [1, 222, 0, 3, 444, 0, 0, -43, 6, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$newArray = array();
$arZeroElements = array();
$arElements = array();

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
        if ($array[$i][$j] == 0)
            $arZeroElements[$i][] = $array[$i][$j];
        else $arElements[$i][] = $array[$i][$j];
    }
    $arElements[$i] = orderByDESC($arElements[$i]);
}

for ($i=0;$i<countElem($arElements);$i++){
    for($j=0;$j<countElem($arZeroElements[$i]);$j++){
        $arElements[$i][]=$arZeroElements[$i][$j];
    }
}

echo "<br>Результат: <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $arElements[$i][$j] . " | ";
    }
    echo "<br>";
}


?>