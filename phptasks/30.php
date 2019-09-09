<?php
//3.30 В  массиве  А(N,M)  расположить  строки  по  убыванию  значений  максимальных элементов строк.

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
    [12, 2, 13, 4, 87, 7, 133],
    [5, 6, 7, 8, 345, 99, 234],
    [9, 10, -14, 12, 43, 782, 77],
    [92, 130, 1114, 12, 43, 200, 77],
    [129, 19, 14, 2, -43, 3, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$negativeElementCnt = 0;
$newArray = array();
$iterationCnt = 0;
$simpleNumberCnt = 0;
$min=0;

echo "Матрица: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    $rowCnt = countElem($array);
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        $columnCnt = countElem($array[$i]);
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}

for($i=0; $i<$rowCnt; $i++){
    for($j=0; $j<$columnCnt; $j++){
        if($j==0) $min = $array[$i][$j];

        if($array[$i][$j]<$min) $min = $array[$i][$j];
    }
    $newArray[$i]['SORT'] = $min;
    $newArray[$i]['ELEMENTS'] = $array[$i];
}

//echo "<pre>"; print_r($newArray); echo "</pre>";

for ($i = 0; $i < $rowCnt; $i++) {

    for($k=1;$k<$rowCnt;$k++)
    {
        for($r=0;$r<$rowCnt-1;$r++)
        {
            if($newArray[$r]['SORT'] > $newArray[$r+1]['SORT']){
                $hold=$newArray[$r];
                $newArray[$r] = $newArray[$r+1];
                $newArray[$r+1]=$hold;
            }
        }
    }

}
echo "<br> Результат: <br>";
for($i=0; $i<$rowCnt; $i++){
    for($j=0; $j<$columnCnt; $j++){
        echo $newArray[$i]['ELEMENTS'][$j].' | ';
    }
    echo "<br>";
}
?>