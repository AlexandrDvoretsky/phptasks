<?php
//error_reporting(0);
class combinatoricErrorException extends Exception
{
    public function logError($e)
    {
        $date = date('Y-m-d H:i:s (T)');
        $file = __DIR__.'\errors.txt';
        $strError = $date."\n".$e."\r\n";
        if(file_exists($file))
            file_put_contents($file, $strError,FILE_APPEND);
    }

    public function getErrorList(){
        echo "\n Error.txt:";
        $file = __DIR__.'\errors.txt';
        if(file_exists($file))
            return "<pre>".file_get_contents($file)."</pre>";
    }
}

class combinatoric
{
    public $chars = array();
    public $length = '';

    function __construct($chars, $length){
        if($this->checkLength($chars, $length)){
            $this->chars = str_split($chars);
            $this->length = $length;
        }
    }

    public function checkLength($str, $len){

        if(count(str_split($str)) < $len){
            throw  new combinatoricErrorException('Длина слова больше числа символов в строке!');
        }else {
            return true;
        }
    }

    public function checkArrayUnique($array){
        $newArray = array_unique($array);
        if(count($newArray) == 1) return false;
        else return true;
    }

    public function checkUniqueChars($chars, $length)
    {
        $arChars = str_split($chars);
        if (in_array($length, $arChars)) return false;
        else return true;
    }

    public function factorial($number)
    {
        if ($number <= 1) return 1;
        else return ($number * $this->factorial($number - 1));
    }

    public function getUniqueWordCnt()
    {
        $elementCnt = count($this->chars);
        return $this->factorial($elementCnt) / $this->factorial(($elementCnt - $this->length));
    }

    public function sampling($combinations = array(), $length = false)
    {
        if($this->checkArrayUnique($this->chars)){
            $new_combinations = array();

            if (!$combinations) $combinations = $this->chars;
            if (!$length) $length = $this->length;
            if ($length == 1) return $combinations;

            foreach ($combinations as $combination) {
                foreach ($this->chars as $char) {
                    if ($this->checkUniqueChars($combination, $char))
                        $new_combinations[] = $combination . $char;
                }
            }
            return $this->sampling($new_combinations, $length - 1);
        }else{
            $combination = array();
            for($i=0; $i < count($this->chars);$i++){
                for($j=0; $j < $this->length; $j++){
                    $combination[] = $this->chars[$i] . $this->chars[$j];
                }
            }
            return $combination;
        }

    }
}

try{
    $chars = new combinatoric('123',2);
    $output = $chars->sampling();
    echo $chars->getUniqueWordCnt();

    echo "<pre>";
    var_dump($output);
    echo "</pre>";
}catch (combinatoricErrorException $e){
    echo $e;
    $e->logError($e);
    echo $e->getErrorList();
}

?>