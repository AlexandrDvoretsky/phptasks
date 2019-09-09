<?php
//3.31 В  массиве  А(N,M) элементы,  кратные  заданному  числу  р,  переместить в начало
// строк и расположить их в порядке возрастания.

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

function checkElement($element, $array){
    for($i=0;$i<=countElem($array); $i++){
        if($array[$i]==$element) $res = $element;
    }
    if($res) return false;
    else return $element;
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
$newArray = array();
$p = 4;

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
        if ($array[$i][$j] % $p == 0) $newArray[$i][] = $array[$i][$j];
    }
}

for ($k = 0; $k < countElem($newArray); $k++) {
    for ($r = 0; $r < countElem($newArray[$k]); $r++) {
        if($newArray[$k][$r+1] && ($newArray[$k][$r] > $newArray[$k][$r+1])){
            $hold=$newArray[$k][$r];
            $newArray[$k][$r] = $newArray[$k][$r+1];
            $newArray[$k][$r+1]=$hold;
        }

    }
}
for($i=0; $i<$rowCnt; $i++){
    for($j=0; $j<$columnCnt; $j++){
        if(checkElement($array[$i][$j], $newArray[$i])) $newArray[$i][] = $array[$i][$j];
    }
}

echo "<br> Результат: <br>";
for($i=0; $i<$rowCnt; $i++){
    for($j=0; $j<$columnCnt; $j++){
        echo $newArray[$i][$j].' | ';
    }
    echo "<br>";
}
?>