<?php
//3.21. В массиве А(N,M) элементы строк расположить в порядке их возрастания

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
    [41, 32, 113, 45],
    [59, 16, 37, 8],
    [9, 120, 14, 12],
    [519, -146, 37, 8],
    [59, 11, 37, 33]
];

echo "Матрица: <br>";
for ($i = 0; $i < countElem($array); $i++) {
    $rowCnt = countElem($array);
    for ($j = 0; $j < countElem($array[$i]); $j++) {
        $columnCnt = countElem($array[$i]);
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}

for($i=0;$i<$rowCnt;$i++)
{
    $elements = $array[$i];

    for($k=1;$k<countElem($elements);$k++)
    {
        for($r=0;$r<countElem($elements)-1;$r++)
        {
            if($elements[$r]>$elements[$r+1])
            {
                $hold=$elements[$r];
                $elements[$r] = $elements[$r+1];
                $elements[$r+1]=$hold;
            }
        }
    }

    $newArray[] = $elements;
}

$array = $newArray;
//    echo "<pre>";print_r($elements); echo "</pre>";
echo "Результат: <br>";
for ($i = 0; $i < $rowCnt; $i++) {
    for ($j = 0; $j < $columnCnt; $j++) {
        echo $array[$i][$j] . " | ";
    }
    echo "<br>";
}
?>