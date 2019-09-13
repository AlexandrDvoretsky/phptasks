<?php
//3.9. Элементы  столбцов  целочисленного  массива  А(N,М),  не  содержащих положительных элементов,
// заменить суммой их цифр.

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

function getSumChars($array)
{
    for ($i = 0; $i < countElem($array); $i++) {
        $array[$i] = sumChar($array[$i]);
    }
    return $array;
}

function sumChar($char)
{
    $sum = 0;
    do {
        $sum += $char % 10;
    } while ($char = $char / 10);

    return $sum;
}

$array = [
    [-16, 26, -36, 46, -56, 66, 76, -86, -96, -106],
    [-31, 32, -33, -34, -35, -36, -37, -38, -39, -40],
    [-51, 52, -53, 54, -55, 56, 57, 58, 59, -60],
];

$rowCnt = 0;
$columnCnt = 0;
$negativeCnt = 0;
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

for ($j = 0; $j < $columnCnt; $j++) {
    for ($i = 0; $i < $rowCnt; $i++) {
        $newArray[$j][] = $array[$i][$j];
        if ($array[$i][$j] < 0) $negativeCnt++;
    }

    if ($negativeCnt == $rowCnt) {
        $newArray[$j] = getSumChars($newArray[$j]);
    }
    $negativeCnt = 0;
}

echo "Матрица: <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $newArray[$j][$i] . " | ";
    }
    echo "<br>";
}
?>
