<?php
//3.23 В  массиве  А(N,M)  переставить  строки  в порядке убывания количества содержащихся в них положительных элементов.

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
    [1, 2, 13, 4, 654, 65, -133],
    [5, -6, 7, 8, 345, 99, -234],
    [9, 10, 14, -12, 43, 2, -77],
    [92, -130, -1114, -12, 43, 2, -77],
    [129, 1, 14, -2, 43, 3, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$negativeElementCnt = 0;
$newArray = array();

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
        if ($array[$i][$j] < 0)
            $negativeElementCnt++;
    }
    $newArray[$i]['SORT'] = $negativeElementCnt;
    $newArray[$i]['ROW'] = $i;
    $newArray[$i]['ELEMENTS'] = $array[$i];
    $negativeElementCnt = 0;
    echo "<br>";
}

for ($i = 0; $i < $rowCnt; $i++) {

    for($k=1;$k<$rowCnt;$k++)
    {
        for($r=0;$r<$rowCnt-1;$r++)
        {
            if($newArray[$r]['SORT']<$newArray[$r+1]['SORT'])
            {
                $hold=$newArray[$r];
                $newArray[$r] = $newArray[$r+1];
                $newArray[$r+1]=$hold;
            }
        }
    }

}

echo "Результат: <br>";
for($i=0; $i<$rowCnt; $i++){
    for($j=0; $j<$columnCnt; $j++){
        echo $newArray[$i]['ELEMENTS'][$j].' | ';
    }
    echo "<br>";
}
?>