<?php
//3.22. В массиве А(N,M) расположить столбцы в порядке возрастания

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
    [1, 2, 13, 4,-654,65,133],
    [5, 6, 7, 8,345,99,-234],
    [9, 10, 14, 12,43,2,77]
];

$rowCnt = 0;
$columnCnt = 0;
$sumElements = array();

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
        $sumElements[$j]['SUM'] += $array[$i][$j];
        $sumElements[$j]['COLUMN'] = $j;
        $sumElements[$j]['ELEMENTS'][] = $array[$i][$j];
    }
    echo "<br>";
}

for($k=1;$k<countElem($sumElements);$k++)
{
    for($r=0;$r<countElem($sumElements)-1;$r++)
    {
        if($sumElements[$r]>$sumElements[$r+1])
        {
            $hold=$sumElements[$r];
            $sumElements[$r] = $sumElements[$r+1];
            $sumElements[$r+1]=$hold;
        }
    }
}

echo "Результат : <br>";
for ($i = 0; $i < countElem($array); $i++) {

    for($k=0;$k<countElem($array[$i]);$k++){
        echo $sumElements[$k]['ELEMENTS'][$i] . " | ";
    }
    echo "<br>";
}

?>