<?php
//3.33 В  массиве  А(N,M)  расположить  элементы    строк  в  порядке  убывания.
//Вставить в каждую строку заданное число р, не нарушая этот порядок.

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

$array = [
    [12, 2, 13, 4, 87, 7, 133],
    [5, 6, 7, 8, 345, 99, 234],
    [9, 10, -14, 12, 43, 782, 77],
    [92, 130, 1114, 12, 43, 200, 77],
    [129, 19, 14, 2, -43, 3, 7],
    [1, 222, 3, 444, -43, 6, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$newArray = array();
$p = 54;

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
    for ($k = 0; $k < $rowCnt; $k++) {
        for ($r = 0; $r < $columnCnt-1; $r++) {
            if ($array[$k][$r] < $array[$k][$r + 1]) {
                $hold = $array[$k][$r];
                $array[$k][$r] = $array[$k][$r + 1];
                $array[$k][$r + 1] = $hold;
            }
        }
    }
}

for ($k = 0; $k < $rowCnt; $k++) {
    for ($r = 0; $r < $columnCnt; $r++) {
        if($array[$k][$r]>$p){
            $posR = $r+1;
        }
    }

    if($posR){
        for ($r = 0; $r < $posR; $r++) {
            $newArray[$k][$r] = $array[$k][$r];
        }
        $newArray[$k][]=$p;
        for ($r = $posR; $r < $columnCnt; $r++) {
            $newArray[$k][] = $array[$k][$r];
        }
    }
}

echo "<br>Матрица: <br>";
for ($i = 0; $i < countElem($newArray); $i++) {
    for ($j = 0; $j < countElem($newArray[$i]); $j++) {
        echo $newArray[$i][$j] . " | ";
    }
    echo "<br>";
}

