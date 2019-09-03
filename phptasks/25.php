<?php
//3.25 В массиве А(N,M) расположить строки в порядке возрастания количества простых чисел в строке.

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
        for($divider=2;$divider<=$array[$i][$j];$divider++)
        {
            if($array[$i][$j]%$divider==0)
                $iterationCnt++;
        }
        if($iterationCnt<2)
            $simpleNumberCnt++;

        $iterationCnt=0;
    }
    $newArray[$i]['SORT'] = $simpleNumberCnt;
    $newArray[$i]['ROW'] = $i;
    $newArray[$i]['ELEMENTS'] = $array[$i];
    $simpleNumberCnt=0;
}

for ($i = 0; $i < $rowCnt; $i++) {

    for($k=1;$k<$rowCnt;$k++)
    {
        for($r=0;$r<$rowCnt-1;$r++)
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
        echo $newArray[$i]['ELEMENTS'][$j].' | ';
    }
    echo "<br>";
}

?>