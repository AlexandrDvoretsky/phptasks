<?php
// 3.14. В массиве А(N,М) удалить нулевые строки.


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
    [1, 2, 3, 4, 5, 6, 7, -8, -9, -10],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [31, 32, -33, -34, -35, -36, -37, -38, -39, -40],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [51, 52, 53, 54, -55, 56, 57, 58, 59, 60],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
];

$rowCnt = 0;
$columnCnt = 0;
$zeroCnt = 0;
$zeroElementsRow = "";
$newArray = array();
$arElements = array();
$arZeroElements = array();

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
        if ($array[$i][$j] == 0) $zeroCnt++;
    }

    if ($zeroCnt == $columnCnt) $zeroElementsRow = $i;
    else $zeroElementsRow="";
    $zeroCnt = 0;

    if($zeroElementsRow === "") $newArray[] = $array[$i];
    else continue;
    $zeroElementsRow="";
}
$array = array();
$array = $newArray;

echo "<br> Результат: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}
?>