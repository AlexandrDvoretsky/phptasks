<?php
//3.29. В  массиве  А(N,M)  расположить  строки  так,  чтобы  сначала  шли  строки,  у  которых  положительных
//  элементов  больше,  чем  отрицательных,  затем    с  одинаковым  числом  положительных  и  отрицательных
//  элементов  и  последними,  чтобы  шли  строки,  имеющие  положительных  элементов меньше, чем отрицательных.

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
    [1, 2, 3, 4, 5, 6, 7, -8, -9, -10],
    [11, 12, 13, 14, 15, -16, -17, -18, -19, -20],
    [31, 32, -33, -34, -35, -36, -37, -38, -39, -40],
    [-41, 42, 43, 44, 45, 46, 47, 48, 49, -50],
    [51, 52, 53, 54, -55, 56, 57, 58, 59, 60],
    [61, 62, -63, -64, -65, -66, -67, 68, 69, 70],
];

$rowCnt = 0;
$columnCnt = 0;
$negativeCnt = 0;
$positiveCnt = 0;
$newArray = array();
$arElements = array();
$arPositiveElements = array();
$arNegativeElements = array();

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
        if ($array[$i][$j] < 0) $negativeCnt++;
        if ($array[$i][$j] > 0) $positiveCnt++;
    }

    if ($negativeCnt < $positiveCnt) $arPositiveElements[] = $array[$i];
    elseif ($negativeCnt > $positiveCnt) $arNegativeElements[] = $array[$i];
    else $arElements[] = $array[$i];
    $negativeCnt = 0;
    $positiveCnt = 0;
}

$array = array();

for ($i = 0; $i < countElem($arPositiveElements); $i++) {
    $array[] = $arPositiveElements[$i];
}
for ($i = 0; $i < countElem($arElements); $i++) {
    $array[] = $arElements[$i];
}
for ($i = 0; $i < countElem($arNegativeElements); $i++) {
    $array[] = $arNegativeElements[$i];
}

echo "<br>Результат: <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}
?>