<?php
//3.27 В массиве А(N,M) расположить столбцы в порядке убывания их максимальных элементов.

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
    [9, 10, 14, 12, 43, 2, 77],
    [92, 130, 1114, 12, 43, 2, 77],
    [129, 19, 14, 2, 43, 3, 7],
];

$rowCnt = 0;
$columnCnt = 0;
$negativeElementCnt = 0;
$newArray = array();
$iterationCnt = 0;
$simpleNumberCnt = 0;
$max=0;

echo "Матрица: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    $rowCnt = countElem($array);
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        $columnCnt = countElem($array[$i]);
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}

echo "<br>";
for ($j = 0; $j < $columnCnt; $j++) {
    for ($i = 0; $i < $rowCnt; $i++) {

        if($array[$i][$j] > $max){
            $max = $array[$i][$j];
        }
        $newArray[$j]['ELEMENTS'][] = $array[$i][$j];
    }
    $newArray[$j]['SORT'] = $max;
    $max=0;
    echo "<br>";
}

for ($i = 0; $i < $columnCnt; $i++) {

    for($k=1;$k<$columnCnt;$k++)
    {
        for($r=0;$r<$columnCnt-1;$r++)
        {
            if($newArray[$r]['SORT']>$newArray[$r+1]['SORT'])
            {
                $hold=$newArray[$r];
                $newArray[$r] = $newArray[$r+1];
                $newArray[$r+1]=$hold;
            }
        }
    }

}

echo "<br>Результат: <br>";
for($i=0; $i<$rowCnt; $i++){
    for($j=0; $j<$columnCnt; $j++){
        echo $newArray[$j]['ELEMENTS'][$i].' | ';
    }
    echo "<br>";
}
?>