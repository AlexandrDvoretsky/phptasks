<?php
//3.20 В каждой строке массива А(N,М) найти максимальный из элементов, встречающихся в строке только один раз.

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
    [345, 234, 7, 8, 345, 99, 234],
    [9, 43, 782, 12, 43, 782, 77],
    [129, 19, 14, 2, 129, 3, 129],
    [1, 444, 3, 444, 444, 6, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$newArray = array();
$arElements = array();
$max = 0;

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
    $arElements[$i] = orderByASC($array[$i]);
}

for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        if($arElements[$i][$j]==$arElements[$i][$j+1] || $arElements[$i][$j-1]==$arElements[$i][$j]) continue;
        else{
            $newArray[$i][] = $arElements[$i][$j];
            if($max<$arElements[$i][$j]) $max = $arElements[$i][$j];
        }
    }
    $newArray[$i]['MAX'] = $max;
    $max=0;
}

echo "<br>Результат: <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $array[$i][$j] . " | ";
    }
    echo 'MAX: '. $newArray[$i]['MAX'];
    echo "<br>";
}
?>