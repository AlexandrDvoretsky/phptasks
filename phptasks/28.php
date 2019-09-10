<?php
//3.28 В  массиве  А(N,M)  элементы  строк,  начинающихся  с  отрицательного элемента,
//  расположить  в порядке возрастания.

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
    for ($r = 0; $r < countElem($array)-1; $r++) {
        if($array[$r]>$array[$r+1]){
            $hold = $array[$r];
            $array[$r] = $array[$r + 1];
            $array[$r + 1] = $hold;
        }
    }
    return $array;
}

$array = [
    [12, 2, 13, 4, 87, 7, 133],
    [-5, 6, 7, 8, 345, 99, 234],
    [9, 10, -14, 12, 43, 782, 77],
    [92, 130, 1114, 12, 43, 200, 77],
    [-129, 19, 14, 2, -43, 3, 7],
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
    for ($j = 0; $j < $columnCnt; $j++) {
        if ($array[$i][0] < 0) {
            $array[$i] = orderByASC($array[$i]);
        }
    }
}

echo "<br>Результат: <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}
?>